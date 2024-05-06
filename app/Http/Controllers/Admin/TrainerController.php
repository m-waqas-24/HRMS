<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Trainer;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage trainer')){
            if(Auth::user()->type == 'company'){
                $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
                $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
                $trainers = Trainer::where('created_by' , \Auth::user()->creatorId())->get();
                return view('admin.trainer.index', compact('branches', 'companies', 'trainers'));
            }
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'branch' => 'required',
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'expertise' => 'required',
        ]);

        Trainer::create([
            'company_id' => $request->company,
            'branch_id' => $request->branch,
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'expertise' => $request->expertise,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Trainer created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        if(Auth::user()->can('edit trainer')){
            if(Auth::user()->type == 'company'){
                if( \Auth::user()->creatorId() == $trainer->created_by){
                    $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
                    $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
                    return view('admin.trainer.edit', compact('trainer', 'branches', 'companies'));
                }else{
                    auth()->logout();
                    abort(403);
                }
            }
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        $request->validate([
            'company' => 'required',
            'branch' => 'required',
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'expertise' => 'required',
        ]);

        $trainer->update([
            'company_id' => $request->company,
            'branch_id' => $request->branch,
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'expertise' => $request->expertise,
        ]);

        return redirect()->route('admin.trainers.index')->withSuccess('Trainer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
        if(Auth::user()->can('delete trainer')){
            if( \Auth::user()->creatorId() == $trainer->created_by){
                $trainer->delete();

                return back()->withSuccess('Trainer deleted successfully!');
            }
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

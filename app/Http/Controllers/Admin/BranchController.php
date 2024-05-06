<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
        $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
        return view('system-settings.branches', compact('branches', 'companies'));
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
            'name' => 'required',
        ]);

        Branch::create([
            'name' => $request->name,
            'company_id' => $request->company,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Branch created successfully!');
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
    public function edit(Branch $branch)
    {
            if(\Auth::user()->creatorId() == $branch->created_by){
                $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
                return view('admin.branches.edit', compact('branch', 'companies'));
            }else{
                auth()->logout();
                abort(403);
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $branch->update([
            'name' => $request->name,
            'company_id' => $request->company,
        ]);

        return redirect()->route('admin.branches.index')->withSuccess('Branch updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete branches')){
           
        }else{
            return back()->withError('Permission Denied!');
        }
    }
}

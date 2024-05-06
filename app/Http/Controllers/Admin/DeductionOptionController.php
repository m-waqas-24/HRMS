<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeductionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeductionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage deduction-options')){
            $deductionTypes = DeductionOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->paginate(12);
    
            return view('admin.settings.deductionoptions', compact('deductionTypes'));
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
            'name' => 'required',
        ]);

        DeductionOption::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Deduction option created successfully!');
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
    public function edit(DeductionOption $deductiontype)
    {
        if(Auth::user()->can('edit deduction-options')){
            if(\Auth::user()->creatorId() == $deductiontype->created_by){

                return view('admin.deductionoptions.edit', compact('deductiontype'));
            }else{
                auth()->logout();
                abort(403);
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
    public function update(Request $request, DeductionOption $deductiontype)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $deductiontype->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.deductiontypes.index')->withSuccess('Deduction option updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete deduction-options')){
           
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

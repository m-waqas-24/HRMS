<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AllowanceOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllowanceOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage allowance-options')){
            $allowanceTypes = AllowanceOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
    
            return view('admin.settings .allowanceoptions', compact('allowanceTypes'));
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

        AllowanceOption::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Allowance option created successfully!');
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
    public function edit(AllowanceOption $allowancetype)
    {
        if(Auth::user()->can('edit allowance-options')){
            if( \Auth::user()->creatorId() == $allowancetype->created_by){

                return view('admin.allowanceoptions.edit', compact('allowancetype'));
            }else{
                auth()->logout();
                abort(403);
            }
        }else{
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
    public function update(Request $request, AllowanceOption $allowancetype)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $allowancetype->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.allowancetypes.index')->withSuccess('Allowance option updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete allowance-options')){
           
        }else{
               return back()->withError('Permission Denied!');
        }
    }
}

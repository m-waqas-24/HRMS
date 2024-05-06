<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage designations')){
            $designations = Designation::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
            $departments = Department::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
        
            return view('admin.settings.designations', compact('departments', 'designations'));
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
            'department' => 'required',
            'name' => 'required',
        ]);

        Designation::create([
            'department_id' => $request->department,
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Designation created sucessfully!');
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
    public function edit(Designation $designation)
    {
        if(Auth::user()->can('edit designations')){

            if (\Auth::user()->creatorId() == $designation->created_by) {
                $departments = Department::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
                return view('admin.designations.edit', compact('designation', 'departments'));
            } else {
                auth()->logout();
                return abort(403); 
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
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'department' => 'required',
            'name' => 'required',
        ]);

        $designation->update([
            'department_id' => $request->department,
            'name' => $request->name,
        ]);
        
        return redirect()->route('admin.designations.settings')->withSuccess('Designation updated sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete designations')){
           
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

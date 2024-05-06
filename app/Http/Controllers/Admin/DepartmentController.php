<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage departments')){
            $departments = Department::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->paginate(10);

            return view('admin.settings.departments', compact('departments'));
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
        Department::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return redirect()->back()->withSuccess('Department created successfully!');
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
    public function edit(Department $department)
    {
        if(Auth::user()->can('edit departments')){
            if (\Auth::user()->creatorId() == $department->created_by) {
    
                return view('admin.departments.edit', compact('department'));
    
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
    public function update(Department $department, Request $request)
    {
        $department->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.departments.settings')->withSuccess('Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete departments')){
           
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

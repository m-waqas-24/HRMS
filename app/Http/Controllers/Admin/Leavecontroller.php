<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Leave;
use App\Models\LeaveStatus;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Leavecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage leaves')){
            if(Auth::user()->type == 'employee' ){
                $employes = Employe::find(Auth::user()->employe->id);
                $leaves = Leave::where('emp_id' , Auth::user()->employe->id )->orderBy('id', 'DESC')->get();
            }else{
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
                $leaves = Leave::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
            }
            
            $types = Status::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
          
            return view('admin.leaves.index', compact('employes', 'leaves', 'types'));
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
            "employee" => 'required',
            "leave_type" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
            "reason" => 'required',
        ]);

        $modifiedDiffInDays = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date)) + 1;

        Leave::create([
            "emp_id" => $request->employee,
            "leave_type" => $request->leave_type,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "total_days" => $modifiedDiffInDays,
            "reason" => $request->reason,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Leave created successfully!');
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
    public function edit($id)
    {
        if(Auth::user()->can('edit leaves')){
            $leave = Leave::find($id);
            $employee = Employe::where('id', $leave->emp_id)->exists();
            if (!$employee){
                return back()->withErrors('Employe Not Exist!');
            }
            if( \Auth::user()->creatorId() == $leave->created_by ){
                if(Auth::user()->type == 'employee'){
                    $employes = Employe::where('id' , Auth::user()->employe->id)->orderBy('id', 'DESC')->first();
                }
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
                $types = Status::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
                $leaveStatus = LeaveStatus::all();
                return view('admin.leaves.edit', compact('leave', 'employes', 'types', 'leaveStatus'));
            }else{
                abort(403);
            }
        }
        else
        {
           return back()->withErrors('Permission Denied!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "employee" => 'required',
            "leave_type" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
            "reason" => 'required',
        ]);
        $leave = Leave::find($id);

        $modifiedDiffInDays = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date)) + 1;

        $leave->update([
            "emp_id" => $request->employee,
            "leave_type" => $request->leave_type,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "total_days" => $modifiedDiffInDays,
            "reason" => $request->reason,
            "status" => $request->status,
        ]);

        return redirect()->route('admin.leaves.index')->withSuccess('Leave updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = Leave::find($id);
        if(Auth::user()->can('delete leaves')){
            if( \Auth::user()->creatorId() == $leave->created_by ){

                $leave->delete();

                return back()->withSuccess('Leave deleted successfully!');
            }
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

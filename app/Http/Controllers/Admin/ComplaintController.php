<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage complaints')){
            if(Auth::user()->type == 'employee'){
                $employes = Employe::find(Auth::user()->employe->id); 
                $complaints = Complaint::where('emp_id', Auth::user()->employe->id)->orderBy('id','DESC')->get();
            }else{
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
                $complaints = Complaint::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
            }
            $againstemployes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
     
            return view('admin.complaints.index', compact('complaints', 'employes', 'againstemployes'));
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
            "employee" =>  'required',
            "against_employee" =>  'required',
            "title" =>  'required',
            "date" => 'required',
            "description" => 'required',
        ]);

        Complaint::create([
            "emp_id" =>  $request->employee,
            "against_emp_id" =>  $request->against_employee,
            "title" =>  $request->title,
            "date" => $request->date,
            "description" => $request->description,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Complaint created successfully!');
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
    public function edit(Complaint $complaint)
    {
        $employee = Employe::where('id', $complaint->emp_id)->exists();
        if (!$employee){
            return back()->withErrors('Employe Not Exist!');
        }
        if(Auth::user()->can('edit complaints')){
            if(\Auth::user()->creatorId() == $complaint->created_by){
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
                return view('admin.complaints.edit', compact('complaint', 'employes'));
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
    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            "employee" =>  'required',
            "against_employee" =>  'required',
            "title" =>  'required',
            "date" => 'required',
            "description" => 'required',
        ]);

        $complaint->update([
            "emp_id" =>  $request->employee,
            "against_emp_id" =>  $request->against_employee,
            "title" =>  $request->title,
            "date" => $request->date,
            "description" => $request->description,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return redirect()->route('admin.complaints.index')->withSuccess('Complaint updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        if(Auth::user()->can('delete complaints')){

            $complaint->delete();
            return back()->withSuccess('Complaint deleted successfully!');
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Termination;
use App\Models\TerminationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage termination')){
            if(Auth::user()->type == 'employee'){
                $employes = Employe::find(Auth::user()->employe->id); 
                $terminations = Termination::where('emp_id' , Auth::user()->employe->id)->orderBy('id', 'DESC')->get();
            }else{
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
                $terminations = Termination::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
            }
            $types = TerminationType::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
    
            return view('admin.terminations.index', compact('terminations', 'employes', 'types'));
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
            "termination_type" => 'required',
            "notice_date" => 'required',
            "terminat_date" => 'required',
            "description" => 'required',
        ]);

        Termination::create([
            "emp_id" => $request->employee,
            "termination_type" => $request->termination_type,
            "notice_date" => $request->notice_date,
            "terminat_date" => $request->terminat_date,
            "description" => $request->description,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Termination created successfully!');
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
    public function edit(Termination $termination)
    {
        $employee = Employe::where('id', $termination->emp_id)->exists();
        if (!$employee){
            return back()->withErrors('Employe Not Exist!');
        }
        if(Auth::user()->can('edit termination')){
            if( \Auth::user()->creatorId() == $termination->created_by){
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
                $types = TerminationType::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
    
                return view('admin.terminations.edit', compact('termination', 'types', 'employes'));   
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
    public function update(Request $request, Termination $termination)
    {
        $request->validate([
            "employee" => 'required',
            "termination_type" => 'required',
            "notice_date" => 'required',
            "terminat_date" => 'required',
            "description" => 'required',
        ]);

        $termination->update([
            "emp_id" => $request->employee,
            "termination_type" => $request->termination_type,
            "notice_date" => $request->notice_date,
            "terminat_date" => $request->terminat_date,
            "description" => $request->description,
        ]);

        return redirect()->route('admin.terminations.index')->withSuccess('Termination updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Termination $termination)
    {
        if(Auth::user()->can('delete termination')){
           $termination->delete();

           return back()->withSuccess('Termination deleted successfully!');
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

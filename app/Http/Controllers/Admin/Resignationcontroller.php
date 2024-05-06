<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Resignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Resignationcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == 'employee'){
            $employes = Employe::find(Auth::user()->employe->id); 
            $resignations = Resignation::where('emp_id' , Auth::user()->employe->id)->orderBy('id', 'DESC')->get();
        }else{
            $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
            $resignations = Resignation::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
        }
      
        return view('admin.resignations.index', compact('resignations', 'employes'));
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
            "date" => 'required',
            "last_date" => 'required',
            "reason" => 'required',
        ]);

        Resignation::create([
            "emp_id" => $request->employee,
            "resig_date" => $request->date,
            "last_date" => $request->last_date,
            "reason" => $request->reason,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Resignation added successfully!');
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
    public function edit(Resignation $resignation)
    {
        
        $employee = Employe::where('id', $resignation->emp_id)->exists();
        if (!$employee){
            return back()->withErrors('Employe Not Exist!');
        }
        if(\Auth::user()->creatorId() == $resignation->created_by){
            $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get(); 

            return view('admin.resignations.edit', compact('resignation', 'employes'));   
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
    public function update(Request $request, Resignation $resignation)
    {
        $request->validate([
            "employee" => 'required',
            "date" => 'required',
            "last_date" => 'required',
            "reason" => 'required',
        ]);

        $resignation->update([
            "emp_id" => $request->employee,
            "resig_date" => $request->date,
            "last_date" => $request->last_date,
            "reason" => $request->reason,
        ]);

        return redirect()->route('admin.resignations.index')->withSuccess('Resignation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resignation $resignation)
    {
        if( Auth::user()->can('delete resignation')){
            $resignation->delete();
             
            return back()->withSuccess('Resignation deleted successfully!');
         }else{
             return back()->withError('Permission Denied!');
         }
    }
}

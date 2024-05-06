<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Designation;
use App\Models\Employe;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage transfer')){
            if(Auth::user()->type == 'employee'){
                $employes = Employe::find(Auth::user()->employe->id); 
                $transfers = Transfer::where('emp_id' , Auth::user()->employe->id)->orderBy('id', 'DESC')->get();
            }else{
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get(); 
                $transfers = Transfer::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
            }
            $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
            $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
    
            return view('admin.transfers.index', compact('transfers', 'employes', 'branches', 'companies'));
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
            "company" => 'required',
            "branch" => 'required',
            "date" => 'required',
            "description" => 'required',
        ]);

        $emp = Employe::find($request->employee);

        Transfer::create([
            "emp_id" => $request->employee,
            "prev_company_id" => $emp->companyDetail->company_id,
            "prev_branch_id" => $emp->companyDetail->branch_id,
            "company_id" => $request->company,
            "branch_id" => $request->branch,
            "date" => $request->date,
            "description" => $request->description,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        $emp->companyDetail->update([
            "company_id" => $request->company,
            "branch_id" => $request->branch,
        ]);

        return back()->withSuccess('Transfer added successfully!');
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
    public function edit(Transfer $transfer)
    {
        $employee = Employe::where('id', $transfer->emp_id)->exists();
        if (!$employee){
            return back()->withErrors('Employe Not Exist!');
        }
        if(Auth::user()->can('edit transfer')){
            if( \Auth::user()->creatorId() == $transfer->created_by){
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get(); 
                $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
                $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
    
                return view('admin.transfers.edit', compact('transfer', 'branches', 'employes', 'companies'));   
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
    public function update(Request $request, Transfer $transfer)
    {
        $request->validate([
            "employee" => 'required',
            "company" => 'required',
            "branch" => 'required',
            "date" => 'required',
            "description" => 'required',
        ]);

        $emp = Employe::find($request->employee);

        $transfer->update([
            "emp_id" => $request->employee,
            "prev_company_id" => $emp->companyDetail->company_id,
            "prev_branch_id" => $emp->companyDetail->branch_id,
            "company_id" => $request->company,
            "branch_id" => $request->branch,
            "date" => $request->date,
            "description" => $request->description,
        ]);

        $emp->companyDetail->update([
            "company_id" => $request->company,
            "branch_id" => $request->branch,
        ]);

        return  redirect()->route('admin.transfers.index')->withSuccess('Transfer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        if(Auth::user()->can('delete transfer')){
           $transfer->delete();

           return back()->withSuccess('Transfer deleted successfully!');
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

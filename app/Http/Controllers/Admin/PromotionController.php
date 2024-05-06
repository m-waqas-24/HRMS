<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Designation;
use App\Models\Employe;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
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
            $promotions = Promotion::where('emp_id' , Auth::user()->employe->id)->get();
        }else{
            $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get(); 
            $promotions = Promotion::where('created_by' , \Auth::user()->creatorId())->get();
        }
        $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
        $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
        $designations = Designation::where('created_by' , \Auth::user()->creatorId())->get();

        return view('admin.promotions.index', compact('promotions', 'employes', 'branches', 'companies', 'designations'));
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
            "designation" => 'required',
            "title" => 'required',
            "date" => 'required',
            "description" => 'required',
        ]);

        $employee = Employe::find($request->employee);

        $employee->companyDetail->update([
            'designation_id' => $request->designation,
        ]);

        Promotion::create([
            "emp_id" => $request->employee,
            "designation_id" => $request->designation,
            "title" => $request->title,
            "date" => $request->date,
            "description" => $request->description,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Promotion added successfully!');
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
    public function edit(Promotion $promotion)
    {
        $employee = Employe::where('id', $promotion->emp_id)->exists();
        if (!$employee){
            return back()->withErrors('Employe Not Exist!');
        }
        if( \Auth::user()->creatorId() == $promotion->created_by){
            $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get(); 
            $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
            $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
            $designations = Designation::where('created_by' , \Auth::user()->creatorId())->get();

            return view('admin.promotions.edit', compact('promotion', 'branches', 'employes', 'companies', 'designations'));   
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
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            "employee" => 'required',
            "designation" => 'required',
            "title" => 'required',
            "date" => 'required',
            "description" => 'required',
        ]);

        $employee = Employe::find($request->employee);

        $employee->companyDetail->update([
            'designation_id' => $request->designation,
        ]);

        $promotion->update([
            "emp_id" => $request->employee,
            "designation_id" => $request->designation,
            "title" => $request->title,
            "date" => $request->date,
            "description" => $request->description,
        ]);

        return redirect()->route('admin.promotions.index')->withSuccess('Promotion updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        if(Auth::user()->can('delete promotions')){
            $promotion->delete();
 
            return back()->withSuccess('Promotion deleted successfully!');
         }
         else
         {
            return back()->withError('Permission Denied!');
         }
    }
}

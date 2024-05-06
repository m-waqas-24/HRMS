<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Trainer;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Employe;
use App\Models\TrainingList;
use App\Models\TrainingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage traininglist')){
            if(Auth::user()->type == 'employee'){
                $trainingLists = TrainingList::where('employee_id' , Auth::user()->employe->id)->get();
            }else{
                $trainingLists = TrainingList::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
            }
            
            $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->get(); 
            $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
            $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
            $trainers = Trainer::where('created_by' , \Auth::user()->creatorId())->get();
            $trainingTypes = TrainingType::where('created_by' , \Auth::user()->creatorId())->get();
            return view('admin.traininglist.index', compact( 'trainingTypes', 'employes', 'branches', 'companies', 'trainers', 'trainingLists'));
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
            "company" =>  'required',
            "branch" => 'required',
            "trainer_option" =>  'required',
            "training_type" =>  'required',
            "trainer" =>  'required',
            "cost" =>  'required',
            "employee" =>  'required',
            "start_date" => 'required',
            "end_date" =>  'required',
        ]);

        TrainingList::create([
            "company_id" =>  $request->company,
            "branch_id" => $request->branch,
            "trainer_option" =>  $request->trainer_option,
            "training_type" =>  $request->training_type,
            "trainer_id" =>  $request->trainer,
            "cost" =>  $request->cost,
            "employee_id" =>  $request->employee,
            "start_date" => $request->start_date,
            "end_date" =>  $request->end_date,
            "created_by" =>  \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Training added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingList $traininglist)
    {
        if(\Auth::user()->creatorId() == $traininglist->created_by){
            return view('admin.traininglist.show', compact('traininglist'));
        }else{
            auth()->logout();
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainingList $traininglist)
    {
        if(Auth::user()->can('edit traininglist')){
            if( \Auth::user()->creatorId() == $traininglist->created_by){
                $branches = Branch::where('created_by' , \Auth::user()->creatorId())->get();
                $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
                $trainers = Trainer::where('created_by' , \Auth::user()->creatorId())->get();
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id', 'DESC')->paginate(20); 
                $trainingTypes = TrainingType::where('created_by' , \Auth::user()->creatorId())->get();   
        
                return view('admin.traininglist.edit', compact('trainingTypes','employes' ,'traininglist', 'branches', 'companies', 'trainers'));
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
    public function update(Request $request, TrainingList $traininglist)
    {
        $request->validate([
            "company" =>  'required',
            "branch" => 'required',
            "trainer_option" =>  'required',
            "training_type" =>  'required',
            "trainer" =>  'required',
            "cost" =>  'required',
            "employee" =>  'required',
            "start_date" => 'required',
            "end_date" =>  'required',
        ]);

        $traininglist->update([
            "company_id" =>  $request->company,
            "branch_id" => $request->branch,
            "trainer_option" =>  $request->trainer_option,
            "training_type" =>  $request->training_type,
            "trainer_id" =>  $request->trainer,
            "cost" =>  $request->cost,
            "employee_id" =>  $request->employee,
            "start_date" => $request->start_date,
            "end_date" =>  $request->end_date,
        ]);

        return redirect()->route('admin.traininglists.index')->withSuccess('Training updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingList $traininglist)
    {
        if(Auth::user()->can('delete traininglist')){
            if( \Auth::user()->creatorId() == $traininglist->created_by){
                $traininglist->delete();

                return back()->withSuccess('Training deleted successfully!');         
            }
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }

    public function updateStatus(Request $request, $id){

        $traininglist = TrainingList::find($id);

        $traininglist->update([
            'performance' => $request->performance,
            'status' => $request->status,
            'remarks' => $request->remarks,
        ]);
        return back();
    }

}

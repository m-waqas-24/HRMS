<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateStatus;
use App\Models\Company;
use App\Models\Employe;
use App\Models\Interview;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == 'company'){
            $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
            $jobs = Job::where(['created_by' => \Auth::user()->creatorId()])->get();
            $candidates = Candidate::where(['created_by' => \Auth::user()->creatorId()])->get();
            $employes = Employe::where(['created_by' => \Auth::user()->creatorId()])->get();
            $interviews = Interview::where(['created_by' => \Auth::user()->creatorId()])->get();
            $candidateStatuses = CandidateStatus::all();
            return view('admin.recruitments.index', compact('companies', 'candidateStatuses', 'jobs', 'candidates', 'employes', 'interviews'));
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
            "company" => 'required',
            "title" => 'required',
            "Job_type" => 'required',
            "vacancy" => 'required',
            "last_date" => 'required',
            "city" => 'required',
            "desc" => 'required',
        ]);

        Job::create([
            "company_id" => $request->company,
            "jobID" => $this->random(),
            "title" => $request->title,
            "slug" => Str::slug($request->title, '-'),
            "status_id" => 1,
            "job_type" => $request->Job_type,
            "vacancy" => $request->vacancy,
            "last_date" => $request->last_date,
            "city" => $request->city,
            "description" => $request->desc,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return redirect()->back()->withSuccess('Job created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $recruitment)
    {
        if(\Auth::user()->creatorId() == $recruitment->created_by){
            return view('admin.recruitments.show', compact('recruitment'));
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
    public function edit(Job $recruitment)
    {
        if(Auth::user()->type == 'company'){
            if(\Auth::user()->creatorId() == $recruitment->created_by){
                $companies = Company::where('created_by' , \Auth::user()->creatorId())->get();
                return view('admin.recruitments.edit', compact('recruitment', 'companies'));
            }else{
                auth()->logout();
                abort(403);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $recruitment)
    {
        // dd($request->all());
        $request->validate([
            "company" => 'required',
            "title" => 'required',
            "Job_type" => 'required',
            "vacancy" => 'required',
            "last_date" => 'required',
            "city" => 'required',
            "desc" => 'required',
        ]);

        $recruitment->update([
            "company_id" => $request->company,
            "title" => $request->title,
            "slug" => Str::slug($request->title, '-'),
            "status_id" => $request->status,
            "job_type" => $request->Job_type,
            "vacancy" => $request->vacancy,
            "last_date" => $request->last_date,
            "city" => $request->city,
            "description" => $request->desc,
        ]);

        return redirect()->route('admin.recruitments.index')->withSuccess('Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function random()
    {
        do{
            $next = random_int(1,9999);
            $code = "#".$next;
        }while(Job::where('jobID','=', $code)->first());

        return $code;
    }

}

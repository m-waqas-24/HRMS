<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Employe;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'candidate' => 'required',
            'interviewer' => 'required',
            'datetime' => 'required',
        ]);

        Interview::create([
            'candidate_id' => $request->candidate,
            'emp_id' => $request->interviewer,
            'date_time' => $request->datetime,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Interview Schedule successfully!');
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
    public function edit(Interview $interview)
    {
        if(Auth::user()->can('edit interviewschedule')){
            if( \Auth::user()->creatorId() == $interview->created_by){
                $candidates = Candidate::where(['created_by' => \Auth::user()->creatorId()])->get();
                $employes = Employe::where(['created_by' => \Auth::user()->creatorId()])->get();
                return view('admin.interview.edit', compact('interview', 'candidates', 'employes'));
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
    public function update(Request $request, Interview $interview)
    {
        $request->validate([
            'candidate' => 'required',
            'interviewer' => 'required',
            'datetime' => 'required',
        ]);

        $interview->update([
            'candidate_id' => $request->candidate,
            'emp_id' => $request->interviewer,
            'date_time' => $request->datetime,
        ]);

        return redirect()->route('admin.recruitments.index')->withSuccess('Interview Schedule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete interviewschedule')){
           
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

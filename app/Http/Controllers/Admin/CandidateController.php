<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
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
            'job' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'resume' => 'required',
        ]);

        $file = null;
        if ($request->file('resume')) {
            $path = $request->file('resume');
            $target = 'public/candidate_resume';
            $file = Storage::putFile($target, $path);
            $file = substr($file, 7, strlen($file) - 7);
        }

        Candidate::create([
            'job_id' => $request->job,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'file' => $file,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Candidate added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        if(Auth::user()->can('edit candidates')){
            if( \Auth::user()->creatorId() == $candidate->created_by ){
                $jobs = Job::where('created_by' , \Auth::user()->creatorId())->get();
                return view('admin.candidate.edit', compact('candidate', 'jobs'));
            }else{
                auth()->logout();
                abort(403);
            }
        }else{
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
    public function update(Request $request, Candidate $candidate)
    {
        // dd($request->all());
        $request->validate([
            'job' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $file = $candidate->file;
        if ($request->file('resume')) {
            $path = $request->file('resume');
            $target = 'public/candidate_resume';
            if ($file) {
                // Unlink existing file if it exists
                $existingFilePath = public_path('storage/' . $file);
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
            }
            $file = Storage::putFile($target, $path);
            $file = substr($file, 7, strlen($file) - 7);
        }

        $candidate->update([
            'job_id' => $request->job,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'file' => $file,
        ]);

        return redirect()->route('admin.recruitments.index')->withSuccess('Candidate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete candidates')){
           
        }else{
            return back()->withError('Permission Denied!');
        }
    }
}

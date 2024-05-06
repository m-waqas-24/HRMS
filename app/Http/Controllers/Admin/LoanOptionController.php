<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanOption;
use Illuminate\Http\Request;

class LoanOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loanTypes = LoanOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->paginate(12);
    
        return view('admin.settings.loanoptions', compact('loanTypes'));
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
            'name' => 'required',
        ]);

        LoanOption::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Loan option created successfully!');
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
    public function edit(LoanOption $loantype)
    {
        if(\Auth::user()->creatorId() == $loantype->created_by){

            return view('admin.loanoptions.edit', compact('loantype'));
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
    public function update(Request $request, LoanOption $loantype)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $loantype->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.loantypes.index')->withSuccess('Loan option updated successfully!');
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
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
    public function store(Request $request, $empId)
    {
        $request->validate([
            'loan_option' => 'required',
            'amount' => 'required',
        ]);

        Loan::create([
            'emp_id' => $empId,
            'loan_option' => $request->loan_option,
            'amount' => $request->amount,
            'reason' => $request->reason,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Loan added successfully!');
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
    public function edit(Request $request)
    {
        $loanId = $request->loanId;
        $loan = Loan::where('id', $loanId)->where('created_by', \Auth::user()->creatorId())->first();

        return response()->json([ 'loan' => $loan ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'loan_option' => 'required',
            'amount' => 'required',
        ]);
        
        $loan = Loan::where('id', $id)->where('created_by', \Auth::user()->creatorId())->first();

        $loan->update([
            'loan_option' => $request->loan_option,
            'amount' => $request->amount,
            'reason' => $request->reason,
        ]);

        return back()->withSuccess('Loan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        if($loan->created_by == \Auth::user()->creatorId()){

            $loan->delete();

            return back()->withSuccess('Loan deleted successfully!');
        }else{
            auth()->logout();
           abort(403);
        }
    }
}

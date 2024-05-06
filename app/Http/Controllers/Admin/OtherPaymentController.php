<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OtherPayment;
use Illuminate\Http\Request;

class OtherPaymentController extends Controller
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
            'title' => 'required',
            'amount' => 'required',
        ]);

        OtherPayment::create([
            'emp_id' => $empId,
            'title' => $request->title,
            'amount' => $request->amount,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Other Payment added successfully!');
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
        $opId = $request->opId;
        $op = OtherPayment::where('id', $opId)->where('created_by', \Auth::user()->creatorId())->first();

        return response()->json([ 'op' => $op ]);
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
            'title' => 'required',
            'amount' => 'required',
        ]);

        $op = OtherPayment::where('id', $id)->where('created_by', \Auth::user()->creatorId())->first();

        $op->update([
            'title' => $request->title,
            'amount' => $request->amount,
        ]);

        return back()->withSuccess('Other Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherPayment $otherpayment)
    {
        if($otherpayment->created_by == \Auth::user()->creatorId()){

            $otherpayment->delete();

            return back()->withSuccess('Other Payment deleted successfully!');
        }else{
            auth()->logout();
           abort(403);
        }
    }
}

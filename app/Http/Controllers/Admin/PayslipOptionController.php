<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaySlipOption;
use Illuminate\Http\Request;

class PayslipOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payslipTypes = PaySlipOption::where('created_by' , \Auth::user()->creatorId() )->orderBy('id','DESC')->paginate(12);
    
        return view('admin.settings.payslipoptions', compact('payslipTypes'));
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

        PaySlipOption::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Payslip option created successfully!');
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
    public function edit(PaySlipOption $paysliptype)
    {
        if(\Auth::user()->creatorId() == $paysliptype->created_by){
            return view('admin.payslipoptions.edit', compact('paysliptype'));
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
    public function update(Request $request, PaySlipOption $paysliptype)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $paysliptype->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.paysliptypes.index')->withSuccess('Payslip option created successfully!');
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

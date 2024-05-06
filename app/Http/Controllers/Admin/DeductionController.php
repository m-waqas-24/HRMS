<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeductionController extends Controller
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
            'deduction_option' => 'required',
            'amount' => 'required',
        ]);

        Deduction::create([
            'emp_id' => $empId,
            'deduction_option' => $request->deduction_option,
            'amount' => $request->amount,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Deduction added successfully!');
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
        if(Auth::user()->can('edit deduction ')){
            $deductionId = $request->deductionId;
            $deduction = Deduction::where('id', $deductionId)->where('created_by', \Auth::user()->creatorId())->first();
    
            return response()->json([ 'deduction' => $deduction ]);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'deduction_option' => 'required',
            'amount' => 'required',
        ]);

        $deduction = Deduction::where('id', $id)->where('created_by', \Auth::user()->creatorId())->first();

        $deduction->update([
            'deduction_option' => $request->deduction_option,
            'amount' => $request->amount,
        ]);

        return back()->withSuccess('Deduction updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
        if(Auth::user()->can('delete deduction ')){
            if($deduction->created_by == \Auth::user()->creatorId()){

                $deduction->delete();
    
                return back()->withSuccess('Deduction deleted successfully!');
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
}

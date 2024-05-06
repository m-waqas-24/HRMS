<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllowanceController extends Controller
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
            'allowance_option' => 'required',
            'amount' => 'required',
        ]);

        Allowance::create([
            'emp_id' => $empId,
            'allowance_option' => $request->allowance_option,
            'amount' => $request->amount,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Allowance added successfully!');

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
        if(Auth::user()->can('edit allowance ')){
            $allowanceID = $request->allowanceId;
            $allowance = Allowance::where('id', $allowanceID)->where('created_by', \Auth::user()->creatorId() )->first();

            return response()->json([ 'allowance' => $allowance ]);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'allowance_option' => 'required',
            'amount' => 'required',
        ]);

        $allowance = Allowance::find($id);

        $allowance->update([
            'allowance_option' => $request->allowance_option,
            'amount' => $request->amount,
        ]);

        return back()->withSuccess('Allowance updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allowance $allowance)
    {
        if(Auth::user()->can('delete allowance ')){

            if($allowance->created_by == \Auth::user()->creatorId()){

                $allowance->delete();
    
                return back()->withSuccess('Allowance deleted successfully!');
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

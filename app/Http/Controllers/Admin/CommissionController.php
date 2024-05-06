<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
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

        Commission::create([
            'emp_id' => $empId,
            'title' => $request->title,
            'amount' => $request->amount,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Commission added successfully!');
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
        if(Auth::user()->can('edit commission')){
            $commissionId = $request->commissionId;
            $commission = Commission::where('id', $commissionId)->where('created_by', \Auth::user()->creatorId())->first();
    
            return response()->json([ 'commission' => $commission ]);
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
            'title' => 'required',
            'amount' => 'required',
        ]);

        $commission = Commission::where('id', $id)->where('created_by', \Auth::user()->creatorId())->first();

        $commission->update([
            'title' => $request->title,
            'amount' => $request->amount,
        ]);

        return back()->withSuccess('Commission updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commission)
    {
        if(Auth::user()->can('delete commission')){
            if($commission->created_by == \Auth::user()->creatorId()){

                $commission->delete();
    
                return back()->withSuccess('Commission deleted successfully!');
            }else{
                auth()->logout();
               abort(403);
            }
        }else{
            return back()->withError('Permission Denied!');
        }
    }
}

<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::where('created_by', Auth::user()->id)->get();
        return view('superadmin.plans.index', compact('plans'));
    }

    public function store(Request $request){

        $request->validate([
            "name" => 'required',
            "price" => 'required',
            "duration" => 'required',
        ]);

        if($request->hrm){
            $hrm = 1;
        }else{
            $hrm = 0;
        }
        if($request->accounts){
            $accounts = 1;
        }else{
            $accounts = 0;
        }

        Plan::create([
            "name" => $request->name,
            "price" => $request->price,
            "duration" => $request->duration,
            "description" => $request->description,
            "hrm" => $hrm,
            "accounts" => $accounts,
            "created_by" => Auth::user()->id,
        ]);

        return back();
    }

    public function edit(Request $request){

        $planId = $request->planId;
        $plan = Plan::find($planId);

        return response()->json(['plan' => $plan]);
    }

    public function update(Request $request, $id){
        $request->validate([
            "name" => 'required',
            "price" => 'required',
            "duration" => 'required',
        ]);

        $plan = Plan::find($id);

        if($request->hrm){
            $hrm = 1;
        }else{
            $hrm = 0;
        }
        if($request->accounts){
            $accounts = 1;
        }else{
            $accounts = 0;
        }

        $plan->update([
            "name" => $request->name,
            "price" => $request->price,
            "duration" => $request->duration,
            "description" => $request->description,
            "hrm" => $hrm,
            "accounts" => $accounts,
        ]);

        return back()->withSuccess('Plan updated sucessfully!');
    }

}

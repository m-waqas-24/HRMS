<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\SystemSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){

        $plans = Plan::where('created_by', Auth::user()->id)->get();
        $users = User::with('plan', 'employe')
        ->where('created_by', auth()->user()->id)
        ->get();
        return view('superadmin.users.index', compact('plans', 'users'));
    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:8',
            
        ]);

        $existingUser = User::where('email', $request->email)->first();

        if($existingUser){
            return back()->withErrors('Email already exist!');
        }

        $plan = Plan::find($request->plan);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'type' => 'company',
            'plan' => $plan->id,
            'created_by' => Auth::user()->id,
            'subscription_start_date' => Carbon::now(),
        ]);

        if ($plan->duration == 'Monthly') {
            $user->update([
                'subscription_end_date' => Carbon::now()->addMonth(),
            ]);
        } elseif ($plan->duration == 'Yearly') {
            $user->update([
                'subscription_end_date' => Carbon::now()->addYear(),
            ]);
        } elseif ($plan->duration == 'Lifetime') {
            $user->update([
                'subscription_end_date' => null,
            ]);
        }

        if($plan->hrm){
            //hrm permissions
            userDefaultRolesPermissions($user->id);
        }
       
        if($plan->accounts){
             //account permissions
            userAccountPermissions($user->id);
        }

        userDefaultSystemSetting($user->id);

        return back()->with('success','User created successfully');
    }


    public function editUser(Request $request){
        $userID = $request->userId;
        $user = User::find($userID);

        return response()->json(['user' => $user]);
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email'=> 'required',
        ]);

        $user = User::find($id);
        $plan = Plan::find($request->plan);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'plan' => $plan->id,
            'subscription_end_date' => $request->expired,
        ]);

        // if ($plan->duration == 'Monthly') {
        //     $user->update([
        //         'subscription_end_date' => \Carbon\Carbon::parse($user->subscription_end_date)->addMonth(),
        //     ]);
        // } elseif ($plan->duration == 'Yearly') {
        //     $user->update([
        //         'subscription_end_date' => \Carbon\Carbon::parse($user->subscription_end_date)->addYear(),
        //     ]);
        // } elseif ($plan->duration == 'Lifetime') {
        //     $user->update([
        //         'subscription_end_date' => null,
        //     ]);
        // }
        
        $user->syncRoles([]);

        if($plan->hrm){
            userDefaultRolesPermissions($user->id);
        }
       
        if($plan->accounts){
            userAccountPermissions($user->id);
        }


        return back()->with('success','User updated successfully');
    }


}

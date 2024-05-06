<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.profile');
    }

    public function updateProfile(Request $request){
        $user = User::find(Auth::user()->id);

        if($request->name){
            $user->name = $request->name;
        }
        if($request->email){
            $user->email = $request->email;
        }

        $user->save();

        return back()->withSuccess('Profile updated successfully!');
    }

    public function updatePhoto(Request $request){
        $user = User::find(Auth::user()->id);

        if ($request->hasFile('avatar')) {
            if (file_exists(public_path('storage/' . $user->avatar)) && $user->avatar) {
                unlink(public_path('storage/' . $user->avatar));
            }
            $path = $request->file('avatar');
            $target = 'public/user-avatar';
            $avatar = Storage::putFile($target, $path);
            $avatar = substr($avatar, 7, strlen($avatar) - 7);
            $user->avatar = $avatar;
            $user->save();
        }

        return back()->withSuccess('Profile photo updated successfully!');
    }


    public function updatePassword(Request $request){

        $request->validate([
            'current_password' => "required",
            "password" => "required|min:8|confirmed",
        ]);
        
        $userId = Auth::id();
        $user = User::where('id',$userId)->first();

        if(!Hash::check($request->current_password, $user->password)){
            return redirect()->back()->withErrors('The current password is incorrect.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->withSuccess("Password Updated Successfully!");
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function index(){
        if(Auth::user()->type == 'company'){
            $users = User::where('created_by', \Auth::user()->creatorId())->paginate(12);
            $roles = Role::where('created_by', \Auth::user()->creatorid())->get();
            return view('admin.user-management.user-list', compact('users', 'roles'));
        }
        else{
            return back()->withErrors('Permission Denied!');
        }
    }

    public function edit(Request $request){
        $userId = $request->userId;
        $user = User::find($userId);
        $roleId = $user->roles->pluck('id')->first();

        return response()->json(['user' => $user, 'roleId' => $roleId]);
    }

    public function update(Request $request, $id){

        $roleId = $request->role;
        $role = Role::find($roleId);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles([$role->name]);
        $user->save();

        return back()->withSuccess('User updated succcessfully!');
    }

    public function updatePassword(Request $request, $id){
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->withSuccess('Password updated succcessfully!');
    }

    public function deleteUser($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            if(@$user->employe){
                $user->employe->delete();
            }
            return back()->with('success', 'User deleted succcessfully!');
        }else{
            return back()->with('success', 'User does not exist!');
        }
    }


    // =========================================  Roles function =========================================
    public function allRoles(){
        if(Auth::user()->type == 'company'){
            $roles = Role::where('created_by', \Auth::user()->creatorId())->get();
            return view('admin.user-management.roles.roles', compact('roles'));
        }
        else{
            return back()->withErrors('Permission Denied!');
        }
    }

    public function createRole(){
        $permissions = Permission::where('mod_id', 1)->get();
        $accpermissions = Permission::where('mod_id', 2)->get();

        return view('admin.user-management.roles.create', compact('permissions', 'accpermissions'));
    }

    public function storeRole(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $roleExist = Role::where('name', $request->name)->where('created_by', \Auth::user()->creatorId())->first();
        if($roleExist){
            return back()->withErrors('Role name already exist');
        }


        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
            'created_by' => \Auth::user()->creatorId(),
        ]);

        $permissions = $request->permissions;
        $role->syncPermissions($permissions);

        return redirect()->route('admin.index.roles')->withSuccess('Role created successfully!');
    }


    public function editrole($id){
        if(Auth::user()->type == 'company'){
            $permissions = Permission::all();
            $hrmpermissions = Permission::where('mod_id', 1)->get();
            $accpermissions = Permission::where('mod_id', 2)->get();

            $role = Role::find($id);

            $rolepermissions = $role->permissions;
            
            return view('admin.user-management.roles.edit-role', compact('role' , 'permissions', 'rolepermissions', 'hrmpermissions', 'accpermissions'));
        }
        else{
            return back()->withErrors('Permission Denied!');
        }
    }


    public function updaterole(Request $request, $id){
        $role = Role::find($id);

        if (!$role) {
            abort(404, 'Role not found');
        }

        $role->name = $request->name;
        $role->save();
    
        $permissions = $request->permissions;

        $role->syncPermissions($permissions);

        return redirect()->route('admin.index.roles')->withSuccess('Role updated successfully!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IpRestriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IpRestrictionController extends Controller
{
    public function index(){
        if(Auth::user()->can('manage ip-restriction')){
            $ips = IpRestriction::where('created_by', \Auth::user()->creatorId())->get();
            return view('admin.settings.ip', compact('ips'));
        } 
        else
        {
           return back()->withError('Permission Denied!');
        }
    }


    public function store(Request $request){
        $request->validate([
            'ip' => 'required',
        ]);

        IpRestriction::create([
            'ip' => $request->ip,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('IP created successfully!');
    }

    public function edit($id){

        if(Auth::user()->can('edit ip-restriction')){
            $ip = IpRestriction::find($id);

            return view('admin.ip.edit', compact('ip'));
        } 
        else
        {
           return back()->withError('Permission Denied!');
        }
    }

    public function update(Request $request, $id){
          $request->validate([
            'ip' => 'required',
        ]);

        $ip = IpRestriction::find($id);

        $ip->update([
            'ip' => $request->ip,
        ]);

        return redirect()->route('admin.index.ip')->withSuccess('IP updated successfully!');
    }
}

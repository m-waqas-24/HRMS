<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemSettingController extends Controller
{
    public function index(){
        
            $system = SystemSetting::where('created_by', \Auth::user()->creatorId())->first();
            return view('system-settings.system-settings', compact('system'));
    }

    public function store(Request $request){
      
        $system = SystemSetting::where('created_by', \Auth::user()->creatorId())->first();


            if($system){
                $system->update([
                    "currency_symbol" => $request->currency_symbol ?? $system->currency_symbol,    
                    "currency_position" => $request->currency_position ?? $system->currency_position,    
                    "emp_prefix" => $request->employee_prefix ?? $system->emp_prefix,    
                    "inv_prefix" => $request->invoice_prefix ?? $system->inv_prefix, 
                ]);
            }else{
                SystemSetting::create([
                    "currency_symbol" => $request->currency_symbol,    
                    "currency_position" => $request->currency_position,  
                    "emp_prefix" => $request->employee_prefix,    
                    "inv_prefix" => $request->invoice_prefix, 
                    "created_by" => \Auth::user()->creatorId(), 
                ]);
            }
            
            return back()->withSuccess('System Setting updated successfully!');
    }

}

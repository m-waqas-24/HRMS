<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Gift;
use App\Models\Payslip;
use App\Models\PayslipOption;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function settings(){
        if(Auth::user()->can('manage company-settings')){
            return view('admin.settings.index');
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }

    public function awardSettings(){
        if(Auth::user()->can('manage award-type')){
            $awardsTypes = Type::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->paginate(12);
            return view('admin.settings.awardtypes', compact('awardsTypes'));
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
    public function paysliptypeSettings(){

        if(Auth::user()->can('manage payslip-options')){
            $payslipTypes = PayslipOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->paginate(12);
    
            return view('admin.settings.payslip', compact('payslipTypes'));           
        }
            else
        {
           return back()->withError('Permission Denied!');
        }
    }




    //system settings last
    public function syssettings(){
        return view('system-settings.index');

    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{
    public function index(){
            $creatorId = \Auth::user()->creatorId();    
            $companySetting = CompanySetting::where('created_by', $creatorId)->first();
            return view('system-settings.index', compact('companySetting'));
    } 

    public function store(Request $request){
        // dd($request->all());
      
        $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();

        if($company){
            if ($request->logoDark) {
                $path = $request->logoDark;
                $target = 'public/company_images';
                $logoDark = Storage::putFile($target, $path);
                $logoDark = substr($logoDark, 7, strlen($logoDark) - 7);
            }
            if ($request->logoLight) {
                $path = $request->logoLight;
                $target = 'public/company_images';
                $logoLight = Storage::putFile($target, $path);
                $logoLight = substr($logoLight, 7, strlen($logoLight) - 7);
            }
            if ($request->favicon) {
                $path = $request->favicon;
                $target = 'public/company_images';
                $faviconfile = Storage::putFile($target, $path);
                $faviconfile = substr($faviconfile, 7, strlen($faviconfile) - 7);
            }

            $company->update([
                'logoDark' => $request->logoDark ? $logoDark : $company->logoDark,
                'logoLight' =>  $request->logoLight ? $logoLight : $company->logoLight,
                'favicon' => $request->favicon ? $faviconfile : $company->favicon,
            ]);

            return back()->withSuccess('Company profile updated!');
        }else{
        
            $logoDark = null;
            if ($request->logoDark) {
                $path = $request->logoDark;
                $target = 'public/company_images';
                $logoDark = Storage::putFile($target, $path);
                $logoDark = substr($logoDark, 7, strlen($logoDark) - 7);
            }
            $logoLight = null;
            if ($request->logoLight) {
                $path = $request->logoLight;
                $target = 'public/company_images';
                $logoLight = Storage::putFile($target, $path);
                $logoLight = substr($logoLight, 7, strlen($logoLight) - 7);
            }
            $faviconfile = null;
            if ($request->favicon) {
                $path = $request->favicon;
                $target = 'public/company_images';
                $faviconfile = Storage::putFile($target, $path);
                $faviconfile = substr($faviconfile, 7, strlen($faviconfile) - 7);
            }
            CompanySetting::create([
                'logoDark' => $logoDark,
                'logoLight' => $logoLight,
                'favicon' => $faviconfile,
                'created_by' => \Auth::user()->creatorId(),
            ]);

            return back()->withSuccess('Company profile created!');

        }
    }

    public function updateIpRestrict(Request $request){
        $ipRestrictValue = $request->ipRestrictValue;

        $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();
        if($company){
            $company->update([
                'ip_restrict' => $ipRestrictValue,
            ]);
        }else{
            CompanySetting::create([
                'ip_restrict' => $ipRestrictValue,
                'created_by' => \Auth::user()->creatorId(),
            ]);
        }

        return response()->json(['success' => 'updated!']);
    }

}

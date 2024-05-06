<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetStatus;
use App\Models\Employe;
use App\Models\EmployeeAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage employee-assets')){
            if(Auth::user()->type == "employee"){
                $employeAssets = Employe::find(Auth::user()->employe->id)->has('assets')->get();
                $employes = Employe::find(Auth::user()->employe->id);
            }else{
                $employeAssets = Employe::withTrashed()
                ->where('created_by', \Auth::user()->creatorId())
                ->has('assets')
                ->get();            
                $employes = Employe::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
            }
            $assets = Asset::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
    
            return view('admin.employee-assets.index', compact('assets', 'employes', 'employeAssets'));
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
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

    public function store(Request $request)
    {
        $request->validate([
            'employee' => 'required',
            'asset' => 'required',
        ]);

        $assetIds = $request->asset;
        $empId = $request->employee;

        $existingRecords = EmployeeAsset::where('emp_id', $empId)->get();
        $existingassetIds = $existingRecords->pluck('asset')->toArray();

        foreach ($assetIds as $id) {
            $existingAssetWithStatus1Or2 = $existingRecords->where('asset', $id)
                                                            ->whereIn('status', [1, 2])
                                                            ->first();

            if (!$existingAssetWithStatus1Or2) {
                EmployeeAsset::create([
                    'emp_id' => $empId,
                    'asset' => $id,
                    'created_by' => \Auth::user()->creatorId(),
                ]);

                $asset = Asset::find($id);

                if ($asset) {
                    $assigned = $asset->assigned;
                    $free = $asset->free;

                    $asset->update([
                        'assigned' => $assigned + 1,
                        'free' => $free - 1,
                    ]);
                }

            } elseif ($existingAssetWithStatus1Or2) {
                return redirect()->back()->withErrors( $existingAssetWithStatus1Or2->assetName->name . ' already exist for this employee!');
            }
        }

        return redirect()->back()->withSuccess('Assets added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->can('show employee-assets')){
            $empasset = EmployeeAsset::where('emp_id', $id)->get();
            $assetStatus = AssetStatus::all();
            $employeName = Employe::withTrashed()->find($id)->name;
            return view('admin.employee-assets.show', compact('empasset', 'employeName', 'assetStatus'));
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(Auth::user()->can('edit employee-assets')){
            $emp_asset_id = $request->assetId; 
            $emp_asset = EmployeeAsset::find($emp_asset_id); 

            return response()->json([ 'emp_asset' => $emp_asset ]);
        }
        else
        {
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
    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $empassetId = $request->id;
        $statusId = $request->status;
        $empasset = EmployeeAsset::find($empassetId);

        $empasset->update([
            'status' => $statusId,
        ]);

        return back()->withSuccess('Status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete employee-assets')){
           
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

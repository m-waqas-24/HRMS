<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage assets ')){
            $assets = Asset::where('created_by' , \Auth::user()->creatorId() )->orderBy('id','DESC')->get();
            return view('admin.settings.assets', compact('assets'));
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
            "name" => 'required',
            "total_asset" => 'required',
        ]);

        Asset::create([
            "name" => $request->name,
            "total_asset" => $request->total_asset,
            "assigned" => 0,
            "free" => $request->total_asset,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Asset created successfully!');
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
    public function edit(Asset $asset)
    {
        if(Auth::user()->can('edit assets ')){
            if ( \Auth::user()->creatorId() == $asset->created_by) {
                return view('admin.assets.edit', compact('asset'));
            } else {
                auth()->logout();
                return abort(403); 
            }
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
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            "name" => 'required',
            "total_asset" => 'required',
        ]);

        if($request->total_asset < $asset->assigned){
            return back()->withErrors('Total should be greater then assigned values');
        }
        
            $diff = $request->total_asset - $asset->total_asset;
            $newfree = $diff + $asset->free;

        $asset->update([
            "name" => $request->name,
            "total_asset" => $request->total_asset,
            "free" => $newfree,
        ]);

        return redirect()->route('admin.assets.index')->withSuccess('Asset updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete assets ')){
           
        }else{
            return back()->withError('Permission Denied!');
        }
    }
}

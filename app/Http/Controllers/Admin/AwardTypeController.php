<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwardType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage award-type')){
            $awardTypes = AwardType::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->paginate(12);
    
            return view('admin.settings.awardtypes', compact('awardTypes'));
        }else{
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
            'name' => 'required',
        ]);

        AwardType::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Award option created successfully!');
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
    public function edit(AwardType $awardtype)
    {
        if(Auth::user()->can('edit award-type')){

            if(\Auth::user()->creatorId() == $awardtype->created_by){
                return view('admin.awardoptions.edit', compact('awardtype'));
            }else{
                auth()->logout();
                abort(403);
            }

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
    public function update(Request $request, AwardType $awardtype)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $awardtype->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.awardtypes.index')->withSuccess('Awards option updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete award-type')){
           
        }else{
            return back()->withError('Permission Denied!');
        }
    }
}

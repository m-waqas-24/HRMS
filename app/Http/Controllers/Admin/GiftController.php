<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage gifts')){
            $gifts = Gift::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->paginate(12);
            return view('admin.settings.gifts', compact('gifts'));
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
            'name' => 'required',
        ]);

        Gift::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Gift created successfully!');
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
    public function edit(Gift $gift)
    {
        if(Auth::user()->can('edit gifts')){
            if (\Auth::user()->creatorId() == $gift->created_by) {
    
                return view('admin.gifts.edit', compact('gift'));
    
            } else {
                auth()->logout();
                return abort(403); 
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
    public function update(Request $request, Gift $gift)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $gift->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.gifts.settings')->withSuccess('Gift updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete gifts')){
           
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

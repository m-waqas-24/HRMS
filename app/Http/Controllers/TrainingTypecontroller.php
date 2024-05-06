<?php

namespace App\Http\Controllers;

use App\Models\TrainingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingTypecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage training-type')){
            $trainingTypes = TrainingType::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
    
            return view('admin.settings.trainingtypes', compact('trainingTypes'));
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

        TrainingType::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Training Type created successfully!');
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
    public function edit(TrainingType $trainingtype)
    {
        if(Auth::user()->can('edit training-type')){
            if( \Auth::user()->creatorId() == $trainingtype->created_by){

                return view('admin.training-types.edit', compact('trainingtype'));
            }else{
                auth()->logout();
                abort(403);
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
    public function update(Request $request, TrainingType $trainingtype)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $trainingtype->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.trainingtypes.index')->withSuccess('Training Type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

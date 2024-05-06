<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Employe;
use App\Models\Gift;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::user()->can('manage awards')){
            if(Auth::user()->type == 'employee'){
                $employees = Employe::find(Auth::user()->employe->id);
                $awards = Award::where('emp_id' , Auth::user()->employe->id)->get();
            }else{
                $employees = Employe::where('created_by' , \Auth::user()->creatorId())->get();
                $awards = Award::where('created_by' , \Auth::user()->creatorId())->get();
            }
            $types = Type::all();
            $gifts = Gift::where('created_by' , \Auth::user()->creatorId())->get();
           
            return view('admin.awards.index', compact('employees', 'types', 'gifts', 'awards'));
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
            "employee" => 'required',
            "award_type" => 'required',
            "gift" => 'required',
            "date" => 'required',
        ]);

        Award::create([
            "emp_id" => $request->employee,
            "type_id" => $request->award_type,
            "gift_id" => $request->gift,
            "date" => $request->date,
            "desc" => $request->description,
            "created_by" => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Award added successfully!');
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
    public function edit(Award $award)
    {

        $employee = Employe::where('id', $award->emp_id)->exists();
        if (!$employee){
            return back()->withErrors('Employe Not Exist!');
        }

        if(Auth::user()->can('edit awards')){

            if( \Auth::user()->creatorId() == $award->created_by ){
                $employees = Employe::where('created_by' , \Auth::user()->creatorId())->get();
                $types = Type::all();
                $gifts = Gift::where('created_by' , \Auth::user()->creatorId())->get();
        
                return view('admin.awards.edit', compact('award', 'employees', 'types', 'gifts'));
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
    public function update(Request $request, Award $award)
    {
        $request->validate([
            "employee" => 'required',
            "award_type" => 'required',
            "gift" => 'required',
            "date" => 'required',
        ]);

        $award->update([
            "emp_id" => $request->employee,
            "type_id" => $request->award_type,
            "gift_id" => $request->gift,
            "date" => $request->date,
            "desc" => $request->description,
        ]);

        return redirect()->route('admin.awards.index')->withSuccess('Award updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        if( Auth::user()->can('delete awards')){
           $award->delete();
            
           return back()->withSuccess('Award deleted successfully!');
        }else{
            return back()->withError('Permission Denied!');
        }
    }
}

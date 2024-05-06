<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Holiday;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage holidays')){
            $holidays = Holiday::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
            return view('admin.holidays.index', compact('holidays'));
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
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $holiday = Holiday::create([
            'title' => $request->title,
            'start_date' =>  $request->start_date,
            'end_date' =>  $request->end_date,
            'created_by' =>  \Auth::user()->creatorId(),
        ]);

        // $emails = User::where('created_by', \Auth::user()->creatorId())->pluck('email');
        // $chunkSize = 50;
        
        // $data = $holiday->toArray();
        // $subject  = 'Holiday Notification'; 
        
        // collect($emails)->chunk($chunkSize)->each(function ($chunk) use ($data, $subject) {
        //     foreach ($chunk as $email) {
        //         dispatch(new SendEmailJob($email, $data, $subject, 'admin.mails.holidaymail'));
        //     }
        // });
        

        return redirect()->back()->withSuccess('Holiday added succesfully!');
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
    public function edit(Holiday $holiday)
    {
        if(Auth::user()->can('edit holidays')){
            if (\Auth::user()->creatorId() == $holiday->created_by) {
    
                return view('admin.holidays.edit', compact('holiday'));
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
    public function update(Request $request, Holiday $holiday)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $holiday->update([
            'title' => $request->title,
            'start_date' =>  $request->start_date,
            'end_date' =>  $request->end_date,
        ]);

        return redirect()->route('admin.holidays.index')->withSuccess('Holiday updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        if(Auth::user()->can('delete holidays')){
            if($holiday){
                $holiday->delete();
            }
    
            return back()->withSuccess('Holiday deleted successfully!');
        }
        else
        {
           return back()->withError('Permission Denied!');
        }
    }
}

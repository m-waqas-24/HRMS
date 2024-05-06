<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeSlotController extends Controller
{
    public function index(){
        if(Auth::user()->can('manage attendance-timeslots')){
            $timeSlots = TimeSlot::where('created_by', \Auth::user()->creatorId())->get();
            return view('admin.settings.time-slots', compact('timeSlots'));
        }
        else{
            return back()->withErrors('Permission Denied!');
        }
    }


    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'late_minute' => 'required',
        ]);

        TimeSlot::create([
            'name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'late_minute' => $request->late_minute,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Time-slots created successfully!');
    }

    public function edit($id){
        if(Auth::user()->can('edit attendance-timeslots')){
            $timeslot = TimeSlot::find($id);

            return view('admin.timeslots.edit-timeslot', compact('timeslot'));
        }
        else{
            return back()->withErrors('Permission Denied!');
        }
    }

    public function update(Request $request, $id){
          $request->validate([
            'name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'late_minute' => 'required',
        ]);

        $timeslot = TimeSlot::find($id);

        $timeslot->update([
            'name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'late_minute' => $request->late_minute,
        ]);

        return redirect()->route('admin.index.time-slots')->withSuccess('Time-slots updated successfully!');
    }

}

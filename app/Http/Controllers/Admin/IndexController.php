<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CompanySetting;
use App\Models\Department;
use App\Models\Employe;
use App\Models\Event;
use App\Models\Holiday;
use App\Models\Job;
use App\Models\Leave;
use App\Models\NoticeBoard;
use App\Models\TrainingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class IndexController extends Controller
{
    public function dashboard(){ 

        $notices = NoticeBoard::where('created_by' , \Auth::user()->creatorId())->get();
        $events = Event::where('created_by' , \Auth::user()->creatorId())->get();
        $maleCount = Employe::where('gender',1)->where('created_by' , \Auth::user()->creatorId())->count();
        $femaleCount = Employe::where('gender',2)->where('created_by' , \Auth::user()->creatorId())->count();
        $hiredCandid = Candidate::where('status_id', 1)->get();
        $employeCount = Employe::where('created_by' , \Auth::user()->creatorId())->count();
        $departmentCount = Department::where('created_by' , \Auth::user()->creatorId())->count();
        $pendingLeaves = Leave::where('status', 1)->count();
        $trainingInProgress = TrainingList::where('status', 1)->count();
        $activities = Activity::orderBy('id','DESC')->get();

        $currentDate = now()->toDateString();
        $employeesWithoutClockIn = Employe::where('created_by', \Auth::user()->creatorId())->whereDoesntHave('attendance', function ($query) use ($currentDate) {
                                    $query->whereDate('created_at', $currentDate);
                                    })->get();
        $employeesWithAttendance = Employe::where('created_by', \Auth::user()->creatorId())
                                    ->whereHas('attendance', function ($query) use ($currentDate) {
                                        $query->whereDate('created_at', $currentDate);
                                    })
                                    ->with(['attendance' => function ($query) use ($currentDate) {
                                        $query->whereDate('created_at', $currentDate);
                                    }])
                                    ->get();

        return view('admin.dashboard', compact('employeesWithAttendance', 'employeesWithoutClockIn', 'activities' ,'trainingInProgress' ,'pendingLeaves' ,'notices', 'events', 'maleCount', 'femaleCount', 'hiredCandid', 'employeCount', 'departmentCount'));
    }

    public function calendar(){
        $holidays = Holiday::where('created_by', \Auth::user()->creatorId())->get();

        return view('admin.calendar', compact('holidays'));
    }
}

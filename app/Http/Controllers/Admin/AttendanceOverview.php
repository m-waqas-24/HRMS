<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employe;
use App\Models\Holiday;
use App\Models\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceOverview extends Controller
{
    public function index(){
        if(Auth::user()->can('manage attendance-overview')){
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $employes = Employe::where('created_by', \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
            $years = range($currentYear, 2022);
            $months = Month::all();
            $smonth = null;
            $syear = null;
            $totalDaysInSearchMonth = null;
    
            return view('admin.attendance.attendance-overview', compact( 'totalDaysInSearchMonth' ,'smonth', 'syear' ,'months' ,'years' ,'employes', 'currentMonth', 'currentYear'));
        }
        else
        {
            return back()->withError('Permission Denied!');
        }
    }

    public function searchAttendance(Request $request){

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $employes = Employe::where('created_by', \Auth::user()->creatorId())->orderBy('id', 'DESC')->get();
        $years = range($currentYear, 2022);
        $months = Month::all();

        $month = $request->month;
        $smonth = str_pad($month, 2, '0', STR_PAD_LEFT);
        $syear = $request->year;
        $semployee = $request->employee;

        $currentMonth = Carbon::create($syear, $smonth, 1);
        $totalDaysInSearchMonth = $currentMonth->daysInMonth;
        
        $totalholi = totalHolidaysofSearchmonth($smonth,$syear);
        $totalsun  = getTotalSundays($smonth,$syear);
        $totalwork = $totalDaysInSearchMonth - ($totalholi + $totalsun);

        return view('admin.attendance.attendance-overview', compact('totalwork' ,'totalDaysInSearchMonth','smonth', 'syear' ,'months' ,'years' ,'employes', 'currentMonth', 'currentYear'));
        
    }

    public function AttendanceByuser($id)
    {
        if( \Auth::user()->type == 'company' ){

            $totalPresentDays = $this->getTotalCheckinOfthatMonth($id);
            $totalLateDays = $this->getTotalLateDaysOfthatMonth($id);
            $totalHolidaysOfCurrentMonth = $this->totalHolidaysofcurrentmonth();
            $totalSundaysOfCurrentMonth = $this->getSundaysCountTillcurrentDate();
            $totalHalfDays = $this->getHalfDayOfthatMonth($id);

            $totalHolidays = $totalHolidaysOfCurrentMonth + $totalSundaysOfCurrentMonth;
            $totalAbsentDays = $this->getTotalAbsentOfthatMonth($id) - $totalHolidays;

            $totalDaysTillCurrentDayOfCurrentMonth = $this->getDaysTillCurrentDayOfCurrentMonth();
            $totalWorkingDays = $totalDaysTillCurrentDayOfCurrentMonth - $totalHolidays;
            
            $currentMonthStart = Carbon::now()->startOfMonth();
            $currentMonthEnd = Carbon::now()->endOfMonth();
            $attendances = Attendance::where('emp_id', $id)
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->get();
            return view('admin.attendance.employe-attendance', compact('totalHalfDays','attendances', 'totalLateDays', 'totalHolidays', 'totalWorkingDays', 'totalPresentDays', 'totalAbsentDays'));
        }
    }

    private function getHalfDayOfthatMonth($employeeId)
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentDate = Carbon::now();

        $halFDaysCount = Attendance::where('emp_id', $employeeId)
            ->whereBetween('created_at', [$currentMonthStart, $currentDate])->where('total_hours', '<', 4)
            ->count();

        return $halFDaysCount;
    }  

    private function getDaysTillCurrentDayOfCurrentMonth()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $currentDay = Carbon::now()->day;
        
        $daysInMonth = Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;
        $daysTillCurrentDay = min($currentDay, $daysInMonth);
    
        return $daysTillCurrentDay;
    }
    

    public function totalHolidaysofcurrentmonth(){
        $currentMonth = now()->month; 
    
        $holidays = Holiday::where('created_by', \Auth::user()->creatorId())
                        ->whereMonth('created_at', $currentMonth)
                        ->get();
    
        $totalDays = 0;
        foreach ($holidays as $holiday) {
            $totalDays += Carbon::parse($holiday->start_date)->diffInDays($holiday->end_date) + 1;
        }
    
        return $totalDays;
    }
    public function getSundaysCountTillcurrentDate()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $currentDay = Carbon::now()->day;
        
        $sundaysCount = 0;
        
        for ($day = 1; $day <= $currentDay; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day);
            
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                $sundaysCount++;
            }
        }

        return $sundaysCount;
    }
    

    private function getTotalCheckinOfthatMonth($employeeId)
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentDate = Carbon::now();

        $existingEntryCount = Attendance::where('emp_id', $employeeId)
            ->whereBetween('created_at', [$currentMonthStart, $currentDate])
            ->count();

        return $existingEntryCount;
    }    

    private function getTotalLateDaysOfthatMonth($employeeId)
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentDate = Carbon::now();

        $totalLatedays = Attendance::where('emp_id', $employeeId)
            ->where('is_late', 1)
            ->count();

        return $totalLatedays;
    }

    private function getTotalAbsentOfthatMonth($employeeId)
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentDate = Carbon::now();

        $existingEntryCount = Attendance::where('emp_id', $employeeId)
            ->whereBetween('created_at', [$currentMonthStart, $currentDate])
            ->count();

        $daysPassed = $currentDate->diffInDays($currentMonthStart) + 1;

        $missingEntryCount = $daysPassed - $existingEntryCount;

        return $missingEntryCount;
    }

    public function getAttendance(Request $request){
        $attendanceId = $request->attendanceId;

        $attendance = Attendance::find($attendanceId);

        return response()->json(['attendance' => $attendance]);
    }
   

}

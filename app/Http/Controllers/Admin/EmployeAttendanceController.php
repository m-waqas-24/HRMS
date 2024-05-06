<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\CompanyDetail;
use App\Models\CompanySetting;
use App\Models\Holiday;
use App\Models\IpRestriction;
use App\Models\Leave;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeAttendanceController extends Controller
{
    public function index()
    {
        if(\Auth::user()->type == 'employee'){

            $totalPresentDays = $this->getTotalCheckinOfthatMonth(\Auth::user()->employe->id);
            $totalLateDays = $this->getTotalLateDaysOfthatMonth(\Auth::user()->employe->id);
            $totalHolidaysOfCurrentMonth = $this->totalHolidaysofcurrentmonth();
            $totalSundaysOfCurrentMonth = $this->getSundaysCountTillcurrentDate();

            $totalHalfDays = $this->getHalfDayOfthatMonth(\Auth::user()->employe->id);
            $totalHolidays = $totalHolidaysOfCurrentMonth + $totalSundaysOfCurrentMonth;
            $totalAbsentDays = $this->getTotalAbsentOfthatMonth(\Auth::user()->employe->id) - $totalHolidays;

            $totalDaysTillCurrentDayOfCurrentMonth = $this->getDaysTillCurrentDayOfCurrentMonth();
            $totalWorkingDays = $totalDaysTillCurrentDayOfCurrentMonth - $totalHolidays;
            
            $currentMonthStart = Carbon::now()->startOfMonth();
            $currentMonthEnd = Carbon::now()->endOfMonth();
            $attendances = Attendance::where('emp_id', \Auth::user()->employe->id)
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->get();

            $currentDate = now();
            $existingCheckIn = Attendance::where('emp_id', Auth::user()->employe->id)
            ->whereDate('check_in', $currentDate->toDateString())
            ->first();
            $existingCheckOut = Attendance::where('emp_id', Auth::user()->employe->id)
            ->whereDate('check_out', $currentDate->toDateString())
            ->first();

            return view('admin.attendance.employe-attendance', compact('totalHalfDays', 'existingCheckOut', 'existingCheckIn' ,'attendances', 'totalLateDays', 'totalHolidays', 'totalWorkingDays', 'totalPresentDays', 'totalAbsentDays'));
        }
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

    private function getHalfDayOfthatMonth($employeeId)
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentDate = Carbon::now();

        $halFDaysCount = Attendance::where('emp_id', $employeeId)
            ->whereBetween('created_at', [$currentMonthStart, $currentDate])->where('total_hours', '<', 4)
            ->count();

        return $halFDaysCount;
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

    

    public function checkIn(Request $request) {

        if (Auth::user()->type == 'employee') {

            $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();
            if($company && $company->ip_restrict == 1){
                    $userIp = $request->ip();
                    $companyIps = IpRestriction::where('created_by', \Auth::user()->creatorId())->pluck('ip')->toArray();
                    if(!in_array($userIp, $companyIps)){
                        return back()->withErrors(['error' => 'You have to be in office for check-in.']);
                    }
                }
           

            $currentDate = now();

            $isHoliday = Holiday::where('created_by', Auth::user()->creatorId())
                                ->whereDate('start_date', '<=', $currentDate)
                                ->whereDate('end_date', '>=', $currentDate)
                                ->exists();
    
            if ($isHoliday) {
                return back()->withErrors(['error' => 'Today is a holiday. Check-in not allowed.']);
            }
    
            $hasLeave = Leave::where('emp_id', Auth::user()->employe->id)
                             ->whereDate('start_date', '<=', $currentDate)
                             ->whereDate('end_date', '>=', $currentDate)
                             ->exists();
    
            if ($hasLeave) {
                return back()->withErrors(['error' => 'You have taken leave for today. Check-in not allowed.']);
            }
    
            $company = CompanyDetail::where('emp_id', Auth::user()->employe->id)->first();
            $timeslot = TimeSlot::find($company->timeslot);

            if(!$timeslot){
                return back()->withErrors('Your company check in time not exist ');
            }

            $checkInTime = Carbon::parse($timeslot->start_time)->addMinutes($timeslot->late_minute);
    
            $currentTime = Carbon::parse($currentDate->toTimeString());
            if ($currentTime->gt($checkInTime)) {
                $isLate = 1;
            } else {
                $isLate = 0;
            }
        
                Attendance::create([
                    'emp_id' => Auth::user()->employe->id,
                    'check_in' => now(),
                    'is_late' => $isLate,
                    'created_by' => \Auth::user()->creatorId(),
                ]);
    
                if ($isLate) {
                    return back()->withSuccess('You are late today!');
                } else {
                    return back()->withSuccess('Welcome! Check-in successful!');
                }
           
        }
    }
    
    
    public function checkOut(Request $request) {
        if (Auth::user()->type == 'employee') {


            $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();
                if($company && $company->ip_restrict == 1){
                    $userIp = $request->ip();
                    $companyIps = IpRestriction::where('created_by', \Auth::user()->creatorId())->pluck('ip')->toArray();
                    if(!in_array($userIp, $companyIps)){
                        return back()->withErrors(['error' => 'You have to be in office for check-out.']);
                    }
                }

            $currentDate = now();
            $checkInRecord = Attendance::where('emp_id', Auth::user()->employe->id)
                                        ->whereDate('check_in', $currentDate->toDateString())
                                        ->first();
    
            if ($checkInRecord) {
                $company = CompanyDetail::where('emp_id', Auth::user()->employe->id)->first();
                $timeslot = TimeSlot::find($company->timeslot);
    
                $companyEndTime = Carbon::parse($timeslot->end_time);
                $checkOutTime = now();
    
                if ($checkOutTime->gt($companyEndTime)) {
                    $overtimeMinutes = $checkOutTime->diffInMinutes($companyEndTime);
                    $overtimeHours = floor($overtimeMinutes / 60);
                    $overtimeMinutes %= 60;
                } else {
                    $overtimeHours = 0;
                    $overtimeMinutes = 0;
                }
    
                $checkIn = Carbon::parse($checkInRecord->check_in);
                $totalMinutesWorked = $checkOutTime->diffInMinutes($checkIn);
                $totalHoursWorked = floor($totalMinutesWorked / 60);
                $totalMinutesWorked %= 60;
    
                $checkInRecord->update([
                    'check_out' => $checkOutTime,
                    'overtime_hours' => $overtimeHours,
                    'overtime_minutes' => $overtimeMinutes,
                    'total_hours' => $totalHoursWorked,
                    'total_minutes' => $totalMinutesWorked,
                ]);

                return back()->withSuccess('Check-out successfully!');
            }
        }
    }
    

    
}

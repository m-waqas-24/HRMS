<?php

use App\Models\CompanySetting;
use App\Models\Employe;
use App\Models\Event;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Plan;
use App\Models\SystemSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

if (!function_exists('isHolidayy')) {
    function isHolidayy($date)
    {
        $isHoliday = Holiday::where('created_by', \Auth::user()->creatorId())
                            ->whereDate('start_date', '<=', $date)
                            ->whereDate('end_date', '>=', $date)
                            ->exists();
    
        return $isHoliday;
    }

        function isSunday($date)
    {
        $dateTime = new DateTime($date);
        
        $dayOfWeek = $dateTime->format('w');

        if ($dayOfWeek == 0) {
            return true;
        } else {
            return false; 
        }
    }

    
    function getEmployeesWithUpcomingBirthdays()
        {
            $today = Carbon::today();
            $targetDate = $today->addDays(2); 

            $employees = Employe::whereMonth('d_o_b', '<=', $targetDate->month)
                                ->whereDay('d_o_b', '<=', $targetDate->day)
                                ->get();

            return $employees;
        }

    function getEvents(){
        $events = Event::where('created_by', \Auth::user()->creatorId())->get();

        return $events;
    }

    function getCompanyLogoDark(){
        $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();

        if($company){
            return $company->logoDark;
        }
    }
    
    function getCompanyLogoLight(){
        $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();
        
        if($company){
            return $company->logoLight;
        }
    }

    function getCompanyFavicon(){
        $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();

        if($company){
            return $company->favicon;
        }
    }

    function getSystemCurrency(){
        $system = SystemSetting::where('created_by', \Auth::user()->creatorId())->first();

        return $system->currency_symbol;
    }
    function getSystemCurrencyPosition(){
        $system = SystemSetting::where('created_by', \Auth::user()->creatorId())->first();

        return $system->currency_position;
    }
    
    function userDefaultRolesPermissions($userid){
        $adminPermissions = [
            ['name' => 'manage attendance-timeslots'],
            ['name' => 'create attendance-timeslots'],
            ['name' => 'edit attendance-timeslots'],
            ['name' => 'manage ip-restriction'],
            ['name' => 'create ip-restriction'],
            ['name' => 'edit ip-restriction'],
            ['name' => 'manage user-management'],
            ['name' => 'manage role'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'manage attendance-overview'],
            ['name' => 'manage employee '],
            ['name' => 'create employee '],
            ['name' => 'show employee '],
            ['name' => 'edit employee '],
            ['name' => 'delete employee '],
            ['name' => 'manage salary'],
            ['name' => 'create salary'],
            ['name' => 'create allowance '],
            ['name' => 'edit allowance '],
            ['name' => 'delete allowance '],
            ['name' => 'create commission'],
            ['name' => 'edit commission'],
            ['name' => 'delete commission'],
            ['name' => 'create loan '],
            ['name' => 'edit loan '],
            ['name' => 'delete loan '],
            ['name' => 'create deduction '],
            ['name' => 'edit deduction '],
            ['name' => 'delete deduction '],
            ['name' => 'create otherpayments'],
            ['name' => 'edit otherpayments'],
            ['name' => 'delete otherpayments'],
            ['name' => 'manage leaves'],
            ['name' => 'create leaves'],
            ['name' => 'edit leaves'],
            ['name' => 'delete leaves'],
            ['name' => 'manage trainer'],
            ['name' => 'create trainer'],
            ['name' => 'edit trainer'],
            ['name' => 'delete trainer'],
            ['name' => 'manage traininglist'],
            ['name' => 'create traininglist'],
            ['name' => 'show traininglist'],
            ['name' => 'edit traininglist'],
            ['name' => 'delete traininglist'],
            ['name' => 'manage training-type'],
            ['name' => 'create training-type'],
            ['name' => 'edit training-type'],
            ['name' => 'manage hradminsetup'],
            ['name' => 'manage transfer'],
            ['name' => 'create transfer'],
            ['name' => 'edit transfer'],
            ['name' => 'delete transfer'],
            ['name' => 'manage promotions'],
            ['name' => 'create promotions'],
            ['name' => 'edit promotions'],
            ['name' => 'delete promotions'],
            ['name' => 'manage awards'],
            ['name' => 'create awards'],
            ['name' => 'edit awards'],
            ['name' => 'delete awards'],
            ['name' => 'manage resignation'],
            ['name' => 'create resignation'],
            ['name' => 'edit resignation'],
            ['name' => 'delete resignation'],
            ['name' => 'manage termination'],
            ['name' => 'create termination'],
            ['name' => 'edit termination'],
            ['name' => 'delete termination'],
            ['name' => 'manage complaints'],
            ['name' => 'create complaints'],
            ['name' => 'edit complaints'],
            ['name' => 'delete complaints'],
            ['name' => 'manage holidays'],
            ['name' => 'create holidays'],
            ['name' => 'edit holidays'],
            ['name' => 'delete holidays'],
            ['name' => 'manage recruitments'],
            ['name' => 'manage jobs'],
            ['name' => 'create jobs'],
            ['name' => 'edit jobs'],
            ['name' => 'delete jobs'],
            ['name' => 'manage candidates'],
            ['name' => 'create candidates'],
            ['name' => 'edit candidates'],
            ['name' => 'delete candidates'],
            ['name' => 'manage interviewschedule'],
            ['name' => 'create interviewschedule'],
            ['name' => 'edit interviewschedule'],
            ['name' => 'delete interviewschedule'],
            ['name' => 'manage employee-assets'],
            ['name' => 'show employee-assets'],
            ['name' => 'create employee-assets'],
            ['name' => 'edit employee-assets'],
            ['name' => 'delete employee-assets'],
            ['name' => 'manage notice-board'],
            ['name' => 'create notice-board'],
            ['name' => 'edit notice-board'],
            ['name' => 'delete notice-board'],
            ['name' => 'manage events'],
            ['name' => 'create events'],
            ['name' => 'edit events'],
            ['name' => 'delete events'],
            ['name' => 'manage departments'],
            ['name' => 'create departments'],
            ['name' => 'edit departments'],
            ['name' => 'delete departments'],
            ['name' => 'manage designations'],
            ['name' => 'create designations'],
            ['name' => 'edit designations'],
            ['name' => 'delete designations'],
            ['name' => 'manage leave-types'],
            ['name' => 'create leave-types'],
            ['name' => 'edit leave-types'],
            ['name' => 'delete leave-types'],
            ['name' => 'manage assets '],
            ['name' => 'create assets '],
            ['name' => 'edit assets '],
            ['name' => 'delete assets '],
            ['name' => 'manage contract-types'],
            ['name' => 'create contract-types'],
            ['name' => 'edit contract-types'],
            ['name' => 'delete contract-types'],
            ['name' => 'manage gifts'],
            ['name' => 'create gifts'],
            ['name' => 'edit gifts'],
            ['name' => 'delete gifts'],
            ['name' => 'manage award-type'],
            ['name' => 'create award-type'],
            ['name' => 'edit award-type'],
            ['name' => 'delete award-type'],
            ['name' => 'manage payslip-options'],
            ['name' => 'create payslip-options'],
            ['name' => 'edit payslip-options'],
            ['name' => 'delete payslip-options'],
            ['name' => 'manage allowance-options'],
            ['name' => 'create allowance-options'],
            ['name' => 'edit allowance-options'],
            ['name' => 'delete allowance-options'],
            ['name' => 'manage loan-options'],
            ['name' => 'create loan-options'],
            ['name' => 'edit loan-options'],
            ['name' => 'delete loan-options'],
            ['name' => 'manage deduction-options'],
            ['name' => 'create deduction-options'],
            ['name' => 'edit deduction-options'],
            ['name' => 'delete deduction-options'],
        ];

        $adminRole = Role::create(
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_by' => $userid,
            ]
        );

        $adminRole->givePermissionTo($adminPermissions);

        $user = User::find($userid);
        $user->assignRole($adminRole);

        //employee
        $employeePermissions = [
            ['name' => 'manage employee '],
            ['name' => 'show employee '],
            ['name' => 'manage leaves'],
            ['name' => 'create leaves'],
            ['name' => 'manage traininglist'],
            ['name' => 'manage hradminsetup'],
            ['name' => 'manage transfer'],
            ['name' => 'manage promotions'],
            ['name' => 'manage awards'],
            ['name' => 'manage resignation'],
            ['name' => 'manage termination'],
            ['name' => 'manage complaints'],
            ['name' => 'create complaints'],
            ['name' => 'manage holidays'],
            ['name' => 'manage employee-assets'],
            ['name' => 'show employee-assets'],
            ['name' => 'manage notice-board'],
        ];

        $employeeRole = Role::create(
            [
                'name' => 'Employee',
                'guard_name' => 'web',
                'created_by' => $userid,
            ]
        );

        $employeeRole->givePermissionTo($employeePermissions);
    }

    function userAccountPermissions($userid){

        $accPermissions = [
            ['name' => 'manage categories'],
            ['name' => 'create categories'],
            ['name' => 'edit categories'],
            ['name' => 'delete categories'],
            ['name' => 'manage banks'],
            ['name' => 'create banks'],
            ['name' => 'edit banks'],
            ['name' => 'delete banks'],
            ['name' => 'manage bank-accounts'],
            ['name' => 'create bank-accounts'],
            ['name' => 'edit bank-accounts'],
            ['name' => 'delete bank-accounts'],
            ['name' => 'manage balance-transfers'],
            ['name' => 'create balance-transfers'],
            ['name' => 'manage debts-loans'],
            ['name' => 'create debts-loans'],
            ['name' => 'edit debts-loans'],
            ['name' => 'delete debts-loans'],
            ['name' => 'create borrow-more'],
            ['name' => 'create repay'],
            ['name' => 'create lend-more'],
            ['name' => 'create debt-collection'],
            ['name' => 'manage incomes'],
            ['name' => 'create incomes'],
            ['name' => 'edit incomes'],
            ['name' => 'delete incomes'],  
            ['name' => 'manage expenses'],
            ['name' => 'create expenses'],
            ['name' => 'edit expenses'],
            ['name' => 'delete expenses'],  
        ];

        $accRole = Role::create(
            [
                'name' => 'Accountant',
                'guard_name' => 'web',
                'created_by' => $userid,
            ]
        );

        $accRole->givePermissionTo($accPermissions);

        $user = User::find($userid);
        $user->assignRole($accRole);

    }

    function userDefaultSystemSetting($userid){
        SystemSetting::create([
            "currency_symbol" => 'Rs',
            "currency_position" => 1,
            "emp_prefix" => '#EMP',
            "inv_prefix" => '#INV',
            "created_by" => $userid, 
        ]);
    }

    function IpRestrict(){
        $company = CompanySetting::where('created_by', \Auth::user()->creatorId())->first();

        if($company){
            return $company->ip_restrict;
        }
    }

    function totalHolidaysofSearchmonth($smonth, $syear){
    
        $holidays = Holiday::where('created_by', \Auth::user()->creatorId())
                        ->whereMonth('created_at', $smonth)->whereYear('created_at', $syear)
                        ->get();
    
        $totalDays = 0;
        foreach ($holidays as $holiday) {
            $totalDays += Carbon::parse($holiday->start_date)->diffInDays($holiday->end_date) + 1;
        }
    
        return $totalDays;
    }

    function getTotalSundays($smonth, $syear) {
        $firstDayOfMonth = strtotime("$syear-$smonth-01");
        $lastDayOfMonth = strtotime("last day of $syear-$smonth");
    
        $totalSundays = 0;
    
        for ($i = $firstDayOfMonth; $i <= $lastDayOfMonth; $i = strtotime("+1 day", $i)) {
            if (date('N', $i) == 7) { 
                $totalSundays++;
            }
        }
    
        return $totalSundays;
    }

    function uploadFile($request, $fileInputName, $targetDirectory)
    {
        $uploadedFile = $request->file($fileInputName);
        if ($uploadedFile) {
            $path = $uploadedFile->store($targetDirectory);
            return substr($path, 7); 
        }
        return null;
    }

    function getCompanyPlan()
    {
        $authUser = auth()->user();

        if ($authUser && $authUser->type == 'company') {
            return Plan::find($authUser->plan);
        }else{
            $user = User::find($authUser->created_by);
            return Plan::find($user->plan);
        }
    }

}


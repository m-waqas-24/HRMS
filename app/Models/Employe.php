<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Employe extends Model
{
    use HasFactory, SoftDeletes;
    
      protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function document(){
        return $this->hasOne(Document::class, 'emp_id', 'id');
    }

    public function bankDetail(){
        return $this->hasOne(BankDetail::class, 'emp_id', 'id');
    }

    public function companyDetail(){
        return $this->hasOne(CompanyDetail::class, 'emp_id', 'id');
    }
    
    public function award(){
        return $this->hasMany(Award::class, 'emp_id', 'id');
    }

    public function allowance(){
        return $this->hasMany(Allowance::class, 'emp_id', 'id');
    }

    public function loan(){
        return $this->hasMany(Loan::class, 'emp_id', 'id');
    }
    public function deduction(){
        return $this->hasMany(Deduction::class, 'emp_id', 'id');
    }
    public function commission(){
        return $this->hasMany(Commission::class, 'emp_id', 'id');
    }
    public function otherPayment(){
        return $this->hasMany(OtherPayment::class, 'emp_id', 'id');
    }
    public function salary(){
        return $this->hasOne(Salary::class, 'emp_id', 'id');
    }
    public function NetSalary()
    {
        $basicSalary = $this->salary->salary;
        $allowancesSum = $this->allowance ? $this->allowance->sum('amount') : 0;
        $commissionsSum = $this->commission ? $this->commission->sum('amount') : 0;
        $otherPaymentsSum = $this->otherPayment ? $this->otherPayment->sum('amount') : 0;
        $deductionsSum = $this->deduction ? $this->deduction->sum('amount') : 0;
        $loansSum = $this->loan ? $this->loan->sum('amount') : 0;
    
        $netSalary = $basicSalary + $allowancesSum + $commissionsSum + $otherPaymentsSum + $loansSum - $deductionsSum;
    
        return $netSalary;
    }
    public static function empallowance($id)
    {

        //allowance
        $allowances      = Allowance::where('emp_id', '=', $id)->get();
        $total_allowance = 0;
        foreach($allowances as $allowance)
        {
            $total_allowance = $allowance->amount + $total_allowance;
        }

        $allowance_json = json_encode($allowances);

        return $allowance_json;

    }

    public static function empcommission($id)
    {
        //commission
        $commissions      = Commission::where('employee_id', '=', $id)->get();
        $total_commission = 0;
        foreach($commissions as $commission)
        {
            $total_commission = $commission->amount + $total_commission;
        }
        $commission_json = json_encode($commissions);

        return $commission_json;

    }

    public static function emploan($id)
    {
        //Loan
        $loans      = Loan::where('emp_id', '=', $id)->get();
        $total_loan = 0;
        foreach($loans as $loan)
        {
            $total_loan = $loan->amount + $total_loan;
        }
        $loan_json = json_encode($loans);

        return $loan_json;
    }

    public static function empdeduction($id)
    {
        //Saturation Deduction
        $saturation_deductions      = Deduction::where('emp_id', '=', $id)->get();
        $total_saturation_deduction = 0;
        foreach($saturation_deductions as $saturation_deduction)
        {
            $total_saturation_deduction = $saturation_deduction->amount + $total_saturation_deduction;
        }
        $saturation_deduction_json = json_encode($saturation_deductions);

        return $saturation_deduction_json;

    }

    public static function empother_payment($id)
    {
        //OtherPayment
        $other_payments      = OtherPayment::where('emp_id', '=', $id)->get();
        $total_other_payment = 0;
        foreach($other_payments as $other_payment)
        {
            $total_other_payment = $other_payment->amount + $total_other_payment;
        }
        $other_payment_json = json_encode($other_payments);

        return $other_payment_json;
    }

    public function assets(){
        return $this->hasMany(EmployeeAsset::class, 'emp_id', 'id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'emp_id', 'id');
    }

    public function leaves(){
        return $this->hasMany(Leave::class, 'emp_id', 'id');
    }

    public function getPresentDaysCountForMonth($year, $month)
    {
        $presentDaysCount = $this->attendance()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)  
            ->count();

        return $presentDaysCount;
    }

    public function isLeave($date){
        
        $isLeave = Leave::where('created_by', \Auth::user()->creatorId())->where('emp_id', $this->id)->where('status', 2)
        ->whereDate('start_date', '<=', $date)
        ->whereDate('end_date', '>=', $date)
        ->exists();

        return $isLeave;
    }

}

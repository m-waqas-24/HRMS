<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use App\Models\AllowanceOption;
use App\Models\Commission;
use App\Models\Deduction;
use App\Models\DeductionOption;
use App\Models\Employe;
use App\Models\Loan;
use App\Models\LoanOption;
use App\Models\Month;
use App\Models\OtherPayment;
use App\Models\Payslip;
use App\Models\PaySlipOption;
use App\Models\Salary;
use App\Models\SystemSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetSalaryController extends Controller
{
    public function index(){
        $employes = Employe::where('created_by' , \Auth::user()->creatorId())->paginate(12);

        return view('admin.salary.index', compact('employes'));
    }

    public function edit($slug){

        $employe = Employe::where([ 'slug' => $slug, 'created_by' => \Auth::user()->creatorId() ])->first();

        $payslipOptions = PaySlipOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
        $allowanceOptions = AllowanceOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
        $loanOptions = LoanOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();
        $deductionOptions = DeductionOption::where('created_by' , \Auth::user()->creatorId())->orderBy('id','DESC')->get();


        if( $employe){

            $salary = Salary::where('emp_id', $employe->id)->orderBy('id','DESC')->get();
            $allowances = Allowance::where('emp_id', $employe->id)->orderBy('id','DESC')->get();
            $commissions = Commission::where('emp_id', $employe->id)->orderBy('id','DESC')->get();
            $loans = Loan::where('emp_id', $employe->id)->orderBy('id','DESC')->get();
            $deductions = Deduction::where('emp_id', $employe->id)->orderBy('id','DESC')->get();
            $otherpayments = OtherPayment::where('emp_id', $employe->id)->orderBy('id','DESC')->get();
    
            return view('admin.salary.edit', compact('employe', 'salary', 'otherpayments', 'deductions', 'loans', 'commissions', 'allowances', 'payslipOptions', 'allowanceOptions', 'loanOptions', 'deductionOptions'));
        }else{
            auth()->logout();
            abort(403);
        }

    }

    public function setEmpSalary(Request $request, $empId){
        $request->validate([
            'payslip_option' => 'required',
            'amount' => 'required',
        ]);

        $payslipOption = $request->payslip_option;
        $amount = $request->amount;
        
        //updateOrCreate method to create or update the salary record
        Salary::updateOrCreate(
            ['emp_id' => $empId],
            ['paymentslip_option' => $payslipOption, 'salary' => $amount]
        );

        return back()->withSuccess('Salary added successfully!');
    }

    public function payslip($id){
        $employe = Employe::find($id);
        $months = Month::all();
        return view('admin.salary.payslip', compact('employe', 'months'));
    }


    public function storePayslips(Request $request, $id)
    {
        $employee = Employe::find($id);

        if (!$employee) {
            return redirect()->back()->withErrors('Employee not found');
        }

        $month = $request->month;
        $currentYear = Carbon::now()->year;

        $existingPayslip = Payslip::where('emp_id', $id)->where('month', $month)
            ->whereYear('created_at', $currentYear)
            ->first();

        if ($existingPayslip) {
            return redirect()->back()->withErrors('Payslip for this month already exists.');
        }

        $employeeData = [
            'salary' => $employee->salary,
            'loans' => $employee->loan,
            'allowances' => $employee->allowance,
            'commissions' => $employee->commission,
            'deductions' => $employee->deduction,
            'otherpayments' => $employee->otherPayment,
        ];

        Payslip::create([
            'emp_id' => $id,
            'invID' => $this->random(),
            'month' => $request->month, 
            'data' => json_encode($employeeData),
            'created_by' => \Auth::user()->creatorId(),
        ]);


        return back()->withSuccess('Payslip has been sent to Employee!');
    }

    private function random()
    {
        $system = SystemSetting::where('created_by', \Auth::user()->creatorId())->first();

        if($system){
            do{
                $next = random_int(1,9999);
                $code = $system->inv_prefix . '-' . $next;
            }while(Payslip::where('invID','=', $code)->first());
    
            return $code;
        }else{
            return 'N\A';
        }
       
    }

}

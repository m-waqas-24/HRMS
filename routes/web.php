<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AllowanceController;
use App\Http\Controllers\Admin\AllowanceOptionController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\AttendanceOverview;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\AwardTypeController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DeductionController;
use App\Http\Controllers\Admin\DeductionOptionController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployeAttendanceController;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\Admin\EmployeeAssetController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Account\IndexController as AccountIndexController;
use App\Http\Controllers\Admin\InterviewController;
use App\Http\Controllers\Admin\IpRestrictionController;
use App\Http\Controllers\Admin\Leavecontroller;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoanOptionController;
use App\Http\Controllers\Admin\NoticeBoardController;
use App\Http\Controllers\Admin\OtherPaymentController;
use App\Http\Controllers\Admin\PaySlipController;
use App\Http\Controllers\Admin\PayslipOptionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RecruitmentController;
use App\Http\Controllers\Admin\Resignationcontroller;
use App\Http\Controllers\Admin\SetSalaryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Admin\TerminationController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\TrainingListController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SuperAdmin\IndexController as SuperAdminIndexController;
use App\Http\Controllers\SuperAdmin\PlanController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\Account\CategoryController;
use App\Http\Controllers\Account\BankController;
use App\Http\Controllers\Account\BankAccountController;
use App\Http\Controllers\Account\DebtLoanController;
use App\Http\Controllers\Account\IncomeController;
use App\Http\Controllers\Account\ExpenseController;
use App\Http\Controllers\Account\TransferController as AccountTransferController;
use App\Http\Controllers\TrainingTypecontroller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Jobs\SendEmailJob;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'web', 'revalidate'], 'as' => 'admin.'], function(){

    Route::get('dashboard', [IndexController::class, 'dashboard'])->name('dashboard');

    Route::resource('employee', EmployeController::class);
    Route::get('employe-list', [EmployeController::class, 'employeTable'])->name('employe-list');

    Route::resource('departments', DepartmentController::class);

    Route::resource('designations', DesignationController::class);

    Route::resource('holidays', HolidayController::class);

    Route::resource('leavestatus', StatusController::class);

    Route::resource('noticeboard', NoticeBoardController::class);

    Route::resource('events', EventController::class);

    Route::resource('awards', AwardController::class);

    Route::resource('contracts', ContractController::class);

    Route::resource('gifts', GiftController::class);   

    Route::resource('paysliptypes', PayslipOptionController::class);

    Route::resource('allowancetypes', AllowanceOptionController::class);

    Route::resource('loantypes', LoanOptionController::class);

    Route::resource('deductiontypes', DeductionOptionController::class);

    Route::resource('awardtypes', AwardTypeController::class);

    Route::resource('branches', BranchController::class);

   Route::resource('companies', CompanyController::class);

   Route::resource('recruitments', RecruitmentController::class);

   Route::resource('candidates', CandidateController::class);

   Route::resource('interviews', InterviewController::class);

   Route::resource('trainers', TrainerController::class);

   Route::resource('transfers', TransferController::class);

   Route::resource('promotions', PromotionController::class);

   Route::resource('resignations', Resignationcontroller::class);

   Route::resource('terminations', TerminationController::class);

   Route::resource('complaints', ComplaintController::class);

   Route::resource('assets', AssetController::class);

   Route::resource('trainingtypes', TrainingTypecontroller::class);

   Route::resource('employee-assets', EmployeeAssetController::class);
   Route::post('employe-asset-edit', [EmployeeAssetController::class, 'edit'])->name('employe-asset-edit');
   Route::put('employe-asset-update', [EmployeeAssetController::class, 'update'])->name('employe-asset-update');

   Route::resource('leaves', Leavecontroller::class);
   Route::get('leaves-edit/{id}', [Leavecontroller::class, 'edit'])->name('leaves.editwithId');
   Route::put('leaves-update/{id}', [Leavecontroller::class, 'update'])->name('leaves.updatewithId');
   Route::delete('leaves-delete/{id}', [Leavecontroller::class, 'destroy'])->name('leaves.destroywithId');

   Route::resource('traininglists', TrainingListController::class);
   Route::put('update-status-training/{id?}', [TrainingListController::class, 'updateStatus'])->name('traininglists.updateStatus');

   Route::resource('allowances', AllowanceController::class);
   Route::post('allowances/{id?}', [AllowanceController::class, 'store'])->name('allowances.storeWithId');
   Route::put('allowances/{id?}/update', [AllowanceController::class, 'update'])->name('allowances.updateWithId');
   Route::post('edit-allowance', [AllowanceController::class, 'edit'])->name('allowance-edit');

   Route::resource('commissions', CommissionController::class);
   Route::post('commissions/{id?}', [CommissionController::class, 'store'])->name('commissions.storeWithId');
   Route::put('commissions/{id?}/update', [CommissionController::class, 'update'])->name('commissions.updateWithId');
   Route::post('edit-commission', [CommissionController::class, 'edit'])->name('commission-edit');

   Route::resource('loans', LoanController::class);
   Route::post('loans/{id?}', [LoanController::class, 'store'])->name('loans.storeWithId');
   Route::put('loans/{id?}/update', [LoanController::class, 'update'])->name('loans.updateWithId');
   Route::post('edit-loan', [LoanController::class, 'edit'])->name('edit-loan');

   Route::resource('deductions', DeductionController::class);
   Route::post('deductions/{id?}', [DeductionController::class, 'store'])->name('deductions.storeWithId');
   Route::put('deductions/{id?}/update', [DeductionController::class, 'update'])->name('deductions.updateWithId');
   Route::post('edit-deduction', [DeductionController::class, 'edit'])->name('edit-deduction');

   Route::resource('otherpayments', OtherPaymentController::class);
   Route::post('otherpayments/{id?}', [OtherPaymentController::class, 'store'])->name('otherpayments.storeWithId');
   Route::put('otherpayments/{id?}/update', [OtherPaymentController::class, 'update'])->name('otherpayments.updateWithId');
   Route::post('edit-otherpayment', [OtherPaymentController::class, 'edit'])->name('edit-otherpayment');

   Route::get('settings', [SettingController::class, 'settings'])->name('index.settings');

   Route::get('set-payslip/{id}', [SetSalaryController::class, 'payslip'])->name('payslip-receipt');
   Route::get('set-salary', [SetSalaryController::class, 'index'])->name('index.setsalary');
   Route::get('set-salary/{slug?}', [SetSalaryController::class, 'edit'])->name('edit.setsalary');
   Route::post('basic-salary/{id?}', [SetSalaryController::class, 'setEmpSalary'])->name('setEmpSalary');
   Route::post('store-payslips/{id?}', [SetSalaryController::class, 'storePayslips'])->name('store.pay-slips');
    
   Route::get('all-payslips', [PaySlipController::class, 'index'])->name('index.payslips');
   Route::get('show-payslips/{id?}', [PaySlipController::class, 'show'])->name('show.payslips');

   Route::get('candidate-update', [AjaxController::class, 'updateCandidateStatus'])->name('update.candidate-status');

   //Attendance route
   Route::get('employe-attendance', [EmployeAttendanceController::class, 'index'])->name('employe-attendance.index');
   Route::get('employe-check-in', [EmployeAttendanceController::class, 'checkIn'])->name('employe.checkIn');
   Route::get('employe-check-out', [EmployeAttendanceController::class, 'checkOut'])->name('employe.checkOut');

   Route::get('attendance-time-slots', [TimeSlotController::class, 'index'])->name('index.time-slots');
   Route::post('store-attendance-time-slots', [TimeSlotController::class, 'store'])->name('store.time-slots');
   Route::get('edit-attendance-time-slots/{id?}', [TimeSlotController::class, 'edit'])->name('edit.time-slots');
   Route::put('update-attendance-time-slots/{id?}', [TimeSlotController::class, 'update'])->name('update.time-slots');

   Route::get('all-ips', [IpRestrictionController::class, 'index'])->name('index.ip');
   Route::post('store-ip', [IpRestrictionController::class, 'store'])->name('store.ip');
   Route::get('edit-ip/{id?}', [IpRestrictionController::class, 'edit'])->name('edit.ip');
   Route::put('update-ip/{id?}', [IpRestrictionController::class, 'update'])->name('update.ip');

   Route::get('company-setting', [CompanySettingController::class, 'index'])->name('company-setting.index');
   Route::post('store/company-setting', [CompanySettingController::class, 'store'])->name('company-setting.store');
   Route::post('update-ip-restrict', [CompanySettingController::class, 'updateIpRestrict'])->name('update.ip-restrict');

   Route::get('attendance-overview', [AttendanceOverview::class, 'index'])->name('attendance-overview');
   Route::get('attendance-by-user/{id}', [AttendanceOverview::class , 'AttendanceByuser'])->name('attendance-by-user');
   Route::post('get-attendance', [AttendanceOverview::class, 'getAttendance'])->name('get-attendance');
   Route::get('search-attendance', [AttendanceOverview::class, 'searchAttendance'])->name('search.attendance');

   Route::get('calendar', [IndexController::class, 'calendar'])->name('calendar');

   Route::get('system-settings', [SystemSettingController::class, 'index'])->name('system-setting.index');
   Route::post('store-system-settings', [SystemSettingController::class, 'store'])->name('system-setting.store');

   Route::get('users-list', [UserManagementController::class, 'index'])->name('user.list');
   Route::post('edit-user-list', [UserManagementController::class, 'edit'])->name('edit.user.list');
   Route::put('update-user-list/{id?}', [UserManagementController::class, 'update'])->name('update.user.list');
   Route::put('update-password-list/{id?}', [UserManagementController::class, 'updatePassword'])->name('update.password.list');
   Route::post('delete-user-list/{id?}', [UserManagementController::class, 'deleteUser'])->name('delete.user.list');

   Route::get('profile', [ProfileController::class, 'index'])->name('index.profile');
   Route::put('update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
   Route::put('update-photo', [ProfileController::class, 'updatePhoto'])->name('update.photo');
   Route::post('update-password', [ProfileController::class, 'updatePassword'])->name('update.password');

   Route::get('roles', [UserManagementController::class, 'allRoles'])->name('index.roles');
   Route::get('create-role', [UserManagementController::class, 'createRole'])->name('create.role');
   Route::post('store-role', [UserManagementController::class, 'storeRole'])->name('store.role');
   Route::get('edit-role/{id?}', [UserManagementController::class, 'editrole'])->name('edit.role');
   Route::put('update-role/{id?}', [UserManagementController::class, 'updaterole'])->name('update.role');

   Route::get('search-employe', [EmployeController::class, 'searchEmploye'])->name('search.employe');

   Route::get('change-system-settings', [SettingController::class, 'syssettings'])->name('change-system-settings');

   //accounts routes
   Route::get('acccount-reports', [AccountIndexController::class, 'dashboard'])->name('account.dashboard');


   //income and expense categories
   Route::get('income-&-expense-categories', [CategoryController::class, 'index'])->name('account.category.index');
   Route::post('store-category', [CategoryController::class, 'store'])->name('account.category.store');
   Route::post('edit-category', [CategoryController::class, 'edit'])->name('account.category.edit');
   Route::put('update-category/{id?}', [CategoryController::class, 'update'])->name('account.category.update');
   Route::post('destroy-category/{id?}', [CategoryController::class, 'destroy'])->name('account.category.destroy');

   //banks
   Route::get('banks', [BankController::class, 'index'])->name('banks.index');
   Route::post('store-banks', [BankController::class, 'store'])->name('banks.store');
   Route::post('edit-bank', [BankController::class, 'edit'])->name('banks.edit');
   Route::put('update-bank/{id?}', [BankController::class, 'update'])->name('banks.update');
   Route::post('destroy-bank/{id?}', [BankController::class, 'destroy'])->name('banks.destroy');

   //bank-accounts
   Route::get('bank-accounts', [BankAccountController::class, 'index'])->name('bank-acc.index');
   Route::post('store-bank-accounts', [BankAccountController::class, 'store'])->name('bank-acc.store');
   Route::post('edit-bank-accounts', [BankAccountController::class, 'edit'])->name('bank-acc.edit');
   Route::put('update-bank-accounts/{id?}', [BankAccountController::class, 'update'])->name('bank-acc.update');
   Route::post('destroy-bank-accounts/{id?}', [BankAccountController::class, 'destroy'])->name('bank-acc.destroy');
   Route::post('destroy-bank-accounts/{id?}', [BankAccountController::class, 'destroy'])->name('bank-acc.destroy');

   //transfers-histories
   Route::get('transfer-histories', [AccountTransferController::class, 'index'])->name('balance-transfers.index');
   Route::post('store-balance-transfer', [AccountTransferController::class, 'store'])->name('balance-transfers.store');

   //debts-loans
   Route::get('debts', [DebtLoanController::class, 'index'])->name('debts.index');
   Route::post('store-debts', [DebtLoanController::class, 'store'])->name('debts.store');
   Route::get('manage-debt/{id?}', [DebtLoanController::class, 'manageBorrow'])->name('manage-borrow.index');
   Route::post('borrow-more/{id?}', [DebtLoanController::class, 'borrowMore'])->name('borrowMore.store');
   Route::post('repay-borrow/{id?}', [DebtLoanController::class, 'repayBorrow'])->name('repayBorrow.store');
   Route::post('lend-more/{id?}', [DebtLoanController::class, 'lendMore'])->name('lendMore.store');
   Route::post('debt-collection/{id?}', [DebtLoanController::class, 'debtcollection'])->name('debtcollection.store');

   //incomes
   Route::get('incomes', [IncomeController::class, 'index'])->name('index.income');
   Route::post('store-income', [IncomeController::class, 'store'])->name('store.income');
   Route::get('edit-income/{id?}', [IncomeController::class, 'edit'])->name('edit.income');
   Route::put('update-income/{id?}', [IncomeController::class, 'update'])->name('update.income');
   Route::post('destroy-income/{id?}', [IncomeController::class, 'destroy'])->name('destroy.income');
   
   //expenses
   Route::get('expenses', [ExpenseController::class, 'index'])->name('index.expense');
   Route::get('create-expense', [ExpenseController::class, 'create'])->name('create.expense');
   Route::post('store-expense', [ExpenseController::class, 'store'])->name('store.expense');
   Route::post('edit-expense', [ExpenseController::class, 'edit'])->name('edit.expense');
   Route::put('update-expense/{id?}', [ExpenseController::class, 'update'])->name('update.expense');
   Route::post('destroy-expense/{id?}', [ExpenseController::class, 'destroy'])->name('destroy.expense');

});

Route::group(['prefix' => 'superadmin', 'middleware' => ['auth', 'superadmin', 'revalidate'], 'as' => 'superadmin.'], function() {
    Route::get('-dashboard', [SuperAdminIndexController::class, 'dashboard'])->name('sdashboard');

    //users 
    Route::get('users', [UserController::class, 'index'])->name('all-users');
    Route::post('store-users', [UserController::class, 'store'])->name('store-users');
    Route::post('edit-user', [UserController::class, 'editUser'])->name('edit-user');
    Route::put('update-user/{id?}', [UserController::class, 'update'])->name('update-user');

    //plans 
    Route::get('plans', [PlanController::class, 'index'])->name('plans');
    Route::post('store-plans', [PlanController::class, 'store'])->name('store-plan');
    Route::post('edit-plan', [PlanController::class, 'edit'])->name('edit.plan');
    Route::put('update-plan/{id?}', [PlanController::class, 'update'])->name('update.plan');

});


Route::get('artisan/{cmd}',function($cmd){
    Artisan::call("{$cmd}");
    dd(Artisan::output());
});

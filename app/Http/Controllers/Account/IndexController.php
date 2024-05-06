<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountCategory;
use App\Models\Account\BankAccount;
use App\Models\Account\DebtLoan;
use App\Models\Account\Expense;
use App\Models\Account\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function dashboard(){

        $IncomemonthlySum = $this->getIncomeByMonths();
        $ExpensemonthlySum = $this->getExpenseByMonths();
        $totalLendAmount = DebtLoan::where('created_by', \Auth::user()->creatorId())->where('type_id', 1)->sum('amount');
        $totalBorrowAmount = DebtLoan::where('created_by', \Auth::user()->creatorId())->where('type_id', 2)->sum('amount');
        $totalBankAccount = BankAccount::where('created_by', \Auth::user()->creatorId())->count();

        $totalExpensesArray = AccountCategory::where('created_by', \Auth::user()->creatorId())
        ->where('cat_type_id', 2)
        ->get()
        ->mapWithKeys(function ($cat) {
            $expenses = $cat->expenses()->whereMonth('date', Carbon::now()->month)->get();
            return [$cat->name => $expenses->sum('amount')];
        });
        $ExpensenameArray = $totalExpensesArray->keys()->toArray();
        $ExpenseamountArray = $totalExpensesArray->values()->toArray();

        $totalIncomesArray = AccountCategory::where('created_by', \Auth::user()->creatorId())
        ->where('cat_type_id', 1)
        ->get()
        ->mapWithKeys(function ($cat) {
            $incomes = $cat->incomes()->whereMonth('date', Carbon::now()->month)->get();
            return [$cat->name => $incomes->sum('amount')];
        });
        $IncomenameArray = $totalIncomesArray->keys()->toArray();
        $IncomeamountArray = $totalIncomesArray->values()->toArray();
        // dd($IncomenameArray, $IncomeamountArray);
    
        return view('accounts.dashboard.dashboard', 
        compact('IncomemonthlySum', 'ExpensemonthlySum', 'totalLendAmount', 'totalBorrowAmount', 
        'totalBankAccount', 'ExpensenameArray', 'ExpenseamountArray', 'IncomenameArray', 'IncomeamountArray'
        ));
    }

    private function getIncomeByMonths(){
        $currentYear = Carbon::now()->year;

        $incomes = Income::whereYear('date', $currentYear)->where('created_by', \Auth::user()->creatorId())->get();
        $IncomemonthlySum = array_fill(0, 12, 0);
        foreach ($incomes as $income) { 
            $monthIndex = Carbon::parse($income->date)->month - 1;
            $IncomemonthlySum[$monthIndex] += $income->amount;
        }

        return  $IncomemonthlySum;
    }

    private function getExpenseByMonths(){
        $currentYear = Carbon::now()->year;

        $expenses = Expense::whereYear('date', $currentYear)->where('created_by', \Auth::user()->creatorId())->get();
        $ExpensemonthlySum = array_fill(0, 12, 0);
        foreach ($expenses as $expense) { 
            $emonthIndex = Carbon::parse($expense->date)->month - 1;
            $ExpensemonthlySum[$emonthIndex] += $expense->amount;
        }

        return  $ExpensemonthlySum;
    }

}

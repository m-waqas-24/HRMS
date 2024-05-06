<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountCategory;
use App\Models\Account\BankAccount;
use App\Models\Account\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(){
        $expenses = Expense::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();
        $expenseCategories = AccountCategory::where('created_by', \Auth::user()->creatorId())->where('cat_type_id', 2)->orderBy('id', "DESC")->get();
        $bankAccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();

        return view('accounts.expense.index', compact('expenses', 'expenseCategories', 'bankAccounts'));
    }

    public function create(){
        $expenseCategories = AccountCategory::where('created_by', \Auth::user()->creatorId())->where('cat_type_id', 2)->orderBy('id', "DESC")->get();
        $bankAccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();

        return view('accounts.expense.create', compact('expenseCategories', 'bankAccounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'bank_acc_id' => 'required|array',
            'amount' => 'required|array',
            'date' => 'required|array',
        ]);

        $validatedData = $request->all();
        $accountAmounts = [];

        foreach ($validatedData['bank_acc_id'] as $index => $accountId) {
            $accountAmounts[$accountId] = ($accountAmounts[$accountId] ?? 0) + $validatedData['amount'][$index];
        }

        foreach ($accountAmounts as $accountId => $totalAmount) {
            $account = BankAccount::find($accountId);
            $accountBalance = $account->balance;

            if ($accountBalance < $totalAmount) {
                return redirect()->route('admin.index.expense')->withErrors('Insufficient balance for the selected bank account.');
            }
        }

        foreach ($accountAmounts as $accountId => $totalAmount) {
            $account = BankAccount::find($accountId);
            $account->balance -= $totalAmount;
            $account->save();
        }

        foreach ($validatedData['type_id'] as $index => $typeId) {
            $expense_img = uploadFile($request, 'expense_img.' . $index, 'public/accounts/expense_img');
            Expense::create([
                'type_id' => $typeId,
                'bank_acc_id' => $validatedData['bank_acc_id'][$index],
                'amount' => $validatedData['amount'][$index],
                'date' => $validatedData['date'][$index],
                'note' => $validatedData['note'][$index],
                'img' => $expense_img,
                'created_by' => \Auth::user()->creatorId(),
            ]);
        }

        return redirect()->route('admin.index.expense');
    }

    public function edit(Request $request){
      $id = $request->expenseId;
      $expense = Expense::find($id);

      return response()->json(['expense' => $expense]);
    }

    public function update(Request $request, $id){

        $request->validate([
            "type_id" => 'required',
            "bank_acc_id" => 'required',
            "amount" => 'required',
            "date" => 'required',
        ]);
    
        $expense = Expense::find($id);
    
        $oldBankAcc = BankAccount::find($expense->bank_acc_id);
        $oldBankAcc->update([
            'balance' => $oldBankAcc->balance + $expense->amount,
        ]);
    
      
        if ($request->hasFile('expense_img')) {
            $expense_img = uploadFile($request, 'expense_img', 'public/accounts/expense_img');
        }else{
            $expense_img = $expense->img; 
        }
    
        $expense->update([
            "type_id" => $request->type_id,
            "bank_acc_id" => $request->bank_acc_id,
            "amount" => $request->amount,
            "date" => $request->date,
            "note" => $request->note,
            "img" => $expense_img,
        ]);
    
        $newBankAcc = BankAccount::find($request->bank_acc_id);

        if($newBankAcc->balance >= $request->amount){
            $newBankAcc->update([
                'balance' => $newBankAcc->balance - $request->amount,
            ]);
        }else{
            return redirect()->route('admin.index.expense')->withErrors('Insufficient balance for the selected bank account.');
        }
    
        return redirect()->route('admin.index.expense')->withSuccess('Expense updated successfully!');
    }

    public function destroy($id){
        $expense = Expense::find($id);
    
        $bankAcc = BankAccount::find($expense->bank_acc_id);
        $bankAcc->update([
            'balance' => $bankAcc->balance + $expense->amount,
        ]);
    
        $expense->delete();
    
        return back()->withSuccess('Expense deleted successfully!');
    }

}

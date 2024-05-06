<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountCategory;
use App\Models\Account\BankAccount;
use App\Models\Account\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(){
        $incomes = Income::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();
        $incomeCategories = AccountCategory::where('created_by', \Auth::user()->creatorId())->where('cat_type_id', 1)->orderBy('id', "DESC")->get();
        $bankAccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();

        return view('accounts.income.index', compact('incomes', 'incomeCategories', 'bankAccounts'));
    }

    public function store(Request $request){

        $request->validate([
            "type_id" => 'required',
            "bank_acc_id" => 'required',
            "amount" => 'required',
            "date" => 'required',
        ]);

        $bankAcc = BankAccount::find($request->bank_acc_id);
        $bankAcc->update([
            'balance' => $bankAcc->balance + $request->amount,
        ]);

        $income_img = uploadFile($request, 'income_img', 'public/accounts/income_img');

        Income::create([
            "type_id" => $request->type_id,
            "bank_acc_id" => $request->bank_acc_id,
            "amount" => $request->amount,
            "reference" => $request->reference,
            "date" => $request->date,
            "note" => $request->note,
            "img" => $income_img,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Income added successfully!');
    }

    public function edit($id){
        $income = Income::find($id);
        $incomeCategories = AccountCategory::where('created_by', \Auth::user()->creatorId())->where('cat_type_id', 1)->orderBy('id', "DESC")->get();
        $bankAccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();

        return view('accounts.income.edit', compact('income', 'incomeCategories', 'bankAccounts'));
    }

    public function update(Request $request, $id){
        $request->validate([
            "type_id" => 'required',
            "bank_acc_id" => 'required',
            "amount" => 'required',
            "date" => 'required',
        ]);
    
        $income = Income::findOrFail($id);
    
        $oldBankAcc = BankAccount::find($income->bank_acc_id);
        $oldBankAcc->update([
            'balance' => $oldBankAcc->balance - $income->amount,
        ]);
    
      
        if ($request->hasFile('income_img')) {
            $newIncomeImg = uploadFile($request, 'income_img', 'public/accounts/income_img');
        }else{
            $newIncomeImg = $income->img; 
        }
    
        $income->update([
            "type_id" => $request->type_id,
            "bank_acc_id" => $request->bank_acc_id,
            "amount" => $request->amount,
            "reference" => $request->reference,
            "date" => $request->date,
            "note" => $request->note,
            "img" => $newIncomeImg,
        ]);
    
        $newBankAcc = BankAccount::find($request->bank_acc_id);
        $newBankAcc->update([
            'balance' => $newBankAcc->balance + $request->amount,
        ]);
    
        return redirect()->route('admin.index.income')->withSuccess('Income updated successfully!');
    }


    public function destroy($id){
        $income = Income::findOrFail($id);
    
        $bankAcc = BankAccount::find($income->bank_acc_id);
        $bankAcc->update([
            'balance' => $bankAcc->balance - $income->amount,
        ]);
    
        $income->delete();
    
        return back()->withSuccess('Income deleted successfully!');
    }
}

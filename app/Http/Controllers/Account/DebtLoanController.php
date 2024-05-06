<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\BankAccount;
use App\Models\Account\DebtInstallment;
use App\Models\Account\DebtLoan;
use App\Models\Account\DebtType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtLoanController extends Controller
{
    public function index(){

        if(\Auth::user()->can('manage debts-loans')){
            $bankAccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();
            $types = DebtType::all();
            $debts = DebtLoan::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();
    
            return view('accounts.debt-loans.index', compact('bankAccounts', 'types', 'debts'));
        }
        else
        {
        return back()->withError('Permission Denied');
        }
    }

    public function store(Request $request){

        $request->validate([
            "person" => 'required',
            "amount" => 'required',
            "bank_acc" => 'required',
            "type" => 'required',
            "date" => 'required',
        ]);

        $bankAcc = BankAccount::find($request->bank_acc);

        if($request->type == 1){
            if($bankAcc->balance >= $request->amount){
                $bankAcc->update([
                    'balance' => $bankAcc->balance - $request->amount,
                ]);
            }else{
                return back()->withErrors('Insufficient balance in the bank account.');
            }
        }else if($request->type == 2){
            $bankAcc->update([
                'balance' => $bankAcc->balance + $request->amount,
            ]);
        }

        $debt = DebtLoan::create([
            "person" => $request->person,
            "amount" => $request->amount,
            "bank_acc_id" => $request->bank_acc,
            "type_id" => $request->type,
            "date" => $request->date,
            "note" => $request->note,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        DebtInstallment::create([
            'debtloan_id' => $debt->id,
            "amount" => $request->amount,
            "bank_acc_id" => $request->bank_acc,
            "type_id" => $request->type,
            "date" => $request->date,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        if($request->type == 1){
            return back()->withSuccess('Lend added successfully!');
        }else if($request->type == 2){
            return back()->withSuccess('Borrow added successfully!');
        }
    }


   //manage debts functions
    public function manageBorrow($id){
        $debt = DebtLoan::find($id);
        $type = $debt->type->name;
        $bankAccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->orderBy('id','DESC')->get();

        return view('accounts.debt-loans.manage-debt', compact('debt', 'type', 'bankAccounts'));
    }

    public function borrowMore(Request $request, $id){

        $request->validate([
            "amount" => 'required',
            "bank_acc" => 'required',
            "date" => 'required',
        ]);

        $debt = DebtLoan::find($id);
        $debt->update([
            'amount' =>  $debt->amount + $request->amount,
        ]);

        $bankAcc = BankAccount::find($request->bank_acc);
        $bankAcc->update([
            'balance' => $bankAcc->balance + $request->amount,
        ]);

        DebtInstallment::create([
            'debtloan_id' => $debt->id,
            "amount" => $request->amount,
            "bank_acc_id" => $request->bank_acc,
            "type_id" => 2,
            "date" => $request->date,
            'created_by' => \Auth::user()->creatorId(),
        ]);
        
        return back()->withSuccess('Borrow added successfully!');
    }

    public function repayBorrow(Request $request, $id){

        $request->validate([
            "amount" => 'required',
            "bank_acc" => 'required',
            "date" => 'required',
        ]);
    
        $bankAcc = BankAccount::find($request->bank_acc);
        $debt = DebtLoan::find($id);
    
        // Check if the bank account has sufficient balance
        if ($bankAcc->balance >= $request->amount) {
    
            // Check if the repayment amount is not greater than the remaining debt amount
            if ($request->amount <= $debt->amount) {
                $debt->update([
                    'amount' =>  $debt->amount - $request->amount,
                ]);
                $bankAcc->update([
                    'balance' => $bankAcc->balance - $request->amount,
                ]);
    
                DebtInstallment::create([
                    'debtloan_id' => $debt->id,
                    "amount" => $request->amount,
                    "bank_acc_id" => $request->bank_acc,
                    "type_id" => 3,
                    "date" => $request->date,
                    'created_by' => \Auth::user()->creatorId(),
                ]);
    
                return back()->withSuccess('Repayment added successfully!');
            } else {
                return back()->withErrors('Repayment amount cannot be greater than the remaining debt amount.');
            }
        } else {
            return back()->withErrors('Insufficient balance in the bank account.');
        }
    }
    
    public function lendMore(Request $request, $id){

        $request->validate([
            "amount" => 'required',
            "bank_acc" => 'required',
            "date" => 'required',
        ]);

        $debt = DebtLoan::find($id);
        $bankAcc = BankAccount::find($request->bank_acc);
        if($bankAcc->balance >= $request->amount){
            $debt->update([
                'amount' =>  $debt->amount + $request->amount,
            ]);
            $bankAcc->update([
                'balance' => $bankAcc->balance - $request->amount,
            ]);
    
            DebtInstallment::create([
                'debtloan_id' => $debt->id,
                "amount" => $request->amount,
                "bank_acc_id" => $request->bank_acc,
                "type_id" => 1,
                "date" => $request->date,
                'created_by' => \Auth::user()->creatorId(),
            ]);
            
            return back()->withSuccess('Lend added successfully!');
        }else {
            return back()->withErrors('Insufficient balance in the bank account.');
    }
    }
    
    public function debtcollection(Request $request, $id){

        $request->validate([
            "amount" => 'required',
            "bank_acc" => 'required',
            "date" => 'required',
        ]);

        $debt = DebtLoan::find($id);
        $bankAcc = BankAccount::find($request->bank_acc);

            if($debt->amount >= $request->amount){
                $debt->update([
                    'amount' =>  $debt->amount - $request->amount,
                ]);
                $bankAcc->update([
                    'balance' => $bankAcc->balance + $request->amount,
                ]);
        
                DebtInstallment::create([
                    "debtloan_id" => $debt->id,
                    "amount" => $request->amount,
                    "bank_acc_id" => $request->bank_acc,
                    "type_id" => 4,
                    "date" => $request->date,
                    "created_by" => \Auth::user()->creatorId(),
                ]);
                
                return back()->withSuccess('Debt collection added successfully!');
            }else {
                return back()->withErrors('Debt Collection amount cannot be greater than the Lend amount.');
            }
    }

}

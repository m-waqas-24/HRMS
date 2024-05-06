<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Bank;
use App\Models\Account\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage bank-accounts')){
            $banks = Bank::where('created_by', \Auth::user()->creatorId())->get();
            $bankaccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->get();
            return view('accounts.bank-accounts.index', compact('bankaccounts', 'banks'));
        }
        else
        {
            return back()->withError('Permission Denied');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            "account_holder" => "required",
            "bank" => "required",
            "account_no" => "required",
            "balance" => "required",
        ]);

        BankAccount::create([
            "account_holder" => $request->account_holder,
            "bank_id" => $request->bank,
            "account_no" => $request->account_no,
            "balance" => $request->balance,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Bank-account created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->bankId;

        $bankacc = BankAccount::find($id);

        return response()->json(['bankacc' => $bankacc]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "account_holder" => "required",
            "bank" => "required",
            "account_no" => "required",
            "balance" => "required",
        ]);

        $bankacc = BankAccount::find($id);

       $bankacc->update([
            "account_holder" => $request->account_holder,
            "bank_id" => $request->bank,
            "account_no" => $request->account_no,
            "balance" => $request->balance,
        ]);

        return back()->withSuccess('Bank-account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete bank-accounts')){
            $bankacc = BankAccount::find($id);

            if($bankacc){
                $bankacc->delete();
            }
    
            return back()->withSuccess('Bank-account deleted successfully!');
        }
        else
        {
        return back()->withError('Permission Denied');
        }
    }
}

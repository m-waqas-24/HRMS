<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\BalanceTransfer;
use App\Models\Account\Bank;
use App\Models\Account\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('manage balance-transfers')){
            $transfers = BalanceTransfer::where('created_by', \Auth::user()->creatorId())->get();
            $bankAccounts = BankAccount::where('created_by', \Auth::user()->creatorId())->get();
            
            return view('accounts.transfers.index', compact('transfers', 'bankAccounts'));
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
            "from" => "required",
            "to" => "required",
            "amount" => "required",
            "date" => "required",
        ]);

        $from = BankAccount::find($request->from);
        $to = BankAccount::find($request->to);

        $from->update([
            'balance' => $from->balance - $request->amount,
        ]);

        $to->update([
            'balance' => $to->balance + $request->amount,
        ]);

        BalanceTransfer::create([
            "from" => $request->from,
            "to" => $request->to,
            "amount" => $request->amount,
            "date" => $request->date,
            "note" => $request->note,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Balance Transfer successfully!');
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

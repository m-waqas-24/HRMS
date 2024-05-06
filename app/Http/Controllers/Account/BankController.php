<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage banks')){
            $banks = Bank::where('created_by', \Auth::user()->creatorId())->get();
            return view('accounts.banks.index', compact('banks'));
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
            'name' => 'required',
        ]);

        Bank::create([
            'name' => $request->name,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Bank created successfully!');
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

        $bank = Bank::find($id);

        return response()->json(['bank' => $bank]);
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
        $bank = Bank::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $bank->update([
            'name' => $request->name,
        ]);

        return back()->withSuccess('Bank updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('delete banks')){
            $bank = Bank::find($id);
            if ($bank) {
                $bank->bankAccounts->each(function ($bankAccount) {
                    $bankAccount->debts()->delete();
                    $bankAccount->incomes()->delete();
                    $bankAccount->expenses()->delete();
                    $bankAccount->fromtransfers()->delete();
                    $bankAccount->delete();
                });
    
                $bank->delete();
                return back()->withSuccess('Bank deleted successfully!');
            }
        }
        else
        {
        return back()->withError('Permission Denied');
        }
    }
}

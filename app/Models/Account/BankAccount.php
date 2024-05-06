<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function debts(){
        return $this->hasMany(DebtLoan::class, 'bank_acc_id', 'id');
    }

    public function incomes(){
        return $this->hasMany(Income::class, 'bank_acc_id', 'id');
    }

    public function expenses(){
        return $this->hasMany(Expense::class, 'bank_acc_id', 'id');
    }

    public function fromtransfers(){
        return $this->hasMany(BalanceTransfer::class, 'from', 'id');
    }   
    
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($bankacc) {
            $bankacc->debts()->delete();
            $bankacc->incomes()->delete();
            $bankacc->expenses()->delete();
            $bankacc->fromtransfers()->delete();
        });
    }

}

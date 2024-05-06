<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DebtInstallment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function type(){
        return $this->belongsTo(DebtType::class, 'type_id', 'id');
    }

    public function bankAccount(){
        return $this->belongsTo(BankAccount::class, 'bank_acc_id', 'id');
    }
}

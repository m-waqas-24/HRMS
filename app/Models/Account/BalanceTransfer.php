<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function fromBank(){
        return $this->belongsTo(BankAccount::class, 'from', 'id');
    }

    public function toBank(){
        return $this->belongsTo(BankAccount::class, 'to', 'id');
    }
}

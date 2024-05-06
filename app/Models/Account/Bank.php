<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class, 'bank_id', 'id');
    }
}

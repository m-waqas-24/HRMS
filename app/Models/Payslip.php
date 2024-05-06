<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payslip extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id');
    }

    public function Month(){
        return $this->belongsTo(Month::class, 'month', 'id');
    }
}

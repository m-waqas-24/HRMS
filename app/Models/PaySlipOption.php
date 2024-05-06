<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaySlipOption extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function payslipOption(){
        return $this->hasMany(Salary::class, 'paymentslip_option', 'id');
    }

}

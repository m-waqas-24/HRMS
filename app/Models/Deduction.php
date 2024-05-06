<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Deduction extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;

    protected $guarded = [];

    protected static $logName = 'deduction';

    protected static $logAttributes = ['title', 'amount'];

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            self::$logName = 'Create Deduction';
            return auth()->user()->name . " create " . $this->deductionOption->name .  " deduction " . getSystemCurrency() . $this->amount . " for " . $this->employe->name;
        }

        if ($eventName == 'updated') {
            self::$logName = 'Update Deduction';
            return auth()->user()->name . ' update ' . $this->deductionOption->name . ' deduction ' . getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }

        if ($eventName == 'deleted') {
            self::$logName = 'Deleted Deduction';
            return auth()->user()->name . ' deleted ' . $this->deductionOption->name . ' deduction '. getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }
    
        return self::$logName; 
    }


    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id');
    }

    public function deductionOption(){
        return $this->belongsTo(DeductionOption::class, 'deduction_option', 'id');
    }

}

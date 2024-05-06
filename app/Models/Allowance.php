<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Allowance extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;
    protected $guarded = [];

    protected static $logName = 'allowance';

    protected static $logAttributes = ['allowance_option', 'amount'];


    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            self::$logName = 'Assigned Allowance';
            return auth()->user()->name . " create " . $this->allowanceOption->name .  " allowance " . getSystemCurrency() . $this->amount . " for " . $this->employe->name;
        }

        if ($eventName == 'updated') {
            self::$logName = 'Update Allowance';
            return auth()->user()->name . ' update ' . $this->allowanceOption->name . ' allowance ' . getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }

        if ($eventName == 'deleted') {
            self::$logName = 'Deleted Allowance';
            return auth()->user()->name . ' deleted ' . $this->allowanceOption->name . ' allowance '. getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }
    
        return self::$logName; 
    }

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id');
    }

    public function allowanceOption(){
        return $this->belongsTo(AllowanceOption::class, 'allowance_option', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class OtherPayment extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;

    protected $guarded = [];

    protected static $logName = 'otherpayment';

    protected static $logAttributes = ['title', 'amount'];

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            self::$logName = 'Assigned Other Payment';
            return auth()->user()->name . " create " . $this->title .  " otherpayment " . getSystemCurrency() . $this->amount . " for " . $this->employe->name;
        }

        if ($eventName == 'updated') {
            self::$logName = 'Update Other Payment';
            return auth()->user()->name . ' update ' . $this->title . ' otherpayment ' . getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }

        if ($eventName == 'deleted') {
            self::$logName = 'Deleted Other Payment';
            return auth()->user()->name . ' deleted ' . $this->title . ' otherpayment '. getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }
    
        return self::$logName; 
    }

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id');
    }
}


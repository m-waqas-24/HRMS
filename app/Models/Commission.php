<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Commission extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;

    protected static $logName = 'commission';

    protected static $logAttributes = ['title', 'amount'];

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            self::$logName = 'Assigned Commission';
            return auth()->user()->name . " create " . $this->title .  " commission " . getSystemCurrency() . $this->amount . " for " . $this->employe->name;
        }

        if ($eventName == 'updated') {
            self::$logName = 'Update Commission';
            return auth()->user()->name . ' update ' . $this->title . ' commission ' . getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }

        if ($eventName == 'deleted') {
            self::$logName = 'Deleted Commission';
            return auth()->user()->name . ' deleted ' . $this->title . ' commission '. getSystemCurrency() . $this->amount . ' for ' . $this->employe->name;
        }
    
        return self::$logName; 
    }

    protected $guarded = [];

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id');
    }
}

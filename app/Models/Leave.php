<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Leave extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;

    protected $guarded = [];

    protected $logAttributes = ['status'];

    protected static $logName = 'leave';

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            self::$logName = 'Leave Approval Request';
            return auth()->user()->name . " created a Leave";
        }
    
        if ($eventName == 'updated') {
            self::$logName = 'Leave Updated'; 
            return auth()->user()->name . ' ' . $this->leaveStatus->name . " Leave of " . $this->employe->name;
        }

        if ($eventName == 'deleted') {
            self::$logName = 'Leave Deleted';
            return auth()->user()->name . ' deleted ' . " Leave of " . $this->employe->name;
        }
    
        return self::$logName; 
    }
    

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id')->withTrashed();
    }

    public function leaveType(){
        return $this->belongsTo(Status::class, 'leave_type', 'id');
    }

    public function leaveStatus(){
        return $this->belongsTo(LeaveStatus::class, 'status', 'id');
    }
}

<?php

namespace App\Models\Admin;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Trainer extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;

    protected $guarded = [];

    protected static $logName = 'trainer';

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            self::$logName = 'Create Trainer';
            return auth()->user()->name . " create trainer " . $this->name;
        }

        if ($eventName == 'updated') {
            self::$logName = 'Update Trainer';
            return auth()->user()->name . " update trainer " . $this->name;
        }

        if ($eventName == 'deleted') {
            self::$logName = 'Deleted Trainer';
            return auth()->user()->name . " delete trainer " . $this->name;
        }
    
        return self::$logName; 
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    
    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}

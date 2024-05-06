<?php

namespace App\Models;

use App\Models\Admin\Trainer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class TrainingList extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;
    
    protected $guarded = [];

    protected static $logName = 'traininglist';

    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            self::$logName = 'Create Training';
            return auth()->user()->name . " create " . $this->trainingType->name . ' with Trainer ' . $this->trainer->name . " for " . $this->employe->name . ' that cost ' . getSystemCurrency() . $this->cost;
        }

        if ($eventName == 'updated') {
            self::$logName = 'Update Training';
            return auth()->user()->name . " update " . $this->trainingType->name . ' with Trainer ' . $this->trainer->name . " for " . $this->employe->name . ' that cost ' . getSystemCurrency() . $this->cost;
        }

        if ($eventName == 'deleted') {
            self::$logName = 'Deleted Training';
            return auth()->user()->name . " deleted " . $this->trainingType->name . ' with Trainer ' . $this->trainer->name . " for " . $this->employe->name . ' that cost ' . getSystemCurrency() . $this->cost;
        }
    
        return self::$logName; 
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    
    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function trainingType(){
        return $this->belongsTo(TrainingType::class, 'training_type', 'id');
    }

    public function trainer(){
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }

    public function employe(){
        return $this->belongsTo(Employe::class, 'employee_id', 'id')->withTrashed();
    }


    
}

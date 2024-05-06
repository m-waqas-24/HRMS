<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Termination extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id')->withTrashed();
    }
    public function terminationType(){
        return $this->belongsTo(TerminationType::class, 'termination_type', 'id');
    }
}

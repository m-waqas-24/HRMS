<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function candidate(){
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id');
    }
}


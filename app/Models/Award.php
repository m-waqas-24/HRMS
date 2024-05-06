<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id')->withTrashed();
    }

    public function gift(){
        return $this->belongsTo(Gift::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
}

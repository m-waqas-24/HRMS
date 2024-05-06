<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hrm_jobs';

    protected $guarded = [];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

}

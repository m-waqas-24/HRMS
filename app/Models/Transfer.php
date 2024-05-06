<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id')->withTrashed();
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function prevCompany(){
        return $this->belongsTo(Company::class, 'prev_company_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function prevBranch(){
        return $this->belongsTo(Branch::class, 'prev_branch_id', 'id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

}

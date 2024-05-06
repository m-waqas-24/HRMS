<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAsset extends Model
{
    use HasFactory;
    USE SoftDeletes;

    protected $table = 'employee_assets';

    protected $guarded = [];

    public function employe(){
        return $this->belongsTo(Employe::class, 'emp_id', 'id');
    }
    
    public function assetName(){
        return $this->belongsTo(Asset::class, 'asset', 'id');
    }

    public function assetStatus(){
        return $this->belongsTo(AssetStatus::class, 'status', 'id');
    }

}

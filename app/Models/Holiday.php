<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Holiday extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'holidays';

    protected $guarded = [];
    
}

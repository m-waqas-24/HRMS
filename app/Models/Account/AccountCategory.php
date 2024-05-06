<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function type(){
        return $this->belongsTo(AccountCategoryType::class, 'cat_type_id', 'id');
    }

    public function expenses(){
        return $this->hasMany(Expense::class, 'type_id', 'id');
    }
    public function incomes(){
        return $this->hasMany(Income::class, 'type_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            $category->incomes()->delete();
            $category->expenses()->delete();
        });
    }
    
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'role_id',
        'type',
        'created_by',
        'plan',
        'subscription_start_date',
        'subscription_end_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function creatorId()
    {
        if($this->type == 'company')
        {
            return $this->id;
        }
        else
        {
            return $this->created_by;
        }
    }


    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan', 'id'); 
    }

    public function employe()
    {
        return $this->hasOne(Employe::class, 'user_id', 'id'); 
    }

    public function getRoleName(){
        $id = $this->roles->pluck('id')->first();
        $role = Role::find($id);

        return $role->name;
    }

}

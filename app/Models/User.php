<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'province_id', 'regency_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'roles', 'permissions'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime:d/m/Y H:m',
        'updated_at'        => 'datetime:d/m/Y H:m'
    ];

    public function get_roles(){
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }
}

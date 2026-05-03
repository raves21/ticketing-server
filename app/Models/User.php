<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $with = [
        'unit'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function unitRoles()
    {
        return $this->hasMany(UserUnitRole::class);
    }

    // public function roleInUnit()
    // {
    //     return $this->hasOne(UserUnitRole::class);
    // }

    // public function getRoleInUnitAttribute()
    // {
    //     return $this->unitRoles()->first();
    // }

    // public function getRoleNameAttribute()
    // {
    //     return $this->roleInUnit?->role;
    // }
}

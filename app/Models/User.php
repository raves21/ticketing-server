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
        'rootUnit'
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

    public function rootUnit()
    {
        return $this->belongsTo(Unit::class, 'root_unit_id');
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'user_unit_roles', 'user_id', 'unit_id')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function unitRoles()
    {
        return $this->hasMany(UserUnitRole::class);
    }

    public function ticketsInvolved()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_involved_users', 'user_id', 'ticket_id')->withTimestamps();
    }
}

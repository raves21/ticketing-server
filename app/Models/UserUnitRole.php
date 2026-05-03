<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserUnitRole extends Model
{
    public const ROLE_STAFF = 'staff';
    public const ROLE_TEAM_LEAD = 'team_lead';
    public const ROLE_DIVISION_HEAD = 'division_head';
    public const ROLE_OFFICE_HEAD = 'office_head';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserUnitRole extends Model
{
    public const STAFF = 'staff';

    public const ADMIN = 'admin';

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

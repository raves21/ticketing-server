<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];

    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    public function rootUnitMembers()
    {
        return $this->hasMany(User::class, 'root_unit_id');
    }

    public function unitMembers()
    {
        return $this->belongsToMany(User::class, 'user_unit_roles', 'unit_id', 'user_id')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function ticketsSent()
    {
        return $this->hasMany(Ticket::class, 'sender_unit_id');
    }

    public function ticketsReceived()
    {
        return $this->hasMany(Ticket::class, 'recipient_unit_id');
    }
}

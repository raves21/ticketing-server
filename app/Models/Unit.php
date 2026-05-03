<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];

    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    public function users()
    {
        return $this->hasMany(User::class);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function ticketsSent()
    {
        return $this->hasMany(Ticket::class, 'sender_office_id');
    }

    public function ticketsReceived()
    {
        return $this->hasMany(Ticket::class, 'recipient_office_id');
    }
}

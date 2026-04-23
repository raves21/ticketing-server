<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatusLog extends Model
{
    protected $guarded = ['id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function changedByUser()
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }
}

<?php

namespace App\Models;

use App\Enums\PriorityLevel;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'status' => TicketStatus::class,
        'priority_level' => PriorityLevel::class
    ];

    protected $with = [
        'senderUnit',
        'recipientUnit',
        'creator'
    ];

    public function senderUnit()
    {
        return $this->belongsTo(Unit::class, 'sender_unit_id');
    }

    public function recipientUnit()
    {
        return $this->belongsTo(Unit::class, 'recipient_unit_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function ticketStatusLogs()
    {
        return $this->hasMany(TicketStatusLog::class);
    }

    public function involvedUsers()
    {
        return $this->belongsToMany(User::class, 'ticket_involved_users', 'ticket_id', 'user_id')->withTimestamps();
    }
}

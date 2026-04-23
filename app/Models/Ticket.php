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
        'senderOffice',
        'recipientOffice',
        'creator'
    ];

    public function senderOffice()
    {
        return $this->belongsTo(Office::class, 'sender_office_id');
    }

    public function recipientOffice()
    {
        return $this->belongsTo(Office::class, 'recipient_office_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function ticketStatusLogs()
    {
        return $this->hasMany(TicketStatusLog::class);
    }
}

<?php

namespace App\Http\Repositories;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Http\Repositories\BaseRepository;
use DomainException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketRepository extends BaseRepository
{
    public function __construct(
        private Ticket $ticket
    ) {
        parent::__construct($ticket);
    }

    public function generateCode(array $payload)
    {
        // $senderUnit = Unit::find(Auth::user()->unit_id);
        // $recipientUnit = Unit::find($payload['recipient_unit_id']);

        $randomString = Str::upper(Str::random(5));

        return $randomString;
    }

    public function getAllSentByMyUnit(array $payload)
    {
        $search = $payload['search'] ?? null;
        $createdByMe = $payload['created_by_me'] ?? null;

        $query = $this->ticket
            ->where('sender_unit_id', Auth::user()->unit_id);

        if ($search) {
            $query->whereRaw("LOWER(title) LIKE LOWER(?)", "%{$search}%")
                ->orWhereRaw("LOWER(code) LIKE LOWER(?)", "%{$search}%");
        }

        if ($createdByMe) {
            $query->where('creator_id', Auth::user()->id);
        }

        return $query->latest()->with([
            'creator',
            'recipientUnit',
            'senderUnit'
        ])->paginate();
    }

    public function getAllAssignedToMyUnit(array $payload)
    {
        $search = $payload['search'] ?? null;
        $senderUnitId = $payload['sender_unit_id'] ?? null;

        $query = $this->ticket
            ->where('recipient_unit_id', Auth::user()->unit_id);

        if ($search) {
            $query->whereRaw("LOWER(title) LIKE LOWER(?)", "%{$search}%")
                ->orWhereRaw("LOWER(code) LIKE LOWER(?)", "%{$search}%");
        }

        if ($senderUnitId) {
            $query->where('sender_unit_id', $senderUnitId);
        }

        return $query->latest()->with([
            'creator',
            'recipientUnit',
            'senderUnit'
        ])->paginate();
    }

    public function changeStatus(string $id, TicketStatus $status)
    {
        $ticket = $this->findById($id);

        if (!$ticket->status->canTransitionTo($status)) {
            throw new DomainException("Invalid status change from {$ticket->status->value} to {$status->value}");
        }

        $ticket->update([
            'status' => $status
        ]);

        return $ticket->fresh();
    }
}

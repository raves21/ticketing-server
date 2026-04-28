<?php

namespace App\Http\Repositories;

use App\Enums\TicketStatus;
use App\Models\Office;
use App\Models\Ticket;
use App\Http\Repositories\BaseRepository;
use Auth;
use DomainException;
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
        // $senderOffice = Office::find(Auth::user()->office_id);
        // $recipientOffice = Office::find($payload['recipient_office_id']);

        $randomString = Str::upper(Str::random(5));

        return $randomString;
    }

    public function getAllSentByMyOffice(array $payload)
    {
        $search = $payload['search'] ?? null;
        $createdByMe = $payload['created_by_me'] ?? null;

        $query = $this->ticket
            ->where('sender_office_id', Auth::user()->office_id);

        if ($search) {
            $query->whereRaw("LOWER(title) LIKE LOWER(?)", "%{$search}%")
                ->orWhereRaw("LOWER(code) LIKE LOWER(?)", "%{$search}%");
        }

        if ($createdByMe) {
            $query->where('creator_id', Auth::user()->id);
        }

        return $query->latest()->with([
            'creator',
            'recipientOffice',
            'senderOffice'
        ])->paginate();
    }

    public function getAllAssignedToMyOffice(array $payload)
    {
        $search = $payload['search'] ?? null;
        $senderOfficeId = $payload['sender_office_id'] ?? null;

        $query = $this->ticket
            ->where('recipient_office_id', Auth::user()->office_id);

        if ($search) {
            $query->whereRaw("LOWER(title) LIKE LOWER(?)", "%{$search}%")
                ->orWhereRaw("LOWER(code) LIKE LOWER(?)", "%{$search}%");
        }

        if ($senderOfficeId) {
            $query->where('sender_office_id', $senderOfficeId);
        }

        return $query->latest()->with([
            'creator',
            'recipientOffice',
            'senderOffice'
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

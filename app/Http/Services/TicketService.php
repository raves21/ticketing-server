<?php

namespace App\Http\Services;

use App\Http\Repositories\TicketRepository;
use App\Http\Repositories\TicketStatusLogRepository;
use App\Http\Resources\TicketResource;
use App\Enums\TicketStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function __construct(
        private TicketRepository $ticketRepo,
        private TicketStatusLogRepository $ticketStatusLogRepo
    ) {
    }

    public function getAll()
    {
        //admin only
        return TicketResource::collection($this->ticketRepo->getAll());
    }

    public function getTicketsReceivedByUnit(array $payload)
    {
        return TicketResource::collection($this->ticketRepo->getAll(filters: ['recipient_unit_id' => $payload['unit_id']]));
    }

    public function getTicketsSentByUnit(array $payload)
    {
        return TicketResource::collection($this->ticketRepo->getAll(filters: ['sender_unit_id' => $payload['unit_id']]));
    }

    public function changeStatus(string $id, array $payload)
    {
        try {
            DB::beginTransaction();
            //change ticket status
            $ticket = $this->ticketRepo->changeStatus($id, TicketStatus::from($payload['status']));

            //create ticketstatuslog entry
            $this->ticketStatusLogRepo->create([
                'ticket_id' => $ticket->id,
                'old_status' => $ticket->status,
                'new_status' => $payload['status'],
                'changed_by_user_id' => auth()->user()->id,
                'reason' => $payload['reason'] ?? null
            ]);
            DB::commit();
            return new TicketResource($ticket->fresh());
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function findById(string $id)
    {
        return new TicketResource($this->ticketRepo->findById($id));
    }

    public function create(array $payload)
    {
        $creator = Auth::user();

        if ($creator->unit_id === $payload['recipient_unit_id']) {
            abort(400, 'Recipient Unit cannot be the same as sender Unit');
        }

        //create ticket
        $newTicket =
            $this->ticketRepo->create([
                ...$payload,
                'creator_id' => $creator->id,
                'sender_unit_id' => $creator->unit_id,
                'code' => $this->ticketRepo->generateCode($payload)
            ]);

        //create ticket status log
        $this->ticketStatusLogRepo->create([
            'ticket_id' => $newTicket->id,
            'old_status' => null,
            'new_status' => TicketStatus::PENDING,
            'changed_by_user_id' => $creator->id,
            'reason' => 'Ticket created'
        ]);

        return new TicketResource($newTicket->fresh()->load('creator.unit.bloodline'));
    }

    public function updateById(string $id, array $payload)
    {
        return new TicketResource($this->ticketRepo->updateById($id, $payload));
    }

    public function deleteById(string $id)
    {
        return $this->ticketRepo->deleteById($id);
    }
}

<?php

namespace App\Http\Services;

use App\Http\Repositories\TicketRepository;
use App\Http\Repositories\TicketStatusLogRepository;
use App\Http\Resources\TicketResource;
use App\Enums\TicketStatus;
use Auth;
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

    public function getAllAssignedToMyOffice(array $payload)
    {
        return TicketResource::collection($this->ticketRepo->getAllAssignedToMyOffice($payload));
    }

    public function getAllSentByMyOffice(array $payload)
    {
        return TicketResource::collection($this->ticketRepo->getAllSentByMyOffice($payload));
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
        $newTicket =
            $this->ticketRepo->create([
                ...$payload,
                'creator_id' => auth()->user()->id,
                'code' => $this->ticketRepo->generateCode($payload)
            ]);
        return new TicketResource($newTicket->fresh());
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

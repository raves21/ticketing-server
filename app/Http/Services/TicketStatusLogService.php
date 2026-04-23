<?php

namespace App\Http\Services;

use App\Http\Repositories\TicketStatusLogRepository;
use App\Http\Resources\TicketStatusLogResource;

class TicketStatusLogService
{
    public function __construct(
        private TicketStatusLogRepository $ticketStatusLogRepo
    ) {}

    public function getAll()
    {
        return TicketStatusLogResource::collection($this->ticketStatusLogRepo->getAll());
    }

    public function findById(string $id)
    {
        return new TicketStatusLogResource($this->ticketStatusLogRepo->findById($id));
    }

    public function create(array $payload)
    {
        return new TicketStatusLogResource($this->ticketStatusLogRepo->create($payload));
    }

    public function updateById(string $id, array $payload)
    {
        return new TicketStatusLogResource($this->ticketStatusLogRepo->updateById($id, $payload));
    }

    public function deleteById(string $id)
    {
        return $this->ticketStatusLogRepo->deleteById($id);
    }
}

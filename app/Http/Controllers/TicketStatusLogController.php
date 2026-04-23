<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketStatusLog\Store;
use App\Http\Requests\TicketStatusLog\Update;
use App\Http\Services\TicketStatusLogService;

class TicketStatusLogController extends Controller
{
    public function __construct(
        private TicketStatusLogService $ticketStatusLogService
    ) {}

    public function index()
    {
        return $this->ticketStatusLogService->getAll();
    }

    public function store(Store $request)
    {
        return $this->ticketStatusLogService->create($request->validated());
    }

    public function show(string $id)
    {
        return $this->ticketStatusLogService->findById($id);
    }

    public function update(Update $request, string $id)
    {
        return $this->ticketStatusLogService->updateById($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->ticketStatusLogService->deleteById($id);
    }
}

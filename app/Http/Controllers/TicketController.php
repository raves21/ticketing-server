<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\AssignedToMyOffice;
use App\Http\Requests\Ticket\ChangeStatus;
use App\Http\Requests\Ticket\SentByMyOffice;
use App\Http\Requests\Ticket\Store;
use App\Http\Requests\Ticket\Update;
use App\Http\Services\TicketService;

class TicketController extends Controller
{
    public function __construct(
        private TicketService $ticketService
    ) {
    }

    public function index()
    {
        return $this->ticketService->getAll();
    }

    public function store(Store $request)
    {
        return $this->ticketService->create($request->validated());
    }

    public function show(string $id)
    {
        return $this->ticketService->findById($id);
    }

    public function update(Update $request, string $id)
    {
        return $this->ticketService->updateById($id, $request->validated());
    }

    public function destroy(string $id)
    {
        return $this->ticketService->deleteById($id);
    }

    public function getAllAssignedToMyOffice(AssignedToMyOffice $request)
    {
        return $this->ticketService->getAllAssignedToMyOffice($request->validated());
    }

    public function getAllSentByMyOffice(SentByMyOffice $request)
    {
        return $this->ticketService->getAllSentByMyOffice($request->validated());
    }

    public function changeStatus(ChangeStatus $request, string $id)
    {
        return $this->ticketService->changeStatus($id, $request->validated());
    }

}

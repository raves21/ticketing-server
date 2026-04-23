<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketStatusLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('auth/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    // Offices
    Route::apiResource('offices', OfficeController::class)->except(['update']);
    Route::post('offices/{office}', [OfficeController::class, 'update']);

    // Tickets
    Route::get('tickets/assigned-to-my-office', [TicketController::class, 'getAllAssignedToMyOffice']);
    Route::get('tickets/sent-by-my-office', [TicketController::class, 'getAllSentByMyOffice']);
    Route::apiResource('tickets', TicketController::class)->except(['update']);
    Route::post('tickets/{ticket}', [TicketController::class, 'update']);
    Route::post('tickets/{ticket}/change-status', [TicketController::class, 'changeStatus']);

    // Ticket Status Logs
    Route::apiResource('ticket-status-logs', TicketStatusLogController::class)->except(['update']);
    Route::post('ticket-status-logs/{ticket_status_log}', [TicketStatusLogController::class, 'update']);

    // Users
    Route::apiResource('users', UserController::class)->except(['update']);
    Route::post('users/{user}', [UserController::class, 'update']);
});


<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketStatusLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json([
    'message' => 'Server is running'
]));

// Auth
Route::post('auth/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    // Units
    Route::get('units/root-unit-tree', [UnitController::class, 'getRootUnitTree']);
    Route::get('units/root-unit-members', [UnitController::class, 'getRootUnitMembers']);
    Route::get('units/unit-members', [UnitController::class, 'getUnitMembers']);
    Route::get('units/my-units', [UnitController::class, 'getMyUnits']);
    Route::get('units/root-units', [UnitController::class, 'getRootUnits']);
    Route::apiResource('units', UnitController::class)->except(['update']);
    Route::post('units/{unit}', [UnitController::class, 'update']);

    // Tickets
    Route::get('tickets/received-by-unit', [TicketController::class, 'getTicketsReceivedByUnit']);
    Route::get('tickets/sent-by-unit', [TicketController::class, 'getTicketsSentByUnit']);
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

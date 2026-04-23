<?php

namespace App\Http\Repositories;

use App\Models\TicketStatusLog;
use App\Http\Repositories\BaseRepository;

class TicketStatusLogRepository extends BaseRepository
{
    public function __construct(
        private TicketStatusLog $ticketStatusLog
    ) {
        parent::__construct($ticketStatusLog);
    }
}

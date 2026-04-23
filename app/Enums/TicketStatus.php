<?php

namespace App\Enums;

enum TicketStatus: string
{
    case PENDING = "pending";
    case IN_PROGRESS = "in_progress";
    case ON_HOLD = "on_hold";
    case AWAITING_APPROVAL = "awaiting_approval";
    case REJECTED = "rejected";
    case CANCELLED = "cancelled";
    case COMPLETED = "completed";

    public function canTransitionTo(self $new): bool
    {
        return match ($this) {
            self::PENDING => in_array($new, [
                self::IN_PROGRESS,   // recipient accepts
                self::REJECTED,      // recipient rejects
            ]),
            self::IN_PROGRESS => in_array($new, [
                self::ON_HOLD,           // recipient needs clarification
                self::AWAITING_APPROVAL, // recipient requests completion
                self::CANCELLED,         // sender cancels
            ]),
            self::ON_HOLD => in_array($new, [
                self::IN_PROGRESS,   // sender responds to clarification
                self::CANCELLED,     // sender cancels while on hold
            ]),
            self::AWAITING_APPROVAL => in_array($new, [
                self::COMPLETED,     // sender approves
                self::IN_PROGRESS,   // sender disapproves
            ]),
            self::REJECTED => in_array($new, [
                self::PENDING,       // sender resubmits
            ]),
            self::CANCELLED,
            self::COMPLETED => false, // terminal states, no transitions allowed
        };
    }
}

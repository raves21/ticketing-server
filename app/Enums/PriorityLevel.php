<?php

namespace App\Enums;

enum PriorityLevel: string
{
    case ROUTINE = 'routine';
    case URGENT = 'urgent';
    case EMERGENCY = 'emergency';
}

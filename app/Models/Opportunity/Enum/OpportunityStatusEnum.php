<?php

namespace App\Models\Opportunity\Enum;

enum OpportunityStatusEnum: int
{
    case NORMAL = 0; // Normal
    case MISSED = 1; // Perdido
    case EXPIRED = 2; // Vencido
}


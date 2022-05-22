<?php

namespace App\Models\Opportunity\Enum;

enum OpportunityApprovalEnum: int
{
    case PENDING = 0; // Pendente
    case APPROVED = 1; // Aprovado
    case REFUSED = 2; // Recusado    
}

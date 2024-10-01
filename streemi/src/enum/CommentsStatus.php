<?php

declare(strict_types=1); 

namespace App\enum;

enum CommentsStatus: string
{
    case Pending = 'pending';      // En attente de validation
    case Approved = 'approved';    // Approuvé et visible
    case Rejected = 'rejected';    // Rejeté, non visible
}
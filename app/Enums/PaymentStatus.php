<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case VALIDATED = 'validated';
    case UNVALIDATED = 'unvalidated';
}

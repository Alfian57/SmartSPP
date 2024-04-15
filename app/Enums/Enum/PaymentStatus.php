<?php

namespace App\Enums\Enum;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case VALIDATED = 'validated';
    case UNVALIDATED = 'unvalidated';
}

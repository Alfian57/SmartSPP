<?php

namespace App\Enums\Enum;

enum BillStatus: string
{
    case PaidOff = 'paid-off';
    case NotPaidOff = 'not-paid-off';
}

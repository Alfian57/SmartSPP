<?php

namespace App\Enums;

enum BillStatus: string
{
    case PAID_OFF = 'paid-off';
    case NOT_PAID_OFF = 'not-paid-off';
}

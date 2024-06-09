<?php

namespace App\Enums;

enum BillStatus: string
{
    case PAID_OFF = 'dibayar';
    case NOT_PAID_OFF = 'belum-dibayar';
}

<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'menunggu-validasi';
    case VALIDATED = 'tervalidasi';
    case UNVALIDATED = 'belum-tervalidasi';
}

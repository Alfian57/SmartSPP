<?php

namespace App\Enums;

enum OrphanStatus: string
{
    case YATIM_PIATU = 'yatim-piatu';
    case YATIM = 'yatim';
    case PIATU = 'piatu';
    case NONE = 'none';
}

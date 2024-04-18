<?php

namespace App\Enums;

enum OrphanStatus: string
{
    case ORPHAN_BOTH = 'orphan_both';
    case ORPHAN_FATHER = 'orphan_father';
    case ORPHAN_MOTHER = 'orphan_mother';
    case NONE = 'none';
}

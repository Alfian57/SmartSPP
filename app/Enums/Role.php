<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case STUDENT = 'student';
    case STUDENT_PARENT = 'student_parent';
}

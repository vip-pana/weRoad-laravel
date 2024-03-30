<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 1;
    case EDITOR = 2;
    case USER = 3;
}

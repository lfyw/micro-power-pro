<?php

namespace App\Supports\Enums;

enum CacheKey:string
{
    case PC_LOGIN_FAILURE_COUNT = 'pc_login_failure_count_';
    case PC_LOGIN_LOCK = 'pc_login_lock_';
}

<?php
declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case SYSTEM_ADMIN = 'system_admin'; // 總部管理員
    case BRANCH_USER = 'branch_user';   // 店點管理員
}

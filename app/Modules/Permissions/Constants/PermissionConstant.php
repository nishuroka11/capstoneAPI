<?php

namespace App\Modules\Permissions\Constants;

class PermissionConstant
{
    const ACTION_FOR_CREATE = 'create';
    const ACTION_FOR_READ = 'read';
    const ACTION_FOR_UPDATE = 'update';
    const ACTION_FOR_DELETE = 'delete';

    const ACTION_ARRAYS = [
        self::ACTION_FOR_CREATE => self::ACTION_FOR_CREATE,
        self::ACTION_FOR_READ => self::ACTION_FOR_READ,
        self::ACTION_FOR_UPDATE => self::ACTION_FOR_UPDATE,
        self::ACTION_FOR_DELETE => self::ACTION_FOR_DELETE,
    ];
}

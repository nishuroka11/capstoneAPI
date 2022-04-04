<?php

namespace App\Library;

use App\Library\Configs\Generic;

class AppConfig
{
    public static function generic()
    {
        return new Generic();
    }

    public static function permission()
    {
        return new Permission();
    }
}

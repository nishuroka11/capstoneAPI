<?php

namespace App\Library\Configs;

class Generic
{
    public function shouldApiAccess()
    {
        return config('features.api.access');
    }

    public function shouldSocialLogin()
    {
        return config('features.api.should_social_login');
    }
}

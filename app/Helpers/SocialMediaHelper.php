<?php

namespace App\Helpers;

class SocialMediaHelper
{
    const FACEBOOK_ID = 1;
    const GOOGLE_ID = 2;
    const APPLE_ID = 3;

    const FACEBOOK_NAME = 'facebook';
    const GOOGLE_NAME = 'google';
    const APPLE_NAME = 'apple';

    const SOCIAL_MEDIA_LIST = [
        self::FACEBOOK_ID => self::FACEBOOK_NAME,
        self::GOOGLE_ID => self::GOOGLE_NAME,
        self::APPLE_ID => self::APPLE_NAME,
    ];

    public static function isLoginFromApple($socialMediaId)
    {
        return $socialMediaId == self::APPLE_ID;
    }
}

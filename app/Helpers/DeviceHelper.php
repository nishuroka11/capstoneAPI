<?php

namespace App\Helpers;

class DeviceHelper
{
    const ANDROID_ID = 1;
    const IOS_ID = 2;
    const WEB_ID = 3;

    const DEFAULT_DEVICE_ID=1;

    const DEVICES_LIST = [self::ANDROID_ID => 'Android', self::IOS_ID => 'iOS', self::WEB_ID => 'web'];
}

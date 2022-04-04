<?php

namespace App\Helpers\ReverseGeocoding;

use Illuminate\Support\Facades\Http;

class ReverseGeocodingHelper
{
    const ARRAY_KEY_FOR_DISPLAY_NAME = 'display_name';
    const ARRAY_KEY_FOR_FORMATTED_DISPLAY_NAME = 'formatted_display_name';
    const ARRAY_KEY_FOR_NEIGHBOURHOOD = 'neighbourhood';
    const ARRAY_KEY_FOR_SUBURB = 'suburb';
    const ARRAY_KEY_FOR_CITY = 'city';
    const ARRAY_KEY_FOR_COUNTRY = 'country';
    const ARRAY_KEY_FOR_REGION = 'region';
    const ARRAY_KEY_FOR_POSTCODE = 'postcode';

    public static function getLocationArray($longitude, $latitude, $by = 'open-street')
    {
        if ($by == OpenStreetGeocodingHelper::BY_NAME) {
            return OpenStreetGeocodingHelper::retrieveFromOpenStreet($longitude, $latitude);
        }
        return [];
    }
}

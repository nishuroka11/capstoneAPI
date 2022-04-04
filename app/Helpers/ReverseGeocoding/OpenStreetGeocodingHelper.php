<?php

namespace App\Helpers\ReverseGeocoding;

use Illuminate\Support\Facades\Http;

class OpenStreetGeocodingHelper
{
    public const BY_NAME = 'open-street';
    public const MAXIMUM_LOCATION_SELECT_NUMBER = 3;

    public static function retrieveFromOpenStreet($longitude, $latitude)
    {
        $url = config('services.open_street.nominatim_url') . "&lat={$latitude}&lon={$longitude}";
        $response = Http::get($url);
        if (!$response->ok()) {
            return [];
        }

        $resultData = $response->json();

        $displayName = extractFromArray($resultData, 'display_name');

        if (empty($displayName)) {
            return null;
        }

        $addressArray = $resultData['address'] ?? null;

        if (empty($addressArray)) {
            return null;
        }

        return [
            ReverseGeocodingHelper::ARRAY_KEY_FOR_DISPLAY_NAME => $displayName,
            ReverseGeocodingHelper::ARRAY_KEY_FOR_FORMATTED_DISPLAY_NAME => static::getFormattedDisplayName($displayName),
            ReverseGeocodingHelper::ARRAY_KEY_FOR_NEIGHBOURHOOD => extractFromArray($addressArray, 'neighbourhood'),
            ReverseGeocodingHelper::ARRAY_KEY_FOR_SUBURB => extractFromArray($addressArray, 'suburb'),
            ReverseGeocodingHelper::ARRAY_KEY_FOR_CITY => extractFromArray($addressArray, 'city'),
            ReverseGeocodingHelper::ARRAY_KEY_FOR_COUNTRY => extractFromArray($addressArray, 'country'),
            ReverseGeocodingHelper::ARRAY_KEY_FOR_REGION => extractFromArray($addressArray, 'region'),
            ReverseGeocodingHelper::ARRAY_KEY_FOR_POSTCODE => extractFromArray($addressArray, 'postcode'),
        ];
    }

    public static function getFormattedDisplayName($displayName)
    {
        if (empty($displayName)) {
            return '';
        }

        $displayNameArray = explode(',', $displayName);

        if (count($displayNameArray) < 1) {
            return $displayName;
        }

        //Choose only three names
        $selectedNameArray = [];
        foreach ($displayNameArray as $tempDisplayName) {

            if (count($selectedNameArray) >= static::MAXIMUM_LOCATION_SELECT_NUMBER) {
                break;
            }

            //Conditions for name
            //Number should not be there in string
            if (hasAnyNumber($tempDisplayName)) {
                continue;
            }

            array_push($selectedNameArray, trim($tempDisplayName));
        }
        return implode(', ', $selectedNameArray);
    }
}

<?php

namespace App\Helpers;

class ConstantHelper
{
    public static function recordsPerPage($limit = 10)
    {
        $calculatedLimit = config('constants.records_per_page_api');
        if (!empty($limit) && $limit < config('constants.max_records_per_page_api')) {
            $calculatedLimit = $limit;
        }

        return $calculatedLimit;
    }
}

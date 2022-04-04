<?php

namespace App\Modules\Addresses;

class AddressHelper
{
    public static function getValidationRules()
    {
        return [
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'address_city' => 'required',
            'address_state' => 'required',
            'address_country' => 'required',
        ];
    }
}

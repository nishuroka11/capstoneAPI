<?php

namespace App\Modules\Addresses\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->address_id,
            'uuid' => $this->uuid,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'address_city' => $this->address_city,
            'address_state' => $this->address_state,
            'address_country' => $this->address_country,
        ];
    }
}

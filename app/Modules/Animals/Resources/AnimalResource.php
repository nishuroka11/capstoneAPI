<?php

namespace App\Modules\Animals\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
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
            'id' => $this->animal_id,
            'uuid' => $this->uuid,
            'animal_name' => $this->animal_name,
            'animal_image_url' => $this->getFormattedProfilePhoto(),
            'animal_slug' => $this->animal_slug,
            'date_of_birth' => $this->date_of_birth,
            'breed_type' => $this->breed_type,
            'is_walking' => $this->is_walking,
        ];
    }
}

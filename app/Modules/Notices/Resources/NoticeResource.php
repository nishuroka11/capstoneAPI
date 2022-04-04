<?php

namespace App\Modules\Notices\Resources;

use App\Modules\Addresses\Resources\AddressResource;
use App\Modules\Animals\Resources\AnimalResource;
use App\Modules\Users\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
            'id' => $this->notice_id,
            'uuid' => $this->uuid,
            'owner' => new UserResource($this->owner),
            'animal' => new AnimalResource($this->animal),
            'walker' => new UserResource($this->walker),
            'from_address' => new AddressResource($this->address),
            'notice_title' => $this->notice_title,
            'notice_description' => $this->notice_description,
            'requested_date_time' => $this->requested_date_time,
            'rating' => $this->rating,
            'created_at' => $this->created_at
        ];
    }
}

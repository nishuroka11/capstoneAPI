<?php

namespace App\Modules\Users\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @var string
     */
    private $type;

    /**
     * UserResource constructor.
     * @param $resource
     * @param string $type
     */
    public function __construct($resource, $type = 'normal')
    {
        parent::__construct($resource);
        $this->type = $type;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $nameArray = explode(' ', $this->name);
        $lastName = array_pop($nameArray);

        $data =  [
            'id' => $this->user_id,
            'uuid' => $this->uuid,
            'user_type_id' => $this->user_type_id,
            'first_name' => implode(' ', $nameArray),
            'last_name' => $lastName,
            'name' => $this->name,
            'email' => $this->email,
            'formatted_image_url' => $this->getFormattedProfilePhoto(),
            'years_of_experience' => $this->years_of_experience,
            'average_rating' => $this->average_rating,
            'is_available' => $this->is_available,
        ];

        return $data;
    }
}

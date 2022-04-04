<?php

namespace App\Traits\Models\Uuid;

use Webpatser\Uuid\Uuid;

trait UuidModelBidingableTrait
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}

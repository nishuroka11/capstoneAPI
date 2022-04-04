<?php

namespace App\Traits\Models\Uuid;

use Webpatser\Uuid\Uuid;

trait UuidCreateableTrait
{
    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}

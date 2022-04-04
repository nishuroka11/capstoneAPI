<?php

namespace App\Models;

use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends \Spatie\Permission\Models\Permission implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use UuidCreateableTrait, UuidModelBidingableTrait;

    protected $guarded = [];

    public $guard_name = '*';

    protected function getDefaultGuardName(): string
    {
        return '*';
    }
}

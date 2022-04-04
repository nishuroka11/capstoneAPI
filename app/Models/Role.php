<?php

namespace App\Models;

use App\Modules\Roles\Constants\RoleConstant;
use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends \Spatie\Permission\Models\Role implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use UuidModelBidingableTrait, UuidCreateableTrait;

    protected $fillable = ['uuid', 'name', 'guard_name', 'can_access_web'];

    public $guard_name = '*';

    protected function getDefaultGuardName(): string
    {
        return '*';
    }

    public function canAccessWeb()
    {
        return $this->can_access_web;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->name == RoleConstant::ROLE_NAME_FOR_ADMIN;
    }
}

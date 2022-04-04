<?php

namespace App\Modules\Roles\Repositories;

use App\Repositories\Repository;

interface RoleRepository extends Repository
{
    public function getNormalUserRole();
}

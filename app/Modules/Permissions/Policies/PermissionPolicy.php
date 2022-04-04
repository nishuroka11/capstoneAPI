<?php

namespace App\Modules\Permissions\Policies;

use App\Library\AppConfig;
use App\Models\User;
use App\Modules\Frameworks\PolicyInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy implements PolicyInterface
{
    use HandlesAuthorization;

    /**
     * Checks the permission permission to READ permission
     * @param User $user
     * @return bool
     */
    public function read(User $user)
    {
        return AppConfig::permission()->canReadPermission();
    }


    /**
     * Checks the permission permission to CREATE permission
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return AppConfig::permission()->canCreatePermission();
    }

    /**
     * Checks the permission permission to UPDATE permission
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return AppConfig::permission()->canUpdatePermission();

    }

    /**
     * Checks the permission permission to DELETE permission
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return AppConfig::permission()->canDeletePermission();
    }
}

<?php

namespace App\Modules\Roles\Policies;

use App\Library\AppConfig;
use App\Models\User;
use App\Modules\Frameworks\PolicyInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy implements PolicyInterface
{
    use HandlesAuthorization;

    /**
     * Checks the role permission to READ role
     * @param User $user
     * @return bool
     */
    public function read(User $user)
    {
        return AppConfig::permission()->canReadRole();
    }


    /**
     * Checks the role permission to CREATE role
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return AppConfig::permission()->canCreateRole();
    }

    /**
     * Checks the role permission to UPDATE role
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return AppConfig::permission()->canUpdateRole();
    }

    /**
     * Checks the role permission to DELETE role
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return AppConfig::permission()->canDeleteRole();
    }
}

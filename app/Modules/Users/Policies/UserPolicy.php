<?php

namespace App\Modules\Users\Policies;

use App\Library\AppConfig;
use App\Models\User;
use App\Modules\Frameworks\PolicyInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy implements PolicyInterface
{
    use HandlesAuthorization;

    /**
     * Checks the user permission to READ user
     * @param User $user
     * @return bool
     */
    public function read(User $user)
    {
        return AppConfig::permission()->canReadUser();
    }


    /**
     * Checks the user permission to CREATE user
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return AppConfig::permission()->canCreateUser();
    }

    /**
     * Checks the user permission to UPDATE user
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return AppConfig::permission()->canUpdateUser();
    }

    /**
     * Checks the user permission to DELETE user
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return AppConfig::permission()->canDeleteUser();
    }
}

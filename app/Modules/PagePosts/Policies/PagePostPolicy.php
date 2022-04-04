<?php

namespace App\Modules\PagePosts\Policies;

use App\Library\AppConfig;
use App\Models\User;
use App\Modules\Frameworks\PolicyInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePostPolicy implements PolicyInterface
{
    use HandlesAuthorization;

    /**
     * Checks the page post permission to READ page post
     * @param User $user
     * @return bool
     */
    public function read(User $user)
    {
        return AppConfig::permission()->canReadPagePost();
    }


    /**
     * Checks the page post permission to CREATE page post
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return AppConfig::permission()->canCreatePagePost();
    }

    /**
     * Checks the page post permission to UPDATE page post
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return AppConfig::permission()->canUpdatePagePost();
    }

    /**
     * Checks the page post permission to DELETE page post
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return AppConfig::permission()->canDeletePagePost();
    }
}

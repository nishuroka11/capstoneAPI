<?php

/**
 * @created: Lizesh Shakya
 * @datetime: 2021-08-01
 * @author : lizeshakya
 */

namespace App\Modules\Frameworks;

use App\Models\User;

interface PolicyInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    public function create(User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function read(User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function update(User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function delete(User $user);

}

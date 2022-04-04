<?php

namespace App\Modules\Users\Repositories;

use App\Repositories\Repository;

interface SocialLoginRepository extends Repository
{
    /**
     * @param $socialId
     * @param $socialMediaId
     * @return mixed
     */
    public function findByUniqueSocialId($socialId, $socialMediaId);
}

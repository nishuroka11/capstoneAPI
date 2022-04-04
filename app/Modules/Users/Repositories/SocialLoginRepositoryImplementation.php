<?php

namespace App\Modules\Users\Repositories;

use App\Models\SocialLogin;
use App\Repositories\RepositoryImplementation;

class SocialLoginRepositoryImplementation extends RepositoryImplementation implements SocialLoginRepository
{
    /**
     * @return SocialLogin|mixed
     */
    public function getModel()
    {
        return new SocialLogin();
    }

    /**
     * @param $socialId
     * @param $socialMediaId
     * @return mixed
     */
    public function findByUniqueSocialId($socialId, $socialMediaId)
    {
        return $this->getModel()->where('social_id', $socialId)
            ->where('social_media_id', $socialMediaId)
            ->first();
    }
}

<?php

namespace App\Modules\Notices\Repositories;

use App\Models\Notice;
use App\Repositories\RepositoryImplementation;

class NoticeRepositoryImplementation extends RepositoryImplementation implements NoticeRepository
{
    /**
     * @return Notice|mixed
     */
    public function getModel()
    {
        return new Notice();
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function filterQuery($query, $data)
    {
        $ownerId = extractFromArray($data, 'fk_owner_id');

        if(!empty($ownerId)){
            $query = $query->filterByOwner($ownerId);
        }

        return $query;
    }
}

<?php

namespace App\Modules\Animals\Repositories;

use App\Models\Animal;
use App\Repositories\RepositoryImplementation;

class AnimalRepositoryImplementation extends RepositoryImplementation implements AnimalRepository
{
    /**
     * @return Animal|mixed
     */
    public function getModel()
    {
        return new Animal();
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

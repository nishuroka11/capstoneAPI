<?php

namespace App\Modules\Addresses\Repositories;

use App\Models\Address;
use App\Repositories\RepositoryImplementation;

class AddressRepositoryImplementation extends RepositoryImplementation implements AddressRepository
{
    /**
     * @return Address|mixed
     */
    public function getModel()
    {
        return new Address();
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

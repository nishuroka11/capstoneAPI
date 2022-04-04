<?php

namespace App\Modules\Roles\Repositories;

use App\Models\Role;
use App\Modules\Roles\Constants\RoleConstant;
use App\Repositories\RepositoryImplementation;

class RoleRepositoryImplementation extends RepositoryImplementation implements RoleRepository
{
    /**
     * @return Role|mixed
     */
    public function getModel()
    {
        return new Role();
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $role = $this->getModel()->create($data);

        if (isset($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        } else {
            $role->permissions()->sync([]);
        }

        return $role;
    }

    public function update(array $data, $id)
    {
        $role = $this->find($id);

        $role->update($data);

        if (isset($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        } else {
            $role->permissions()->sync([]);
        }

        return $role;
    }

    public function getNormalUserRole()
    {
        return $this->getModel()->where('name', RoleConstant::ROLE_NAME_FOR_NORMAL_USER)->first();
    }

    public function filterQuery($query, $data)
    {
        $nameLike = extractFromArray($data, 'name_like');

        if(!empty($nameLike)){
            $query = $this->filterLikeBy($query, 'name', $nameLike);
        }

        return $query;
    }
}

<?php

namespace App\Modules\Permissions\Repositories;

use App\Models\Permission;
use App\Modules\Permissions\Constants\PermissionConstant;
use App\Repositories\RepositoryImplementation;

class PermissionRepositoryImplementation extends RepositoryImplementation implements PermissionRepository
{
    public function getModel()
    {
        return new Permission();
    }

    public function bulkStore($name)
    {
        foreach (PermissionConstant::ACTION_ARRAYS as $action) {
            $actionWithModel = $name . '-' . $action;
            if (empty($this->findBy('name', $actionWithModel))) {
                $this->create([
                    'name' => $actionWithModel
                ]);
            }
        }
        return true;
    }

    public function getByAuthenticatedUser()
    {
        if (auth()->check()) {
            return $this->findBy('id', 0);
        }

        return auth()->user()->permissions;
    }

    public function getCrudLists()
    {
        $permission_lists = [];
        $permissions = $this->getModel()->orderBy('id')->pluck('name', 'id');
        foreach ($permissions as $key => $value) {
            if ($pos = strpos($value, '-')) {
                $key_one = substr($value, 0, $pos);
                $permission_lists[$key_one][$key] = $value;
            } else {
                $permission_lists[$key] = $value;
            }
        }
        return $permission_lists;
    }
}

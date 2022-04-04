<?php

namespace App\Library;

class Permission
{
    public function canCreateUser()
    {
        return checkForPermission('users-create');
    }

    public function canReadUser()
    {
        return checkForPermission('users-read');
    }

    public function canUpdateUser()
    {
        return checkForPermission('users-update');
    }

    public function canDeleteUser()
    {
        return checkForPermission('users-delete');
    }

    public function canCreateRole()
    {
        return checkForPermission('roles-create') && isAuthenticatedSuperAdmin();
    }

    public function canReadRole()
    {
        return checkForPermission('roles-read') && isAuthenticatedSuperAdmin();
    }

    public function canUpdateRole()
    {
        return checkForPermission('roles-update') && isAuthenticatedSuperAdmin();
    }

    public function canDeleteRole()
    {
        return checkForPermission('roles-delete') && isAuthenticatedSuperAdmin();
    }

    public function canCreatePermission()
    {
        return checkForPermission('permissions-create') && isAuthenticatedSuperAdmin();
    }

    public function canReadPermission()
    {
        return checkForPermission('permissions-read') && isAuthenticatedSuperAdmin();
    }

    public function canUpdatePermission()
    {
        return checkForPermission('permissions-update') && isAuthenticatedSuperAdmin();
    }

    public function canDeletePermission()
    {
        return checkForPermission('permissions-delete') && isAuthenticatedSuperAdmin();
    }

    public function canCreatePagePost()
    {
        return checkForPermission('page-posts-create');
    }

    public function canReadPagePost()
    {
        return checkForPermission('page-posts-read');
    }

    public function canUpdatePagePost()
    {
        return checkForPermission('page-posts-update');
    }

    public function canDeletePagePost()
    {
        return checkForPermission('page-posts-delete');
    }
}

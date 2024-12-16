<?php

use App\Helpers\PermissionHelper;

if (!function_exists('hasRoleAndPermission')) {
    /**
     * Mengecek apakah user memiliki role dan permission yang sesuai.
     *
     * @param string $permission
     * @return bool
     */
    function hasRoleAndPermission($permission)
    {
        return PermissionHelper::hasRoleAndPermission($permission);
    }

    function hasRole($role)
    {
        return PermissionHelper::hasRole($role);
    }

    function hasCategory($category)
    {
        return PermissionHelper::hasCategory($category);
    }
}

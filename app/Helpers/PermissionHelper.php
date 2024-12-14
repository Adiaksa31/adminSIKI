<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class PermissionHelper
{
    protected static $roleMapping = [
        'admin' => 'super_admin',
        'manager' => 'manager',
        'spv' => 'supervisor',
        'staff' => 'staff',
    ];

    protected static $sessionMapping = [
        'admin_user' => 'admin_user',
        'create_user' => 'create_user',
        'list_staff' => 'admin_list_staff',
        'list_spv' => 'admin_list_spv',
        'tes' => 'auth_tes',
    ];

    /**
     * Mengecek apakah user memiliki permission berdasarkan session.
     *
     * @param string $childPermission
     * @return bool
     */
    public static function hasPermission($childPermission)
    {
        $mappedChild = self::$sessionMapping[$childPermission] ?? $childPermission;

        $parentPermission = self::getParentPermission($childPermission);

        if (!$parentPermission) {
            return false;
        }

        $mappedParent = self::$sessionMapping[$parentPermission] ?? $parentPermission;

        return (Session::has('permission.' . $mappedParent) && in_array($mappedChild, Session::get('permission.' . $mappedParent)));
    }


    /**
     * Mendapatkan parent permission berdasarkan childPermission
     *
     * @param string $childPermission
     * @return string|null
     */
    protected static function getParentPermission($childPermission)
    {
        $permissionHierarchy = [
            'admin_user' => ['create_user', 'list_staff', 'list_spv'],
            'auth' => ['tes'],
        ];

        foreach ($permissionHierarchy as $parent => $children) {
            if (in_array($childPermission, $children)) {
                return $parent;
            }
        }
        return null;
    }



    public static function hasRole($role)
    {
        $mappedRole = self::$roleMapping[$role] ?? $role;

        return Session::has('role') && Session::get('role') == $mappedRole;
    }

    public static function hasCategory($Category)
    {
        $mappedCategory = self::$sessionMapping[$Category] ?? $Category;

        return Session::has('permission.' . $mappedCategory);
    }

    public static function hasRoleAndPermission($permission)
    {
        return self::hasRole('super_admin') || self::hasPermission($permission);
    }
}

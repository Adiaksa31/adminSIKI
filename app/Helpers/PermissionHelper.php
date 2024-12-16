<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class PermissionHelper
{
    protected static $roleMapping = [
        'admin' => 'super_admin',
        'manager' => 'manager',
        'spv' => 'supervisor',
        'staff' => 'staff',
    ];

    protected static $sessionMapping;
    protected static $permissionHierarchy;
    protected static $featureMapping;

    public static function init()
    {
        $permissions = json_decode(File::get(storage_path('app/dataPermissions/permissions.json')), true);

        // Initialize sessionMapping, permissionHierarchy, and featureMapping based on new structure
        self::$sessionMapping = [];
        self::$permissionHierarchy = [];
        self::$featureMapping = [];

        foreach ($permissions as $key => $value) {
            self::$sessionMapping[$key] = $value['endpoints'];
            self::$permissionHierarchy[$key] = array_keys($value['endpoints']); // Get the keys of endpoints
            self::$featureMapping[$key] = $value['feature_name'] ?? null;
        }
    }

    /**
     * Mengecek apakah user memiliki permission berdasarkan session.
     *
     * @param string $childPermission
     * @return bool
     */
    public static function hasPermission($childPermission)
    {
        if (is_null(self::$sessionMapping) || is_null(self::$permissionHierarchy)) {
            self::init();
        }

        // Find the parent permission for the given child permission
        $parentPermission = self::getParentPermission($childPermission);

        if (!$parentPermission) {
            return false;
        }

        // Check if the session has the parent permission and if the child permission is in the mapped endpoints
        return (
            Session::has('permission.' . self::$featureMapping[$parentPermission]) &&
            in_array($childPermission, array_keys(self::$sessionMapping[$parentPermission]))
        );
    }

    /**
     * Mendapatkan parent permission berdasarkan childPermission
     *
     * @param string $childPermission
     * @return string|null
     */
    protected static function getParentPermission($childPermission)
    {
        if (is_null(self::$permissionHierarchy)) {
            self::init();
        }

        foreach (self::$permissionHierarchy as $parent => $children) {
            if (in_array($childPermission, $children)) {
                return $parent;
            }
        }
        return null;
    }

    /**
     * Mengecek apakah user memiliki role tertentu
     *
     * @param string $role
     * @return bool
     */
    public static function hasRole($role)
    {
        $mappedRole = self::$roleMapping[$role] ?? $role;

        return Session::has('role') && Session::get('role') == $mappedRole;
    }

    /**
     * Mengecek apakah user memiliki kategori tertentu berdasarkan feature_name
     *
     * @param string $category
     * @return bool
     */
    public static function hasCategory($category)
    {
        if (is_null(self::$sessionMapping)) {
            self::init();
        }

        return isset(self::$featureMapping[$category]) && Session::has('permission.' . self::$featureMapping[$category]);
    }

    /**
     * Mengecek apakah user memiliki role dan permission tertentu
     *
     * @param string $permission
     * @return bool
     */
    public static function hasRoleAndPermission($permission)
    {
        return self::hasRole('super_admin') || self::hasPermission($permission);
    }
}

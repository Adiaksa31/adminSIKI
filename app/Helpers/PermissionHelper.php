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

    /**
     * Inisialisasi data permissions dari file JSON.
     */
    public static function init()
    {
        $permissions = json_decode(File::get(storage_path('app/dataPermissions/permissions.json')), true);

        self::$sessionMapping = [];
        self::$permissionHierarchy = [];
        self::$featureMapping = [];

        foreach ($permissions as $key => $value) {
            self::$sessionMapping[$key] = $value['endpoints'];
            self::$permissionHierarchy[$key] = array_keys($value['endpoints']);
            self::$featureMapping[$key] = $value['feature_name'] ?? null;
        }
    }

    /**
     * Memeriksa apakah user memiliki izin tertentu.
     * @param string $childPermission Nama izin
     * @return bool
     */
    public static function hasPermission($childPermission)
    {
        if (is_null(self::$sessionMapping) || is_null(self::$permissionHierarchy)) {
            self::init();
        }

        $parentPermission = self::getParentPermission($childPermission);

        if (!$parentPermission) {
            return false;
        }

        $sessionKey = 'permission.' . self::$featureMapping[$parentPermission];
        $sessionPermissions = Session::get($sessionKey, []);

        return in_array(self::$sessionMapping[$parentPermission][$childPermission] ?? '', $sessionPermissions);
    }

    /**
     * Mendapatkan izin induk berdasarkan izin anak.
     * @param string $childPermission Nama izin anak
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

    public static function hasCategory($category)
    {
        if (is_null(self::$sessionMapping)) {
            self::init();
        }

        return isset(self::$featureMapping[$category]) && Session::has('permission.' . self::$featureMapping[$category]);
    }

    /**
     * Memeriksa apakah user memiliki peran tertentu.
     * @param string $role Nama role
     * @return bool
     */
    public static function hasRole($role)
    {
        $mappedRole = self::$roleMapping[$role] ?? $role;

        return Session::has('role') && Session::get('role') == $mappedRole;
    }

    /**
     * Memeriksa apakah user memiliki role atau izin tertentu.
     * @param string $permission Nama izin
     * @return bool
     */
    public static function hasRoleAndPermission($permission)
    {
        return self::hasRole('super_admin') || self::hasPermission($permission);
    }
}

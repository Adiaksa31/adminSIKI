<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class PermissionHelper
{
    public static function hasPermission($module, $permission)
    {
        return Session::has('role') && Session::get('role') == 'super_admin' || (Session::has('permission.' . $module) && in_array($permission, Session::get('permission.' . $module)));
    }
}

<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class UpdateSession {
    public static function handle() {
        $paramIds = Session::get('ids');
        $data = ApiHelper::request("GET", "/admin/{$paramIds}/get_permission")['data'];
        session()->put('permission', $data);
    }
}

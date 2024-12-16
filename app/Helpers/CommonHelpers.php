<?php

use Illuminate\Support\Facades\Session;
use App\Helpers\ApiHelper;


if (!function_exists('isLogin')) {
    function isLogin(): bool
    {
        $accessToken = Session::get('access');
        $sessionSeed = Session::get('seed');

        return !empty($accessToken) && !empty($sessionSeed);
    }
}


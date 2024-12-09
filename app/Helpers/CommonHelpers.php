<?php

use Illuminate\Support\Facades\Session;


if (!function_exists('isLogin')) {
    function isLogin(): bool
    {
        $accessToken = Session::get('access');
        $sessionSeed = Session::get('seed');
        // dd($accessToken, $sessionSeed);
        return !empty($accessToken) && !empty($sessionSeed);
    }
}


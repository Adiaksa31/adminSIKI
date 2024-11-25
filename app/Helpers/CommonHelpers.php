<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;


if (!function_exists('isLogin')) {
    function isLogin($request)
    {
        $accessUntil = Session::get('access_until');
        $accessToken = Session::get('access');
        $refreshToken = Session::get('access_refresh');
        $sessionSeed = Session::get('seed');

        // dd($accessUntil, $accessToken, $refreshToken, $sessionSeed);

        if (!$accessUntil || !$accessToken || !$refreshToken || !$sessionSeed) {
            return false;
        }

        $currentTime = Carbon::now();
        $accessUntilTime = Carbon::parse($accessUntil);

        if ($currentTime->lessThanOrEqualTo($accessUntilTime)) {
            return true;
        }

        $client = new Client(['verify' => false]);
        $ip = $request->getClientIp();

        try {
            $response = $client->request('GET', env('API_BASE_URL') . '/' . env('API_VERSION') . '/refresh', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $refreshToken,
                    'Session-Ip' => $ip,
                    'Session-Seed' => $sessionSeed,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $responseData = json_decode($response->getBody(), true);


                Session::put('access', $responseData['access']);
                Session::put('access_until', $responseData['until']);

                return true;
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // dd($e);
            if ($e->getResponse()->getStatusCode() === 401) {
                // Jika refresh gagal dengan 401 Unauthorized, logout atau redirect ke login
                return false;
            }
        }
        return false;
    }
}

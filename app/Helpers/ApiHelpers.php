<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ApiHelper {
    protected static function getBaseUrl() :string {
        $base = env('API_BASE_URL');
        // $port = env('API_PORT');
        $version = env('API_VERSION');
        return "{$base}/{$version}";
    }
    public static function rawRequest($method, $path, $body=null, $additionalHeaders=[]) {
        // set client
        $client = new Client(["verify" => false]);
        $base = self::getBaseUrl();
        $fullpath = "{$base}{$path}";
        // set header and body
        $headers = [
            'Session-Ip' => request()->ip(),
        ];
        if(Session::has("access") && Session::has("seed")) {
            $headers['Authorization'] = 'Bearer ' . Session::get('access');
            $headers["Session-Seed"] = Session::get('seed');
            // $headers["paramId"] = Session::get('paramId');
        }

        if($additionalHeaders) {
            $headers = array_merge($headers, $additionalHeaders);
        }
        $data = [
            "headers" => $headers,
        ];
        if ($body) {
            $data = array_merge($body, $data);
        }
        // call
        $response = $client->request($method, $fullpath, $data);
        return $response;
    }
    public static function request($method, $path, $body=null, $additionalHeaders=[]) :array {
        $response = self::rawRequest($method, $path, $body, $additionalHeaders);
        // parse json
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);
        return $data;
    }

    public static function setSession(array $data, bool $remember=false) {
        // menyimpan token dengan session
        $lifetime = $remember ? 60 * 24 * 3  : config('session.lifetime');
        session()->put('jwt_token', $data['data']['token'], $lifetime);
        session()->put('paramId', $data['data']['paramId'], $lifetime);
        session()->put('seed', $data['data']['seed'], $lifetime);
        session()->put('username', $data['data']['username'], $lifetime);
        session()->put('email', $data['data']['email'], $lifetime);
        session()->put('is_staff', $data['data']['is_staff'], $lifetime);

        $data2 = self::request("GET", "/user/get-last-profile-picture");
        session()->put(
            'profile_picture',
            isset($data2['data']['profile_pic']) && !empty($data2['data']['profile_pic'])
                ? env('API_BASE_URL') . ':' . env('API_PORT') . '/' . env('API_VERSION') . '/' . $data2['data']['profile_pic']
                : '/../assets/images/users/avatar-1.jpg', $lifetime
        );
    }
}

?>

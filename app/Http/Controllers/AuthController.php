<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Session;
use App\Helpers\RequestHelper;
use App\Helpers\ApiHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyRequest;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!$request->ajax()){
            return redirect()->back();
        }
        // $ipAddress = $request->getClientIp();
        $keys = [
            "username",
            "password",
        ];
        $requestData = RequestHelper::sanitize($request, $keys);
        // $requestData["ip_address"] = $ipAddress;
        // dd($requestData);
        try {
            $data = ApiHelper::request("POST", "/auth/login", [
                "form_params" => $requestData,
            ]);
            // ApiHelper::setSession($data,$request->has('rememberme'));
            session()->put('verify_key', $data['data']['seed']);
            session()->put('paramId', $data['data']['param']);
            $verify_key = $data['data']['seed'];
            return response()->json([
                'error' => false,
                'message'   => [
                    'returned'	=> '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Masuk SIKI. Silakan cek email Anda.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
                'redirect_url' => route('verify-login', ['verify_key' => $verify_key]),
            ]);
        }catch(ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msg = "Gagal Masuk SIKI, Data tidak Valid.";
            if ( $statusCode == 400 || $statusCode == 401 ) {
                $msg = "Email atau Password salah.";
            }else if($statusCode == 403) {
                $msg = "Percobaan login melebihi batas ! Silahkan coba beberapa saat lagi.";
            }
            return response()->json([
                'error'     => true,
                'message'   => [
                    'returned'	=> '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function verify(VerifyRequest $request)
    {
        if(!$request->ajax()){
            return redirect()->back();
        }
        $seed = Session::get('verify_key');
        $paramId = Session::get('paramId');
        $keys = [
            "otp",
        ];
        $requestData = RequestHelper::sanitize($request, $keys);
        $requestData["id"] = $paramId;
        $requestData["seed"] = $seed;

        // dd($requestData);
        try {
           $data = ApiHelper::request("POST", "/auth/verify_otp", [
                "form_params" => $requestData,
            ]);
            session()->put('seed', $data['data']['seed']);
            session()->put('username', $data['data']['user']['username']);
            session()->put('role', $data['data']['user']['role']);
            session()->put('access', $data['data']['tokens']['access']);
            session()->put('access_until', $data['data']['tokens']['access_until']);
            session()->put('access_refresh', $data['data']['tokens']['refresh']);
            // dd(Session::get('access'));
            session()->forget('verify_key');
            // dd(session()->all());
            return response()->json([
                'error' => false,
                'message'   => [
                    'returned'	=> '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Masuk SIKI.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }catch(ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msg = "Gagal Masuk SIKI, Data tidak Valid.";
            if ( $statusCode == 400 ) {
                $msg = "Kode OTP Salah.";
            }else if($statusCode == 401) {
                $msg = "Kode OTP masa berlaku sudah habis.";
            }
            return response()->json([
                'error'     => true,
                'message'   => [
                    'returned'	=> '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function resendOtp(Request $request)
    {
        if(!$request->ajax()){
            return redirect()->back();
        }
        $paramId = Session::get('paramId');
        $seed = Session::get('verify_key');
        $requestData["seed"] = $seed;
        $requestData["id"] = $paramId;
        // dd($requestData);
        try {
            ApiHelper::request("POST", "/auth/resend_otp", [
                "form_params" => $requestData,
            ]);
            return response()->json([
                'error' => false,
                'message'   => [
                    'returned'	=> '<div class="alert alert-success alert-dismissible fade show" role="alert">Silakan cek lagi email Anda.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }catch(ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msg = "Gagal Mengirim Kode OTP, Data tidak Valid.";
            if ( $statusCode == 400 ) {
                $msg = "Data tidak Valid.";
            }else if($statusCode == 401) {
                $msg = "Kode OTP masa berlaku sudah habis.";
            }
            return response()->json([
                'error'     => true,
                'message'   => [
                    'returned'	=> '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function logout()
    {
        // Hapus semua data sesi
        session()->flush();
        // Mengarahkan pengguna kembali ke halaman login
        return response()->json([
            'error' => false,
            'message' => [
                'returned' => 'Anda telah berhasil keluar.'
            ],
        ]);
    }
}

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
        if (!$request->ajax()) {
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
            session()->put('paramId', $data['data']['param']);
            $verify_key = $data['data']['seed'];

            return response()->json([
                'error' => false,
                'message' => [
                    'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Masuk SIKI. Silakan cek email Anda.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
                'redirect_url' => route('verify-login', ['verify_key' => $verify_key]),
            ]);
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msgs = [
                400 => "Email atau Password salah.",
                401 => "Email atau Password salah.",
                403 => "Percobaan login melebihi batas ! Silahkan coba beberapa saat lagi.",
            ];

            $msg = $msgs[$statusCode] ?? "Gagal Mengirim Data.";
            return response()->json([
                'error' => true,
                'message' => [
                    'returned' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function verify(VerifyRequest $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $paramId = Session::get('paramId');
        $keys = [
            "otp",
        ];
        $requestData = RequestHelper::sanitize($request, $keys);
        $requestData["id"] = $paramId;
        $requestData["seed"] = $request->input('seed');

        // dd($requestData);
        try {
            $data = ApiHelper::request("POST", "/auth/verify_otp", [
                "form_params" => $requestData,
            ]);
            // dd($data);
            session()->put('seed', $data['data']['seed']);
            session()->put('ids', $data['data']['user']['id']);
            session()->put('username', $data['data']['user']['username']);
            session()->put('group', $data['data']['user']['group']);
            session()->put('role', $data['data']['user']['role']);
            session()->put('access', $data['data']['access']);
            session()->put('permission', $data['data']['user']['permissions']);
            return response()->json([
                'error' => false,
                'message' => [
                    'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Masuk SIKI.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msgs = [
                400 => "Kode OTP Salah.",
                401 => "Kode OTP masa berlaku sudah habis, silahkan login ulang.",
            ];
            $msg = $msgs[$statusCode] ?? "Gagal Mengirim Kode OTP, Data tidak Valid.";
            return response()->json([
                'error' => true,
                'status' => $statusCode,
                'message' => [
                    'returned' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function showVerifikasi(Request $request, $verify_key) {
        return view('verify-login', compact('verify_key'));
    }

    public function resendOtp(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $paramId = Session::get('paramId');
        $requestData["id"] = $paramId;
        $requestData["seed"] = $request->input('seed');
        try {
            ApiHelper::request("POST", "/auth/resend_otp", [
                "form_params" => $requestData,
            ]);
            return response()->json([
                'error' => false,
                'message' => [
                    'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Silakan cek lagi email Anda.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msgs = [
                400 => "Data tidak Valid.",
                401 => "Kode OTP masa berlaku sudah habis, silahkan login ulang.",
            ];
            $msg = $msgs[$statusCode] ?? "Gagal Mengirim Kode OTP, Data tidak Valid.";
            return response()->json([
                'error' => true,
                'status' => $statusCode,
                'message' => [
                    'returned' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function logout()
    {
        session()->flush();
        return response()->json([
            'error' => false,
            'message' => [
                'returned' => 'Anda telah berhasil keluar.'
            ],
        ]);
    }
}

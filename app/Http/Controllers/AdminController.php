<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use App\Helpers\RequestHelper;
use App\Helpers\ApiHelper;
use App\Http\Requests\AddAdminRequest;

class AdminController extends Controller
{
    public function admin() {

        $data = ApiHelper::request("GET", "/admin/get_staff");
        $dataStaff = $data['data'];
        // dd($dataStaff);
        return view('dashboard.admin.admin', compact('dataStaff'));
    }

    public function addAdmin(AddAdminRequest $request)
    {
        if(!$request->ajax()){
            return redirect()->back();
        }
        $keys = [
            "fullname",
            "email",
            "username",
            "address",
            "phone",
            "division_id",
        ];
        $requestData = RequestHelper::sanitize($request, $keys);
        try {
            ApiHelper::request("POST", "/admin/create_staff", [
                "form_params" => $requestData,
            ]);
            return response()->json([
                'error' => false,
                'message'   => [
                    'returned'	=> '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Masuk SIKI. Silakan cek email Anda.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }catch(ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msg = "Gagal Masuk SIKI, Data tidak Valid.";
            if ( $statusCode == 409 ) {
                $msg = "Email atau Username sudah terdaftar.";
            }else if($statusCode == 403) {
                $msg = "Kamu tidak memiliki akses untuk melakukan aksi ini.";
            }else if($statusCode == 422) {
                $msg = "Divisi tidak ditemukan.";
            }
            return response()->json([
                'error'     => true,
                'message'   => [
                    'returned'	=> '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use App\Helpers\RequestHelper;
use App\Helpers\ApiHelper;
use App\Http\Requests\AddAdminRequest;

class AdminController extends Controller
{
    public function admin()
    {
        $dataStaff = ApiHelper::request("GET", "/admin_staff")['data'];
        $dataSpv = ApiHelper::request("GET", "/admin_supervisor")['data'];
        $dataManager = ApiHelper::request("GET", "/admin_manager")['data'];

        // dd($dataManager);
        return view('dashboard.admin.admin', compact('dataStaff', 'dataSpv', 'dataManager'));
    }

    private function addUser($url, $request)
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
            "group_id",
        ];
        $requestData = RequestHelper::sanitize($request, $keys);
        try {
            ApiHelper::request("POST", $url, [
                "form_params" => $requestData,
            ]);
            return response()->json([
                'error' => false,
                'message'   => [
                    'returned'	=> '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menambahkan data.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        } catch(ClientException $e) {
            // dd($e);
            $statusCode = $e->getResponse()->getStatusCode();
            $msgs = [
                409 => "Email atau Username sudah terdaftar.",
                403 => "Kamu tidak memiliki akses untuk melakukan aksi ini.",
                422 => "Divisi atau Group tidak ditemukan.",
            ];

            $msg = $msgs[$statusCode] ?? "Gagal Mengirim Data.";

            return response()->json([
                'error'     => true,
                'message'   => [
                    'returned'	=> '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function addStaff(AddAdminRequest $request)
    {
        return $this->addUser('/admin_staff/create', $request);
    }
    public function addSpv(AddAdminRequest $request)
    {
        return $this->addUser('/admin_supervisor/create', $request);
    }
    public function addManager(AddAdminRequest $request)
    {
        return $this->addUser('/admin_manager/create', $request);
    }
}

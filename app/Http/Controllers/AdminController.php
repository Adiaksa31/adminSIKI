<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use App\Helpers\RequestHelper;
use App\Helpers\ApiHelper;
use App\Helpers\PermissionHelper;
use App\Http\Requests\AddAdminRequest;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        // dd(session()->all());
        $data = [
            'staff' => [],
            'supervisor' => [],
            'manager' => [],
        ];
        try {
            $selectedGroup = $request->query('divisi');
            $dataGroups = null;
            if (hasRole('admin')) {
                $dataGroups = ApiHelper::request("GET", "/group")['data'];
            }
            $endpoints = [
                'staff' => 'list_staff',
                'supervisor' => 'list_spv',
                'manager' => 'list_manager',
            ];
            foreach ($endpoints as $key => $permission) {
                $data[$key] = PermissionHelper::hasRoleAndPermission($permission)
                    ? ApiHelper::request("GET", "/admin/$key", null, [], false)['data']
                    : null;
            }
        } catch (ClientException $e) {

        }
        // dd($data);
        [$dataStaff, $dataSpv, $dataManager] = array_values($data);

        if ($selectedGroup) {
            $dataStaff = collect($dataStaff)->filter(fn($item) => $item['group']['name'] === $selectedGroup)->toArray();
            $dataSpv = collect($dataSpv)->filter(fn($item) => $item['group']['name'] === $selectedGroup)->toArray();
            $dataManager = collect($dataManager)->filter(fn($item) => $item['group']['name'] === $selectedGroup)->toArray();
        }
        return view('dashboard.admin.admin', compact('dataStaff', 'dataSpv', 'dataManager', 'dataGroups', 'selectedGroup'));
    }

    public function addAdmin(Request $request)
    {
        $dataGroups = ApiHelper::request("GET", "/group")['data'];
        $allowedValues = array_column($dataGroups, 'value');

        $request->merge(['allowed_values' => $allowedValues]);
        // dd($dataGroups);
        return view('dashboard.admin.create-admin', compact('dataGroups'));
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
        return $this->addUser('/admin/staff/create', $request);
    }
    public function addSpv(AddAdminRequest $request)
    {
        return $this->addUser('/admin/supervisor/create', $request);
    }
    public function addManager(AddAdminRequest $request)
    {
        return $this->addUser('/admin/manager/create', $request);
    }

    public function editAdmin($paramId)
    {
        $userData = ApiHelper::request("GET", "/admin/{$paramId}")['data'];
        // dd($userData);
        return view('dashboard.admin.update-admin', compact('userData'));
    }

    public function updateAdmin(AddAdminRequest $request, $paramId)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $keys = [
            "fullname",
            "email",
            "username",
            "address",
            "phone",
            "group_id",
        ];
        $requestData = RequestHelper::sanitize($request, $keys);

        // dd($requestData);
        try {
            ApiHelper::request("PATCH", "/admin/{$paramId}/update", [
                "form_params" => $requestData,
            ]);

            return response()->json([
                'error' => false,
                'message' => [
                    'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Di Ubah.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msgs = [
                409 => "Email atau Username sudah terdaftar.",
                403 => "Kamu tidak memiliki akses untuk melakukan aksi ini.",
                422 => "Divisi atau Group tidak ditemukan.",
            ];
            $msg = $msgs[$statusCode] ?? "Gagal Mengirim Data.";
            return response()->json([
                'error' => true,
                'status' => $statusCode,
                'message' => [
                    'returned' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }


    public function adminPermission($paramId)
    {
        $userData = ApiHelper::request("GET", "/admin/{$paramId}")['data'];
        $paramIds = $userData['id'];
        $categories = ApiHelper::request("GET", "/permission_category")['data'];
        $dataPermis = ApiHelper::request("GET", "/admin/{$paramIds}/get_default_permission");
        $data = ApiHelper::request("GET", "/admin/{$paramIds}/get_permission")['data'];
        // dd($categories);
        return view('dashboard.admin.admin-permission', compact('userData', 'dataPermis', 'data', 'categories'));
    }

    public function grant(Request $request, $paramId)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $permissionIds = $request->input('permission_ids', []);
        $permissionIds = array_map('intval', $permissionIds);
        $jsonData = [
            'permission_ids' => $permissionIds,
        ];
        // dd($jsonData);
        try {
            // Make the API request to grant permissions
            ApiHelper::request("POST", "/admin/{$paramId}/grant_permission", [
                'json' => $jsonData
            ], [
                'Content-Type' => 'application/json',
            ]);
                return response()->json([
                    'error' => false,
                    'message' => [
                        'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Permission berhasil di setting.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    ],
                ]);
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msgs = [
                422 => "ID tidak ditemukan.",
            ];
            $msg = $msgs[$statusCode] ?? "Gagal Mengirim Data.";
            return response()->json([
                'error' => true,
                'status' => $statusCode,
                'message' => [
                    'returned' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

    public function revoke(Request $request, $paramId)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $permissionIds = $request->input('permission_ids', []);
        $permissionIds = array_map('intval', $permissionIds);
        $jsonData = [
            'permission_ids' => $permissionIds,
        ];
        // dd($requestData);
        try {
            ApiHelper::request("DELETE", "/admin/{$paramId}/revoke_permission", [
                'json' => $jsonData
            ], [
                'Content-Type' => 'application/json',
            ]);

            return response()->json([
                'error' => false,
                'message' => [
                    'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Permission berhasil di setting.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msgs = [
                422 => "ID tidak ditemukan.",
            ];
            $msg = $msgs[$statusCode] ?? "Gagal Mengirim Data.";
            return response()->json([
                'error' => true,
                'status' => $statusCode,
                'message' => [
                    'returned' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        }
    }

}

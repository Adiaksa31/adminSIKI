<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use App\Helpers\RequestHelper;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        // if(!isLogin($request)) abort(redirect()->route('login'));
    }

    public function dashboard()
    {
        // dd(session()->all());
        return view('dashboard.dashboard');
    }

// category
public function category()
{
    $categories = ApiHelper::request("GET", "/permission_category")['data'];
    // dd($categories);
    return view('dashboard.groups.category', compact('categories'));
}

public function addCategory(Request $request)
{
    if (!$request->ajax()) {
        return redirect()->back();
    }
    $keys = [
        "name",
    ];
    $rules = [
        "name" => 'required|string'
    ];
    $messages = [
        'name.required' => 'Category harus diisi',
        'name.string' => 'Category harus berupa string'
    ];

    $validator = Validator::make(
        $request->all(),
        $rules,
        $messages
    );

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors()
        ]);
    }

    $requestData = RequestHelper::sanitize($request, $keys);
    try {
        ApiHelper::request("POST", '/permission_category/create', [
            "form_params" => $requestData,
        ]);
        return response()->json([
            'error' => false,
            'message' => [
                'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menambahkan category.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
            ],
        ]);
    } catch (ClientException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        $msgs = [
            400 => "Terjadi kesalahan, coba lagi nanti",
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

public function findCategory(Request $request)
{
    if (!$request->ajax()) {
        return redirect()->back();
    }

    $rules = ['id' => 'required|integer'];
    $messages = [
        'id.required' => 'ID is required',
        'id.integer' => 'ID must be an integer'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors()
        ]);
    }

    $id = $request->input('id');

    try {
        $response = ApiHelper::request("GET", "/permission_category/{$id}", []);

        if ($response['status'] === 200) {
            return response()->json([
                'status' => 200,
                'message' => 'OK',
                'data' => $response['data']
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Failed to fetch category data'
            ]);
        }

    } catch (ClientException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        $msg = $statusCode === 404 ? "Category not found" : "An error occurred";

        return response()->json([
            'error' => true,
            'message' => $msg
        ]);
    }
}

public function updateCategory(Request $request)
{
    if (!$request->ajax()) {
        return redirect()->back();
    }

    $keys = [
        "name",
    ];

    $rules = ['id' => 'required|integer'];
    $messages = [
        'id.required' => 'ID is required',
        'id.integer' => 'ID must be an integer'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors()
        ]);
    }

    $id = $request->input('id');

    $requestData = RequestHelper::sanitize($request, $keys);

    try {
        $response = ApiHelper::request("PATCH", "/permission_category/{$id}/update", [
            "form_params" => $requestData,
        ]);

        if ($response['status'] === 200) {
            return response()->json([
                'status' => 200,
                'message' => 'OK',
                'data' => $response
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Failed to fetch category data'
            ]);
        }

    } catch (ClientException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        $msg = $statusCode === 404 ? "Category not found" : "An error occurred";

        return response()->json([
            'error' => true,
            'message' => $msg
        ]);
    }
}

public function deleteCategory(Request $request)
{
    if (!$request->ajax()) {
        return redirect()->back();
    }

    $rules = ['id' => 'required|integer'];
    $messages = [
        'id.required' => 'ID is required',
        'id.integer' => 'ID must be an integer'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors()
        ]);
    }

    $id = $request->input('id');

    try {
        $response = ApiHelper::request("PATCH", "/group/{$id}/toggle_hide", []);

        if ($response['status'] === 200) {
            return response()->json([
                'status' => 200,
                'message' => 'OK',
                'data' => $response['data']
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Failed to fetch category data'
            ]);
        }

    } catch (ClientException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        $msg = $statusCode === 404 ? "Category not found" : "An error occurred";

        return response()->json([
            'error' => true,
            'message' => $msg
        ]);
    }
}


// endcategory

    // divisi
    public function divisi()
    {
        $dataGroup = ApiHelper::request("GET", "/group")['data'];
        return view('dashboard.groups.divisi', compact('dataGroup'));
    }

    public function addDivisi(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        $keys = [
            "name",
        ];
        $rules = [
            "name" => 'required|string'
        ];
        $messages = [
            'name.required' => 'Divisi harus diisi',
            'name.string' => 'Divisi harus berupa string'
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $requestData = RequestHelper::sanitize($request, $keys);
        // dd($requestData);
        try {
            ApiHelper::request("POST", '/group/create', [
                "form_params" => $requestData,
            ]);
            return response()->json([
                'error' => false,
                'message' => [
                    'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menambahkan divisi.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                ],
            ]);
        } catch (ClientException $e) {
            // dd($e);
            $statusCode = $e->getResponse()->getStatusCode();
            $msgs = [
                400 => "Divisi harus diisi",
                409 => "Divisi sudah ada",
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

    public function findDivisi(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }

        $rules = ['id' => 'required|integer'];
        $messages = [
            'id.required' => 'ID is required',
            'id.integer' => 'ID must be an integer'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $id = $request->input('id');

        try {
            $response = ApiHelper::request("GET", "/group/{$id}", []);

            if ($response['status'] === 200) {
                return response()->json([
                    'status' => 200,
                    'message' => 'OK',
                    'data' => $response['data']
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Failed to fetch divisi data'
                ]);
            }

        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $msg = $statusCode === 404 ? "Group not found" : "An error occurred";

            return response()->json([
                'error' => true,
                'message' => $msg
            ]);
        }
    }

    public function updateDivisi(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }

        $keys = [
            "name",
        ];

        $rules = ['id' => 'required|integer'];
        $messages = [
            'id.required' => 'ID is required',
            'id.integer' => 'ID must be an integer'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $id = $request->input('id');

        $requestData = RequestHelper::sanitize($request, $keys);

        try {
            $response = ApiHelper::request("PATCH", "/group/{$id}/update", [
                "form_params" => $requestData,
            ]);

            if ($response['status'] === 200) {
                return response()->json([
                    'status' => 200,
                    'message' => 'OK',
                    'data' => $response
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Failed to fetch divisi data'
                ]);
            }

        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            // dd($e);
            $msg = $statusCode === 404 ? "Group not found" : "An error occurred";

            return response()->json([
                'error' => true,
                'message' => $msg
            ]);
        }
    }

    public function deleteDivisi(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }

        $rules = ['id' => 'required|integer'];
        $messages = [
            'id.required' => 'ID is required',
            'id.integer' => 'ID must be an integer'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $id = $request->input('id');

        try {
            $response = ApiHelper::request("PATCH", "/group/{$id}/toggle_hide", []);

            if ($response['status'] === 200) {
                return response()->json([
                    'status' => 200,
                    'message' => 'OK',
                    'data' => $response['data']
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Failed to fetch divisi data'
                ]);
            }

        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $msg = $statusCode === 404 ? "Group not found" : "An error occurred";

            return response()->json([
                'error' => true,
                'message' => $msg
            ]);
        }
    }
    // endivisi

    //permission

    public function permission()
{
    $dataPermission = ApiHelper::request("GET", "/permission_category")['data'];
    // dd($dataPermission);
    return view('dashboard.groups.permission', compact('dataPermission'));
}

public function addPermission(Request $request)
{
    if (!$request->ajax()) {
        return redirect()->back();
    }
    // dd($request);

    $keys = ["name", "permission_category_id"];
    // dd($keys);
    $rules = [
        "name" => 'required|string',
        "permission_category_id" => 'required'
    ];
    $messages = [
        'name.required' => 'Nama tidak boleh kosong',
        'name.string' => 'Nama harus berupa string',
        'permission_category_id.required' => 'Pilih permission',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors()
        ]);
    }

    $requestData = RequestHelper::sanitize($request, $keys);
    // dd($requestData);
    try {
        ApiHelper::request("POST", '/permission/create', [
            "form_params" => $requestData,
        ]);
        return response()->json([
            'error' => false,
            'message' => [
                'returned' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Permission added successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
            ],
        ]);
    } catch (ClientException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        // dd($e);
        $msgs = [400 => "Name or Permission is required", 409 => "Permission with that name is already exists", 422 => "Permisson is invalid"];
        $msg = $msgs[$statusCode] ?? "Failed to send data.";

        return response()->json([
            'error' => true,
            'message' => [
                'returned' => '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
            ],
        ]);
    }
}
    //end permission

}

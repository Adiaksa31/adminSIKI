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
        return view('dashboard.dashboard');
    }

    public function category()
    {
        $categories = ApiHelper::request("GET", "/permission_category")['data'];
        return view('dashboard.groups.category', compact('categories'));
    }



    public function addcategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $categoryData = [
            'name' => $request->input('name'),
        ];

        try {
            ApiHelper::request("POST", '/permission_category/create', [
                'form_params' => $categoryData,
            ]);

            return redirect()->route('dashboard/category')->with('success', 'Category added successfully.');
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            dd($e);
            $msg = $statusCode == 400 ? 'Invalid input.' : 'Error adding category.';
            return back()->with('error', $msg);
        }

    }

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
            dd($e);
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

}

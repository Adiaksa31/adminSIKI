<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsrfTokenController extends Controller
{
    public function generateCsrfToken(Request $request)
    {
        if ($request->isMethod('get')) {
            return response()->json([
                '_token' => csrf_token()
            ]);
        }

        return response()->json(['message' => 'Method not allowed'], 405);
    }
}

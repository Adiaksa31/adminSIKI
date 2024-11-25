<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator){
        $errors = $validator->errors();
        $response = response()->json([
            'error' => true,
            'message' => $errors,
        ], 200);

        throw new HttpResponseException($response);
    }
}

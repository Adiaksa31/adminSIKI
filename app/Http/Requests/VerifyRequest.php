<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'otp' => 'required|string|regex:/^[a-zA-Z0-9]{8}$/',
        ];
    }

    public function messages(): array {
        return [
            'otp.required' => 'OTP harus diisi.',
            'otp.string' => 'OTP harus berupa string.',
            'otp.regex' => 'OTP harus terdiri dari 8 digit.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends BaseRequest
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
            'username' => 'required|string|max:50',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages(): array {
        return [
            'username.required' => 'Username/email harus diisi.',
            'username.string' => 'Username/email harus berupa string.',
            'username.max' => 'Username/email tidak boleh lebih dari :maks 50 karakter.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa string.',
            'g-recaptcha-response.required' => 'Captcha harus diisi.',
            'g-recaptcha-response.captcha' => 'Verifikasi captcha gagal, coba lagi.',
        ];
    }
}

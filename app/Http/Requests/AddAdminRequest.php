<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends BaseRequest
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
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'username' => 'required|string|max:50',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Nama lengkap harus diisi.',
            'fullname.string' => 'Nama lengkap harus berupa string.',
            'fullname.max' => 'Nama lengkap tidak boleh lebih dari :max 100 karakter.',

            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari :max 150 karakter.',

            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.max' => 'Username tidak boleh lebih dari :max 50 karakter.',

            'address.required' => 'Alamat harus diisi.',
            'address.string' => 'Alamat harus berupa string.',

            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.string' => 'Nomor telepon harus berupa string.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari :max 15 karakter.',

        ];
    }

}

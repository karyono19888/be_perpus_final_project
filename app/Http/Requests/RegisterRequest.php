<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Nama wajib diisi.',
            'name.string'         => 'Nama harus berupa string.',
            'name.max'            => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required'      => 'Email wajib diisi.',
            'email.string'        => 'Email harus berupa string.',
            'email.email'         => 'Email harus berupa email yang valid.',
            'email.max'           => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique'        => 'Email sudah terdaftar.',
            'password.required'   => 'Password wajib diisi.',
            'password.string'     => 'Password harus berupa string.',
            'password.min'        => 'Password minimal 6 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
        ];
    }
}
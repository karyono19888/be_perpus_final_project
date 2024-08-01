<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Email harus berupa email yang valid.',
            'email.exists'        => 'Email tidak terdaftar.',
            'password.required'   => 'Password wajib diisi.',
            'password.min'        => 'Password minimal 6 karakter.',
        ];
    }
}
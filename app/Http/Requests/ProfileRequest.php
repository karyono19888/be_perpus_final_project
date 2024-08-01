<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'age'      => 'required|integer',
            'bio'      => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'age.required'   => 'Age wajib diisi.',
            'age.integer'    => 'Age harus berupa angka.',
            'bio.required'   => 'Biodata wajib diisi.',
            'bio.string'     => 'Biodata harus berupa string.',
        ];
    }
}
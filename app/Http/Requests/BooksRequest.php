<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
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
            'title'         => 'required|max:255',
            'summary'       => 'required',
            'stock'         => 'required|integer',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'   => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'title wajib diisi',
            'title.max'             => 'title tidak boleh lebih dari 255 karakter',
            'summary.required'      => 'summary wajib diisi',
            'stock.required'        => 'stock wajib diisi',
            'stock.integer'         => 'stock harus berupa Angka yang valid',
            'image.mimes'           => 'image harus berupa file dengan tipe: jpeg, png, jpg, gif, svg',
            'image.image'           => 'image harus berupa image',
            'image.max'             => 'image maximal size 2MB',
            'category_id.required'  => 'category id wajib diisi',
        ];
    }
}
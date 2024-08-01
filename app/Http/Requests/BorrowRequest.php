<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRequest extends FormRequest
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
            'load_date'     => 'required',
            'borrow_date'   => 'required',
            'book_id'       => 'required|exists:books,id',
            'user_id'       => 'required|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'load_date.required'     => 'load date wajib diisi.',
            'borrow_date.required'   => 'borrow date wajib diisi.',
            'book_id.required'       => 'book id wajib diisi.',
            'book_id.unique'         => 'book id tidak terdaftar.',
            'user_id.required'       => 'user id wajib diisi.',
            'user_id.unique'         => 'user id tidak terdaftar.',
        ];
    }
}
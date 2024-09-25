<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required',
            'name' => 'required',
            'department' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'mobile' => [
                'required',
                'digits:10',
                Rule::unique('users')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
    }
}

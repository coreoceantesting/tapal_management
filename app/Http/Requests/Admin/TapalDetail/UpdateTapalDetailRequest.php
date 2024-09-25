<?php

namespace App\Http\Requests\Admin\TapalDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTapalDetailRequest extends FormRequest
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
            'letter_type' => 'required',
            'department' => 'required',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'city' => 'required|regex:/^[a-zA-Z\s]+$/',
            'address' => 'required',
            'pin' => 'required|digits:6',
            'referance_no' => 'nullable',
            'barcode_no' => 'nullable',
        ];
    }
}

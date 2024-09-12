<?php

namespace App\Http\Requests\Admin\TapalDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTapalDetailRequest extends FormRequest
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
            'name' => 'required|alpha',
            'city' => 'required|alpha',
            'address' => 'required',
            'pin' => 'required|digit:6',
            'referance_no' => [
                'required',
                Rule::unique('tapal_details')->whereNull('deleted_at')
            ],
            'barcode_no' => [
                'required',
                Rule::unique('tapal_details')->whereNull('deleted_at')
            ],
            // 'referance_no' => 'required',
            // 'barcode_no' => 'required',
        ];
    }
}

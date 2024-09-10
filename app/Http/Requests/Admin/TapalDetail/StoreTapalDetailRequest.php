<?php

namespace App\Http\Requests\Admin\TapalDetail;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'referance_no' => 'required',
            'barcode_no' => 'required',
        ];
    }
}

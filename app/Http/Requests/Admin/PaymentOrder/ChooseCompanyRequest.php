<?php

namespace App\Http\Requests\Admin\PaymentOrder;

use Illuminate\Foundation\Http\FormRequest;

class ChooseCompanyRequest extends FormRequest
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
            "company" => "required",
        ];
    }

    public function messages()
    {
        return [
            'company.required' => 'Chưa chọn công ty',
        ];
    }
}
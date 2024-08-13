<?php

namespace App\Http\Requests\Suggestion;

use Illuminate\Foundation\Http\FormRequest;

class ChooseCompanyCreateRequest extends FormRequest
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
            "DocCode" => "required",
        ];
    }

    public function messages()
    {
        return [
            'company.required' => 'Chưa chọn công ty',
            'DocCode.required' => 'Chưa chọn kiểu đề nghị',
        ];
    }
}
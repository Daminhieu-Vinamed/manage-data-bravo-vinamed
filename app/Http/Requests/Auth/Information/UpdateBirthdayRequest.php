<?php

namespace App\Http\Requests\Auth\Information;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBirthdayRequest extends FormRequest
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
            'birthday' => 'required|date|date_format:Y-m-d',
        ];
    }
    
    public function messages()
    {
        return [
            'birthday.required' => 'Ngày sinh nhật không được để trống',
            'birthday.date' => 'Ngày sinh nhật không đúng kiểu',
            'birthday.date_format' => 'Ngày sinh nhật không đúng định dạng',
        ];
    }
}
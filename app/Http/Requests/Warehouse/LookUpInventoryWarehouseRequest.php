<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class LookUpInventoryWarehouseRequest extends FormRequest
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
            "endDate" => "required|date_format:Y-m-d|after_or_equal:startDate",
        ];
    }

    public function messages()
    {
        return [
            'endDate.required' => 'Thời gian kết thúc không được để trống',
            'endDate.date_format' => 'Không đúng định dạng',
            'end.after_or_equal' => 'Thời gian kết thúc không hợp lệ',
        ];
    }
}
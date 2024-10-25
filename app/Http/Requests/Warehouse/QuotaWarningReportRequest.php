<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class QuotaWarningReportRequest extends FormRequest
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
            "startDate" => "required|date_format:Y-m-d",
            "endDate" => "required|date_format:Y-m-d|after_or_equal:startDate",
        ];
    }

    public function messages()
    {
        return [
            'startDate.required' => 'Thời gian bắt đầu không được để trống',
            'startDate.date_format' => 'Không đúng định dạng',
            'endDate.required' => 'Thời gian kết thúc không được để trống',
            'endDate.date_format' => 'Không đúng định dạng',
            'end.after_or_equal' => 'Thời gian kết thúc không hợp lệ',
        ];
    }
}
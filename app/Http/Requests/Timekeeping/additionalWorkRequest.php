<?php

namespace App\Http\Requests\Timekeeping;

use Illuminate\Foundation\Http\FormRequest;

class additionalWorkRequest extends FormRequest
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
            "start" => "required",
            "end" => "required|after_or_equal:start",
            // "reason" => "required",
            "type" => "required",
        ];
    }

    public function messages()
    {
        return [
            // 'reason.required' => 'Chưa điền lý do',
            'end.required' => 'Chưa chọn thời gian kết thúc',
            'end.after_or_equal' => 'Thời gian kết thúc không hợp lệ',
            'start.required' => 'Chưa chọn thời gian bắt đầu',
            'type.required' => 'Chưa chọn loại ngày công',
        ];
    }
}
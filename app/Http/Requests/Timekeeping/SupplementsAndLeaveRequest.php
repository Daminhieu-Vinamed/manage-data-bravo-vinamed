<?php

namespace App\Http\Requests\Timekeeping;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplementsAndLeaveRequest extends FormRequest
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
            "description" => "required",
            "type" => [
                "required",
                function ($attribute, $value, $fail) {
                    $user = Auth::user();
                    $np = DB::connection($user->company)->table('vB30HrmPTimesheet')
                    ->where('IsActive', config('constants.number.one'))
                    ->where('DocCode', 'NP')
                    ->where('EmployeeCode', $user->EmployeeCode)
                    ->whereDate('FromDate', '>=', $this->start)
                    ->whereDate('ToDate', '<=', $this->end)
                    ->exists();
                    $bs = DB::connection($user->company)->table('vB30HrmPTimesheet')
                    ->where('IsActive', config('constants.number.one'))
                    ->where('DocCode', 'BS')
                    ->where('EmployeeCode', $user->EmployeeCode)
                    ->whereDate('FromDate', '>=', $this->start)
                    ->whereDate('ToDate', '<=', $this->end)
                    ->exists();
                    if ($np) {
                        $fail('Đã đăng ký nghỉ phép trong khoảng thời gian này');
                    }elseif($bs) {
                        $fail('Đã đăng ký bổ sung trong khoảng thời gian này');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Chưa điền lý do',
            'end.required' => 'Chưa chọn thời gian kết thúc',
            'end.after_or_equal' => 'Thời gian kết thúc không hợp lệ',
            'start.required' => 'Chưa chọn thời gian bắt đầu',
            'type.required' => 'Chưa chọn loại ngày công',
        ];
    }
}
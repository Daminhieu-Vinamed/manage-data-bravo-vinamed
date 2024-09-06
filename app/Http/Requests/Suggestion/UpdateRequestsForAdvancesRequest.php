<?php

namespace App\Http\Requests\Suggestion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class UpdateRequestsForAdvancesRequest extends FormRequest
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
        $arrValid = array(
            "BranchCode" => "required",
            "DocStatus" => "required",
            "DocDate" => "required",
            "DocNo" => [
                "required",
                function ($attribute, $value, $fail) {
                    $requestsForAdvances = DB::connection($this->BranchCode)->table('B33AccDoc')->where("DocCode", $this->DocCode)->where("DocNo", $value)->where("Id","<>", $this->IdRFA)->first();
                    if (!empty($requestsForAdvances)) {
                        $fail('Mã chứng từ đã tồn tại');
                    }
                },
            ],
            "DocCode" => "required",
            "CustomerCode" => "required",
            "EmployeeCode" => "required",
            "CurrencyCode" => "required",
            "Hinh_Thuc_TT" => "required",
            "ExchangeRate" => "nullable|numeric|min:0",
            'TotalOriginalAmount' => "required|numeric|gt:0",
        );
        if ($this->CurrencyCode !== "VND") {
            $arrValid['TotalAmount'] = "required|numeric|gt:0";
        }

        if ($this->Hinh_Thuc_TT === "CK") {
            $arrValid["BankName"] = "required";
            $arrValid["BankAccountNo"] = "required";
            $arrValid["Ten_Chu_TK"] = "required";
            $arrValid["Description1"] = "required";
        }
        return $arrValid;
    }
    
    public function messages()
    {
        return [
            'DocDate.required' => 'Ngày tạo không được để trống',
            'CustomerCode.required' => 'Chưa chọn người đề nghị',
            'EmployeeCode.required' => 'Chưa chọn nhân viên',
            'CurrencyCode.required' => 'Chưa chọn loại tiền',
            'Hinh_Thuc_TT.required' => 'Chưa chọn phương thức thanh toán',
            'ExchangeRate.numeric' => 'Tỷ giá hạch toán phải là ký tự số',
            'ExchangeRate.min' => 'Giá trị tỷ giá hạch toán không được nhỏ hơn 0',
            'TotalOriginalAmount.required' => 'Tổng cộng đang trống',
            'TotalOriginalAmount.gt' => 'Tổng cộng phải lớn hơn 0',
            'TotalOriginalAmount.numeric' => 'Tổng cộng phải là ký tự số',
            'TotalAmount.required' => 'Tổng cộng đang trống',
            'TotalAmount.gt' => 'Tổng cộng phải lớn hơn 0',
            'TotalAmount.numeric' => 'Tổng cộng phải là ký tự số',
            'BankName.required' => 'Tên ngân hàng không được để trống',
            'BankAccountNo.required' => 'Số tài khoản không được để trống',
            'Ten_Chu_TK.required' => 'Tên chủ tài khoản không được để trống',
            'Description1.required' => 'Nội dung không được để trống',
        ];
    }
}
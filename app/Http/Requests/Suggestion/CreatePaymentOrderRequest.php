<?php

namespace App\Http\Requests\Suggestion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CreatePaymentOrderRequest extends FormRequest
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
                    $paymentOrder = DB::connection($this->BranchCode)->table('B33AccDoc')->where("DocNo", $value)->first();
                    if (!empty($paymentOrder)) {
                        $fail('Mã chứng từ đã tồn tại');
                    }
                },
            ],
            "DocCode" => "required",
            "EmployeeCode" => "required",
            "CustomerCode1" => "required",
            "AmountTT" => "nullable|numeric|min:0",
            "AmountTU" => "nullable|numeric|min:0",
            "Hinh_Thuc_TT" => "required",
            "CurrencyCode" => "required",
            "ExchangeRate" => "nullable|numeric|min:0",
            "So_Hd" => "array",
            "So_Hd.*"  => [
                function ($attribute, $value, $fail) {
                    $number = (int)substr($attribute, config('constants.number.negative_one'));
                    if ($this->TaxCode[$number] !== config('constants.value.null') && $value === config('constants.value.null')) {
                        $fail('Số hóa đơn không được để trống');
                    }
                },
            ],
            "Ngay_Hd" => "array",
            "Ngay_Hd.*"  => [
                function ($attribute, $value, $fail) {
                    $number = (int)substr($attribute, config('constants.number.negative_one'));
                    if ($this->TaxCode[$number] !== config('constants.value.null') && $value === config('constants.value.null')) {
                        $fail('Ngày hóa đơn không được để trống');
                    }
                },
            ],
            'TotalOriginalAmount0' => "required|numeric|gt:0",
            'TotalOriginalAmount3' => "nullable|numeric|min:0",
            'TotalOriginalAmount' => "required|numeric|gt:0",
        );

        if ($this->CurrencyCode !== "VND") {
            $arrValid['TotalAmount0'] = "required|numeric|gt:0";
            $arrValid['TotalAmount3'] = "nullable|numeric|min:0";
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
            'EmployeeCode.required' => 'Chưa chọn người đề nghị',
            'CustomerCode1.required' => 'Chưa chọn nhà cung cấp/người nhận',
            'AmountTT.min' => 'Giá trị đã trả trước cho NCC không được nhỏ hơn 0',
            'AmountTU.min' => 'Giá trị đã tạm ứng không được nhỏ hơn 0',
            'Hinh_Thuc_TT.required' => 'Hình thức thanh toán không được để trống',
            'CurrencyCode.required' => 'Loại tiền không được để trống',
            'ExchangeRate.numeric' => 'Tỷ giá hạch toán phải là ký tự số',
            'ExchangeRate.min' => 'Giá trị tỷ giá hạch toán không được nhỏ hơn 0',
            
            'TotalOriginalAmount0.required' => 'Thành tiền đang trống',
            'TotalOriginalAmount0.gt' => 'Thành tiền phải lớn hơn 0',
            'TotalOriginalAmount0.numeric' => 'Thành tiền phải là ký tự số',
            'TotalAmount0.required' => 'Thành tiền đang trống',
            'TotalAmount0.gt' => 'Thành tiền phải lớn hơn 0',
            'TotalAmount0.numeric' => 'Thành tiền phải là ký tự số',
            
            'TotalOriginalAmount3.min' => 'Tiền VAT không được nhỏ hơn 0',
            'TotalOriginalAmount3.numeric' => 'Tiền VAT phải là ký tự số',
            'TotalAmount3.min' => 'Tiền VAT không được nhỏ hơn 0',
            'TotalAmount3.numeric' => 'Tiền VAT phải là ký tự số',
            
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
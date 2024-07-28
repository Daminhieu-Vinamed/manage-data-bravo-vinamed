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
            "AmountTT" => "required",
            "Stt_TU" => "required",
            "AmountTU" => "required",
            "Hinh_Thuc_TT" => "required",
            "CurrencyCode" => "required",
            "ExchangeRate" => "required|gt:0",
            "Ngay_Hd" => "array",
            "Ngay_Hd.*"  => "required",
        );

        if ($this->CurrencyCode === "VND") {
            $arrValid['TotalOriginalAmount0'] = "required|gt:0";
            $arrValid['TotalOriginalAmount3'] = "required|gt:0";
            $arrValid['TotalOriginalAmount'] = "required|gt:0";
        } else {
            $arrValid['TotalOriginalAmount0'] = "required|gt:0";
            $arrValid['TotalOriginalAmount3'] = "required|gt:0";
            $arrValid['TotalOriginalAmount'] = "required|gt:0";
            $arrValid['TotalAmount0'] = "required|gt:0";
            $arrValid['TotalAmount3'] = "required|gt:0";
            $arrValid['TotalAmount'] = "required|gt:0";
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
            'AmountTT.required' => 'Đã trả trước cho NCC không được để trống',
            'Stt_TU.required' => 'Chưa chọn đề nghị tạm ứng',
            'AmountTU.required' => 'Đã tạm ứng không được để trống',
            'Hinh_Thuc_TT.required' => 'Hình thức thanh toán không được để trống',
            'CurrencyCode.required' => 'Loại tiền không được để trống',
            'ExchangeRate.required' => 'Tỷ giá hạch toán không được để trống',
            'ExchangeRate.gt' => 'Tỷ giá hạch toán phải lớn hơn 0',
            'TotalOriginalAmount0.required' => 'Thành tiền đang trống',
            'TotalOriginalAmount0.gt' => 'Thành tiền phải lớn hơn 0',
            'TotalOriginalAmount3.required' => 'Tiền VAT đang trống',
            'TotalOriginalAmount3.gt' => 'Tiền VAT phải lớn hơn 0',
            'TotalOriginalAmount.required' => 'Tổng cộng đang trống',
            'TotalOriginalAmount.gt' => 'Tổng cộng phải lớn hơn 0',
            'BankName.required' => 'Tên ngân hàng không được để trống',
            'BankAccountNo.required' => 'Số tài khoản không được để trống',
            'Ten_Chu_TK.required' => 'Tên chủ tài khoản không được để trống',
            'Description1.required' => 'Nội dung không được để trống',
            "Ngay_Hd.*.required" => 'Ngày hóa đơn không được để trống',
        ];
    }
}
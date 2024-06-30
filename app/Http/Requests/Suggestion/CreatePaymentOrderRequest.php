<?php

namespace App\Http\Requests\Suggestion;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            "BranchCode" => "required",
            "DocStatus" => "required",
            "DocDate" => "required",
            "DocNo" => "required",
            "DocCode" => "required",
            "EmployeeCode" => "required",
            "CustomerCode1" => "required",
            "AmountTT" => "required",
            "Stt_TU" => "required",
            "AmountTU" => "required",
            "Hinh_Thuc_TT" => "required",
            "CurrencyCode" => "required",
            "ExchangeRate" => "required",
            "TotalOriginalAmount0" => "required",
            "TotalOriginalAmount3" => "required",
            "TotalOriginalAmount" => "required",
            "BankName" => "required",
            "BankAccountNo" => "required",
            "Ten_Chu_TK" => "required",
            "So_Hd" => "array",
            "So_Hd.*"  => "required",
            "Ngay_Hd" => "array",
            "Ngay_Hd.*"  => "required",
            "Description" => "array",
            "Description.*"  => "required",
            "Invoice" => "array",
            "Invoice.*"  => "required",
            "So_Van_Don" => "array",
            "So_Van_Don.*"  => "required",
            "Trong_Luong" => "array",
            "Trong_Luong.*"  => "required",
            "DV_Trong_Luong" => "array",
            "DV_Trong_Luong.*"  => "required",
            "CustomerCode2" => "array",
            "CustomerCode2.*"  => "required",
            "ExpenseCatgCode" => "array",
            "ExpenseCatgCode.*"  => "required",
            "EmployeeCode1" => "array",
            "EmployeeCode1.*"  => "required",
            "DeptCode" => "array",
            "DeptCode.*"  => "required",
            "BizDocId_PO" => "array",
            "BizDocId_PO.*"  => "required",
            "Hang_SX" => "array",
            "Hang_SX.*"  => "required",
            "OriginalAmount9" => "array",
            "OriginalAmount9.*"  => "required",
            "TaxCode" => "array",
            "TaxCode.*"  => "required",
            "TaxRate" => "array",
            "TaxRate.*"  => "required",
            "Amount3" => "array",
            "Amount3.*"  => "required",
            "Note" => "array",
            "Note.*"  => "required"
        ];
    }

    public function messages()
    {
        return [
            'EmployeeCode.required' => 'Chưa chọn người đề nghị',
            'CustomerCode1.required' => 'Chưa chọn nhà cung cấp/người nhận',
            'AmountTT.required' => 'Đã trả trước cho NCC không được để trống',
            'Stt_TU.required' => 'Chưa chọn đề nghị tạm ứng',
            'AmountTU.required' => 'Đã tạm ứng không được để trống',
            'Hinh_Thuc_TT.required' => 'Hình thức thanh toán không được để trống',
        ];
    }
}
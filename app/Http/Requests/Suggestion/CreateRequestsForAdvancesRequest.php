<?php

namespace App\Http\Requests\Suggestion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class CreateRequestsForAdvancesRequest extends FormRequest
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
                    $requestsForAdvances = DB::connection($this->BranchCode)->table('B33AccDoc')->where("DocNo", $value)->first();
                    if (!empty($requestsForAdvances)) {
                        $fail('Mã chứng từ đã tồn tại');
                    }
                },
            ],
            "DocCode" => "required",
            
            "CustomerCode" => "required",
            "Description" => "required",
            "Hinh_Thuc_TT" => "required",
            "CurrencyCode" => "required",
            "ExchangeRate" => "required|numeric|gt:0",
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
}
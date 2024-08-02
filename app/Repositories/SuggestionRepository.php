<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuggestionRepository
{
    public function getData()
    {
        if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two')) {
            foreach (config('constants.company') as $company) {
                $paymentOrder = DB::connection($company)->table('vB33AccDoc_ExploreJournalEntry_Web')
                ->where('IsActive', config('constants.number.one'))
                ->orderBy('DocDate', 'desc')->get();
                $paymentOrderTotal[$company] = $paymentOrder->toArray();
            }
        } else {
            $arrayDeptCode = json_decode(Auth::user()->department->DeptCode);
            foreach (config('constants.company') as $company) {
                $paymentOrder = DB::connection($company)->table('vB33AccDoc_ExploreJournalEntry_Web')
                ->whereIn('Dept', $arrayDeptCode)
                ->where('IsActive', config('constants.number.one'))
                ->orderBy('DocDate', 'desc')->get();
                $paymentOrderTotal[$company] = $paymentOrder->toArray();
            }
        }
        return $paymentOrderTotal;
    }

    public function approvePaymentOrder($connectCompany, $Stt, $nUserId, $description, $username)
    {
        return $connectCompany->update(
            'EXEC Usp_ApproveDNTT ?, ?, ?, ?',
            [
                $Stt,
                $nUserId,
                $description === config('constants.value.null') ? config('constants.value.null') : $description,
                $username,
            ]
        );
    }

    public function cancelPaymentOrder($connectCompany, $Stt, $nUserId, $description, $username)
    {
        return $connectCompany->update(
            'EXEC Usp_CancelDNTT ?, ?, ?, ?',
            [
                $Stt,
                $nUserId,
                $description === config('constants.value.null') ? config('constants.value.null') : $description,
                $username,
            ]
        );
    }

    public function getPaymentOrder($request)
    {
        
        $B20Customer = DB::connection($request->company)->table('B20Customer')->select('Code', 'Address', 'Person', 'TaxRegNo', 'Name2', 'BankAccountNo', 'BankName', 'Name')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $B20Employee = DB::connection($request->company)->table('B20Employee')->select('Code', 'Name', 'Email', 'DeptCode')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $B20ExpenseCatg = DB::connection($request->company)->table('B20ExpenseCatg')->select('Code', 'Name')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $B20Dept = DB::connection($request->company)->table('B20Dept')->select('Code', 'Name2')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $B20Tax = DB::connection($request->company)->table('B20Tax')->select('Code', 'Name', 'Name2', 'Account', 'Rate')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $B20Currency = DB::connection($request->company)->table('B20Currency')->select('Code', 'Name')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $vB30BizDoc = DB::connection($request->company)->table('vB30BizDoc')->select('BizDocId', 'DocNo', 'DocInfo', 'EmployeeName', 'DocDate')
            ->where('DocCode', 'PO')
            ->where('DocDate', '<=', now())
            ->where('Post_TheKho', config('constants.number.one'))
            ->get();
        $vB33AccDoc_ExploreJournalEntry = DB::connection($request->company)->table('vB33AccDoc_ExploreJournalEntry')->select('Stt', 'DocNo', 'TotalAmount0', 'CustomerName', 'DocDate')
            ->where('IsActive', config('constants.number.one'))
            ->get();
        $B33AccDoc = DB::connection($request->company)->table('B33AccDoc')->select('DocNo')
            ->where('DocCode', $request->DocCode)
            ->orderBy('Id', 'DESC')
            ->first();
        return array('bill_detailed_object' => $B20Customer, 'bill_staff' => $B20Employee, 'base_items' => $B20ExpenseCatg, 'bill_part' => $B20Dept, 'bill_tax_category' => $B20Tax, 'currency' => $B20Currency, 'bill_purchase_order' => $vB30BizDoc, 'requests_for_advances' => $vB33AccDoc_ExploreJournalEntry, 'document_number' => $B33AccDoc->DocNo);
    }

    public function CreatePaymentOrder($connectCompany, $data)
    {
        $dataPO = [
            "BranchCode" => $data->BranchCode,
            "DocStatus" => $data->DocStatus,
            "DocDate" => $data->DocDate,
            "DocNo" => $data->DocNo,
            "DocCode" => $data->DocCode,
            "CustomerCode" => $data->CustomerCode1,
            "AmountTT" => empty($data->AmountTT) ? config('constants.number.zero') : $data->AmountTT,
            "Stt_TU" => empty($data->Stt_TU) ? config('constants.value.empty') : $data->Stt_TU,
            "AmountTU" => empty($data->AmountTU) ? config('constants.number.zero') : $data->AmountTU,
            "Hinh_Thuc_TT" => $data->Hinh_Thuc_TT,
            "CurrencyCode" => $data->CurrencyCode,
            "ExchangeRate" => empty($data->ExchangeRate) ? config('constants.number.zero') : $data->ExchangeRate,
            "TotalOriginalAmount0" => $data->TotalOriginalAmount0,
            "TotalAmount0" => isset($data->TotalAmount0) ? $data->TotalAmount0 : $data->TotalOriginalAmount0,
            "TotalOriginalAmount3" => $data->TotalOriginalAmount3,
            "TotalAmount3" => isset($data->TotalAmount3) ? $data->TotalAmount3 : $data->TotalOriginalAmount3,
            "TotalOriginalAmount" => $data->TotalOriginalAmount,
            "TotalAmount" => isset($data->TotalAmount) ? $data->TotalAmount : $data->TotalOriginalAmount,
            "BankName" => isset($data->BankName) ? $data->BankName : config('constants.value.empty'),
            "BankAccountNo" => isset($data->BankAccountNo) ? $data->BankAccountNo : config('constants.value.empty'),
            "Ten_Chu_TK" => isset($data->Ten_Chu_TK) ? $data->Ten_Chu_TK : config('constants.value.empty'),
            "Description1" => isset($data->Description1) ? $data->Description1 : config('constants.value.empty'),
        ];

        $connectCompany->table('B33AccDoc')->insert($dataPO);
        $paymentOrder = $connectCompany->table('B33AccDoc')->where("DocNo", $data->DocNo)->first();
        
        for ($i = config('constants.number.zero'); $i < $data->CountRow; $i++) { 
            $OriginalAmount9 = empty($data->OriginalAmount9[$i]) ? config('constants.number.zero') : $data->OriginalAmount9[$i];
            $OriginalAmount3 = empty($data->OriginalAmount3[$i]) ? config('constants.number.zero') : $data->OriginalAmount3[$i];
            $dataPODetail = [
                "BranchCode" => $data->BranchCode,
                'Stt' => $paymentOrder->Stt,
                "EmployeeCode" => $data->EmployeeCode,
                "DocDate" => $data->DocDate,
                "DocCode" => $data->DocCode,
                'BuiltinOrder' => $i + config('constants.number.one'),
                "So_Hd" => empty($data->So_Hd[$i]) ? config('constants.value.empty') : $data->So_Hd[$i],
                "Ngay_Hd" => $data->Ngay_Hd[$i],
                "Description" => empty($data->Description[$i]) ? config('constants.value.empty') : $data->Description[$i],
                "Invoice" => empty($data->Invoice[$i]) ? config('constants.value.empty') : $data->Invoice[$i],
                "So_Van_Don" => empty($data->So_Van_Don[$i]) ? config('constants.value.empty') : $data->So_Van_Don[$i],
                "Trong_Luong" => empty($data->Trong_Luong[$i]) ? config("constants.number.zero") : $data->Trong_Luong[$i],
                "DV_Trong_Luong" => empty($data->DV_Trong_Luong[$i]) ? config('constants.value.empty') : $data->DV_Trong_Luong[$i],
                "CustomerCode" => empty($data->CustomerCode2[$i]) ? config('constants.value.empty') : $data->CustomerCode2[$i],
                "ExpenseCatgCode" => empty($data->ExpenseCatgCode[$i]) ? config('constants.value.empty') : $data->ExpenseCatgCode[$i],
                "EmployeeCode1" => empty($data->EmployeeCode1[$i]) ? config('constants.value.empty') : $data->EmployeeCode1[$i],
                "DeptCode" => empty($data->DeptCode[$i]) ? config('constants.value.empty') : $data->DeptCode[$i],
                "BizDocId_PO" => empty($data->BizDocId_PO[$i]) ? config('constants.value.empty') : $data->BizDocId_PO[$i],
                "Hang_SX" => empty($data->Hang_SX[$i]) ? config('constants.value.empty') : $data->Hang_SX[$i],
                "OriginalAmount9" => $OriginalAmount9,
                "Amount9" => isset($data->Amount9[$i]) && !empty($data->Amount9[$i]) ? $data->Amount9[$i] : $OriginalAmount9,
                'BookingExchangeRate' => $data->ExchangeRate,
                "Note" => empty($data->Note[$i]) ? config('constants.value.empty') : $data->Note[$i],
            ];
            
            $connectCompany->table('B33AccDocJournalEntry')->insert($dataPODetail);

            if (!empty($data->TaxCode[$i])) {
                $paymentOrderDetail = $connectCompany->table('B33AccDocJournalEntry')
                ->where("Stt", $paymentOrder->Stt)->where("BuiltinOrder", $i + config('constants.number.one'))->first();
                $dataPODetailVAT = [
                    'Stt' => $paymentOrder->Stt,
                    'RowId_SourceDoc' => $paymentOrderDetail->RowId,
                    'BuiltinOrder' => $i + config('constants.number.one'),
                    "BranchCode" => $data->BranchCode,
                    "DocCode" => $data->DocCode,
                    "DocDate" => $data->DocDate,
                    'AtchDocDate' => $data->Ngay_Hd[$i],
                    'AtchDocNo' => $data->So_Hd[$i],
                    'OriginalAmountBeforeTax' => $OriginalAmount9,
                    'AmountBeforeTax' => isset($data->Amount9[$i]) && empty($data->Amount9[$i]) ? $data->Amount9[$i] : $OriginalAmount9,
                    'TaxCode' => $data->TaxCode[$i],
                    'TaxRate' => $data->TaxRate[$i],
                    'OriginalAmount' => $OriginalAmount3,
                    'Amount' => isset($data->Amount3[$i]) && !empty($data->Amount3[$i]) ? $data->Amount3[$i] : $OriginalAmount3,
                    'AtchDocType' => 'E3'
                ];
                $connectCompany->table('B33AccDocAtchDoc')->insert($dataPODetailVAT);
            }
        }
    }

    public function getRequestsForAdvances($request)
    {
        $B20Customer = DB::connection($request->company)->table('B20Customer')->select('Code', 'Address', 'Person', 'TaxRegNo', 'Name2', 'BankAccountNo', 'BankName', 'Name')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $B20Employee = DB::connection($request->company)->table('B20Employee')->select('Code', 'Name', 'Email', 'DeptCode')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $B33AccDoc = DB::connection($request->company)->table('B33AccDoc')->select('DocNo')
            ->where('DocCode', $request->DocCode)
            ->orderBy('Id', 'DESC')
            ->first();
        $B20Currency = DB::connection($request->company)->table('B20Currency')->select('Code', 'Name')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        $vB20Temporary = DB::connection($request->company)->table('vB20Temporary')->select('Code', 'Name')
            ->where('IsActive', config('constants.number.one'))
            ->where('IsGroup', config('constants.number.zero'))
            ->get();
        return array('B20Customer' => $B20Customer, 'B20Employee' => $B20Employee, 'DocNo' => $B33AccDoc->DocNo, 'B20Currency' => $B20Currency, 'vB20Temporary' => $vB20Temporary);
    }

    public function CreateRequestsForAdvances($connectCompany, $data)
    {
        $TotalAmount = isset($data->TotalAmount) ? $data->TotalAmount : $data->TotalOriginalAmount;
        $dataRFA = [
            "BranchCode" => $data->BranchCode,
            "DocStatus" => $data->DocStatus,
            "DocDate" => $data->DocDate,
            "DocNo" => $data->DocNo,
            "DocCode" => $data->DocCode,
            "CustomerCode" => $data->CustomerCode,
            "Description" => $data->Description,
            "Hinh_Thuc_TT" => $data->Hinh_Thuc_TT,
            "CurrencyCode" => $data->CurrencyCode,
            "ExchangeRate" => $data->ExchangeRate,
            "TotalOriginalAmount0" => $data->TotalOriginalAmount,
            "TotalAmount0" => $TotalAmount,
            "TotalOriginalAmount" => $data->TotalOriginalAmount,
            "TotalAmount" => $TotalAmount,
            "BankName" => isset($data->BankName) ? $data->BankName : config('constants.value.empty'),
            "BankAccountNo" => isset($data->BankAccountNo) ? $data->BankAccountNo : config('constants.value.empty'),
            "Ten_Chu_TK" => isset($data->Ten_Chu_TK) ? $data->Ten_Chu_TK : config('constants.value.empty'),
            "Description1" => isset($data->Description1) ? $data->Description1 : config('constants.value.empty'),
        ];
        $connectCompany->table('B33AccDoc')->insert($dataRFA);
        $RequestsForAdvances = $connectCompany->table('B33AccDoc')->where("DocNo", $data->DocNo)->first();
        
        for ($i = config('constants.number.zero'); $i < $data->CountRow; $i++) { 
            $OriginalAmount9 = empty($data->OriginalAmount9[$i]) ? config('constants.value.zero') : $data->OriginalAmount9[$i];
            $dataRFADetail = [
                "BranchCode" => $data->BranchCode,
                'Stt' => $RequestsForAdvances->Stt,
                "EmployeeCode" => $data->EmployeeCode,
                "DocDate" => $data->DocDate,
                "DocCode" => $data->DocCode,
                'BuiltinOrder' => $i + config('constants.number.one'),
                "Description" => empty($data->DescriptionDetail[$i]) ? config('constants.value.empty') : $data->DescriptionDetail[$i],
                "CustomerCode" => empty($data->CustomerCodeDetail[$i]) ? config('constants.value.empty') : $data->CustomerCodeDetail[$i],
                "TemporaryCode" => empty($data->TemporaryCode[$i]) ? config('constants.value.empty') : $data->TemporaryCode[$i],
                "Area" => empty($data->Area[$i]) ? config('constants.value.empty') : $data->Area[$i],
                "OriginalAmount9" => $OriginalAmount9,
                "Amount9" => isset($data->Amount9[$i]) && !empty($data->Amount9[$i]) ? $data->Amount9[$i] : $OriginalAmount9,
                "Note" => empty($data->Note[$i]) ? config('constants.value.empty') : $data->Note[$i],
                'BookingExchangeRate' => $data->ExchangeRate,
            ];
            
            $connectCompany->table('B33AccDocJournalEntry')->insert($dataRFADetail);
        }
    }

    public function statisticalAdmin()
    {
        foreach (config('constants.company') as $value) {
            $count[$value] = DB::connection($value)->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
            $part[$value] = DB::connection($value)->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
            $staff[$value] = DB::connection($value)->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        }

        return array(
            'count' => $count,
            'staff' => $staff,
            'part' => $part
        );
    }

    public function statisticalManage()
    {
        $user = Auth::user();
        $deptCode = json_decode($user->department->DeptCode);

        foreach (config('constants.company') as $value) {
            $count[$value] = DB::connection($value)->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
            $staff[$value] = DB::connection($value)->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        }

        return array(
            'count' => $count,
            'staff' => $staff
        );
    }
}
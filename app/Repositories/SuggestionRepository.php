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

    public function create($request)
    {
        
        $B20Customer = DB::connection($request->company)->table('B20Customer')->select('Code', 'Address', 'Person', 'TaxRegNo', 'Name2')
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

    public function store($data)
    {
        $dataHeader = [
            "BranchCode" => $data->BranchCode,
            "DocStatus" => $data->DocStatus,
            "DocDate" => $data->DocDate,
            "DocNo" => $data->DocNo,
            "DocCode" => $data->DocCode,
            "CustomerCode" => $data->CustomerCode1,
            "AmountTT" => $data->AmountTT,
            "Stt_TU" => $data->Stt_TU,
            "AmountTU" => $data->AmountTU,
            "Hinh_Thuc_TT" => $data->Hinh_Thuc_TT,
            "CurrencyCode" => $data->CurrencyCode,
            "ExchangeRate" => $data->ExchangeRate,
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

        DB::connection($data->BranchCode)->table('B33AccDoc')->insert($dataHeader);
        $paymentOrder = DB::connection($data->BranchCode)->table('B33AccDoc')->where("DocNo", $data->DocNo)->first();
        
        for ($i = config('constants.number.zero'); $i < count($data->So_Hd); $i++) { 
            $dataMain = [
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
                "OriginalAmount9" => empty($data->OriginalAmount9[$i]) ? config('constants.value.empty') : $data->OriginalAmount9[$i],
                "Amount9" => isset($data->Amount9[$i]) && empty($data->Amount9[$i]) ? $data->Amount9[$i] : config("constants.number.zero"),
                // "TaxCode" => $data->TaxCode[$i],
                // "TaxRate" => $data->TaxRate[$i],
                // "OriginalAmount3" => $data->OriginalAmount3[$i],
                // "Amount3" => $data->Amount3[$i],
                "Note" => empty($data->Note[$i]) ? config('constants.value.empty') : $data->Note[$i],
            ];
            DB::connection($data->BranchCode)->table('B33AccDocJournalEntry')->insert($dataMain);
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
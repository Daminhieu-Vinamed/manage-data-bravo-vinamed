<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentOrderRepository
{
    public function getData()
    {
        if (Auth::user()->role->code === config('constants.role.super_admin.code') || Auth::user()->role->code === config('constants.role.admin.code')) {
            $A11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
            $A12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
            $A14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
        }elseif (Auth::user()->role->code === config('constants.role.manage.code')) {
            $arrayDeptCode = json_decode(Auth::user()->department->DeptCode);
            $A11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->whereIn('Dept', $arrayDeptCode)->get();
            $A12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->whereIn('Dept', $arrayDeptCode)->get();
            $A14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->whereIn('Dept', $arrayDeptCode)->get();
        }else{
            $A11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->where('CreatedBy', '1194')->get();
            $A12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->where('CreatedBy', '1194')->get();
            $A14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->where('CreatedBy', '1194')->get();
        }
        return array('A11' => $A11, 'A12' => $A12, 'A14' => $A14);
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

    public function create($company)
    {
        $B20Customer = DB::connection($company)->table('B20Customer')->select('Code', 'Address', 'Person', 'TaxRegNo', 'Name2')
        ->where('IsActive', config('constants.number.one'))
        ->where('IsGroup', config('constants.number.zero'))
        ->get();
        $B20Employee = DB::connection($company)->table('B20Employee')->select('Code', 'Name', 'Email', 'DeptCode')
        ->where('IsActive', config('constants.number.one'))
        ->where('IsGroup', config('constants.number.zero'))
        ->get();
        $B20ExpenseCatg = DB::connection($company)->table('B20ExpenseCatg')->select('Code', 'Name')
        ->where('IsActive', config('constants.number.one'))
        ->where('IsGroup', config('constants.number.zero'))
        ->get();
        $B20Dept = DB::connection($company)->table('B20Dept')->select('Code', 'Name2')
        ->where('IsActive', config('constants.number.one'))
        ->where('IsGroup', config('constants.number.zero'))
        ->get();
        $B20Tax = DB::connection($company)->table('B20Tax')->select('Code', 'Name', 'Name2', 'Account', 'Rate')
        ->where('IsActive', config('constants.number.one'))
        ->where('IsGroup', config('constants.number.zero'))
        ->get();
        $B20Currency = DB::connection($company)->table('B20Currency')->select('Code', 'Name')
        ->where('IsActive', config('constants.number.one'))
        ->where('IsGroup', config('constants.number.zero'))
        ->get();
        $vB30BizDoc = DB::connection($company)->table('vB30BizDoc')->select('BizDocId', 'DocNo', 'DocInfo', 'EmployeeName', 'DocDate')
        ->where('DocCode', 'PO')
        ->where('DocDate', '<=', now())
        ->where('Post_TheKho', config('constants.number.one'))
        ->get();
        $vB33AccDoc_ExploreJournalEntry = DB::connection($company)->table('vB33AccDoc_ExploreJournalEntry')->select('Stt', 'DocNo', 'TotalAmount0', 'CustomerName', 'DocDate')
        ->where('IsActive', config('constants.number.one'))
        ->get();
        return array('bill_detailed_object' => $B20Customer, 'bill_staff' => $B20Employee, 'base_items' => $B20ExpenseCatg, 'bill_part' => $B20Dept, 'bill_tax_category' => $B20Tax, 'currency' => $B20Currency, 'bill_purchase_order' => $vB30BizDoc, 'requests_for_advances' => $vB33AccDoc_ExploreJournalEntry);
    }
}
<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentOrderRepository
{
    public function getData()
    {
        if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two')) {
            foreach (config('constants.company') as $company) {
                $paymentOrder = DB::connection($company)->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
                $paymentOrderTotal[$company] = $paymentOrder->toArray();
            }
        }elseif (Auth::user()->role->id === config('constants.number.three')) {
            $arrayDeptCode = json_decode(Auth::user()->department->DeptCode);
            foreach (config('constants.company') as $company) {
                $paymentOrder = DB::connection($company)->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $arrayDeptCode)->orderBy('DocDate', 'desc')->get();
                $paymentOrderTotal[$company] = $paymentOrder->toArray();
            }
        }
        return  $paymentOrderTotal;
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
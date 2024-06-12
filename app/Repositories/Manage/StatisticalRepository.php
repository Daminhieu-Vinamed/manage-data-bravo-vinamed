<?php

namespace App\Repositories\Manage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticalRepository
{   
    public function paymentOrder()
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

    public function onLeave() {

        $user = Auth::user();
        $deptCode = json_decode($user->department->DeptCode);
        
        foreach (config('constants.company') as $value) {
            $onLeave = DB::connection($value)->table('vB30HrmPTimesheet')
            ->where('IsActive', config('constants.number.one'))
            ->where('DocCode', 'NP')
            ->whereIn('DocStatus', ['35','36','37'])
            ->whereIn('DeptCode', $deptCode)
            ->get([
                DB::raw("LEFT(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [start]"),
                DB::raw("LEFT(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [end]"), 
                'EmployeeName as title',
                'EmployeeCode as code',
                'DeptName as department',
            ]);
            $onLeaveTotal[$value] = $onLeave->toArray();
        }
        $total = array_merge(
            $onLeaveTotal['A06'],
            $onLeaveTotal['A11'],
            $onLeaveTotal['A12'],
            $onLeaveTotal['A14'],
            $onLeaveTotal['A18'],
            $onLeaveTotal['A19'],
            $onLeaveTotal['A21'],
            $onLeaveTotal['A22'],
            $onLeaveTotal['A25'],
        );
        return $total;
    }

    public function additionalWork() 
    {
        $user = Auth::user();
        $deptCode = json_decode($user->department->DeptCode);
        
        foreach (config('constants.company') as $value) {
            $additionalWork = DB::connection($value)->table('vB30HrmPTimesheet')
            ->where('IsActive', config('constants.number.one'))
            ->where('DocCode', 'BS')
            ->whereIn('DocStatus', ['35','36','37'])
            ->whereIn('DeptCode', $deptCode)
            ->get([
                DB::raw("LEFT(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [start]"),
                DB::raw("LEFT(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [end]"), 
                'EmployeeName as title',
                'EmployeeCode as code',
                'DeptName as department',
            ]);
            $additionalWorkTotal[$value] = $additionalWork->toArray();
        }
        $total = array_merge(
            $additionalWorkTotal['A06'],
            $additionalWorkTotal['A11'],
            $additionalWorkTotal['A12'],
            $additionalWorkTotal['A14'],
            $additionalWorkTotal['A18'],
            $additionalWorkTotal['A19'],
            $additionalWorkTotal['A21'],
            $additionalWorkTotal['A22'],
            $additionalWorkTotal['A25'],
        );
        return $total;
    }
}
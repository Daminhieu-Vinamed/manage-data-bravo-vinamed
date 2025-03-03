<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdditionalWorkRepository
{
    public function getData($timeNow)
    {
        $additionalWorkTotal = array();
        if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two')) {
            foreach (config('constants.company') as $company) {
                $additionalWork = DB::connection($company)->table('vB30HrmPTimesheet')
                ->where('IsActive', config('constants.number.one'))
                ->where('DocCode', 'BS')
                ->where('DocStatus', '50')
                ->whereYear('FromDate',  $timeNow->format('Y'))
                ->get([
                    'BranchCode',
                    'EmployeeCode', 
                    'EmployeeName', 
                    'DeptName', 
                    'TimesheetTypeName', 
                    DB::raw("FORMAT(FromDate, 'dd-MM-yyyy') AS [start]"),
                    DB::raw("FORMAT(ToDate, 'dd-MM-yyyy') AS [end]"), 
                    'DocStatusName',
                    'DocCode',
                    'RowId',
                    'Description',
                ]);
                if(!empty($additionalWork->toArray())){
                    foreach ($additionalWork as $value) {
                         array_push($additionalWorkTotal, $value);
                    } 
                 }
            };
        }else {
            $arrEmployee = Auth::user()->children;
            $arrEmployee->push(Auth::user());
            foreach ($arrEmployee as $employee) {
                $additionalWork = DB::connection($employee->company)->table('vB30HrmPTimesheet')
                ->where('IsActive', config('constants.number.one'))
                ->where('DocCode', 'BS')
                ->where('DocStatus', '50')
                ->where('EmployeeCode', $employee->EmployeeCode)
                ->whereYear('FromDate',  $timeNow->format('Y'))
                ->get([
                    'BranchCode',
                    'EmployeeCode',
                    'EmployeeName',
                    'DeptName',
                    'TimesheetTypeName',
                    'DeptCode',
                    DB::raw("FORMAT(FromDate, 'dd-MM-yyyy') AS [start]"),
                    DB::raw("FORMAT(ToDate, 'dd-MM-yyyy') AS [end]"),
                    'DocStatusName',
                    'DocCode',
                    'RowId',
                    'Description',
                ]);
                if(!empty($additionalWork->toArray())){
                   foreach ($additionalWork as $value) {
                        array_push($additionalWorkTotal, $value);
                   } 
                }
            };
        }
        return $additionalWorkTotal;
    }

    public function calendar() 
    {
        foreach (config('constants.company') as $value) {
            $additionalWork = DB::connection($value)->table('vB30HrmPTimesheet')
            ->where('IsActive', config('constants.number.one'))
            ->where('DocCode', 'BS')
            ->where('DocStatus', '51')
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
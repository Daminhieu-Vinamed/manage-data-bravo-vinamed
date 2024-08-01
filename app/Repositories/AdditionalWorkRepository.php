<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdditionalWorkRepository
{
    public function getData($timeNow)
    {
        if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two')) {
            foreach (config('constants.company') as $value) {
                $additionalWork = DB::connection($value)->table('vB30HrmPTimesheet')
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
                $additionalWorkTotal[$value] = $additionalWork->toArray();
            };
        }elseif (Auth::user()->role->id === config('constants.number.three')) {
            $arrayDeptCode = json_decode(Auth::user()->department->DeptCode);
            foreach (config('constants.company') as $value) {
                $additionalWork = DB::connection($value)->table('vB30HrmPTimesheet')
                ->where('IsActive', config('constants.number.one'))
                ->where('DocCode', 'BS')
                ->where('DocStatus', '50')
                ->whereIn('DeptCode', $arrayDeptCode)
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
                $additionalWorkTotal[$value] = $additionalWork->toArray();
            };
        }elseif (Auth::user()->role->id === config('constants.number.four')) {
            $arrayDeptCode = json_decode(Auth::user()->department->DeptCode);
            foreach (config('constants.company') as $value) {
                $additionalWork = DB::connection($value)->table('vB30HrmPTimesheet')
                ->where('IsActive', config('constants.number.one'))
                ->where('DocCode', 'BS')
                ->where('DocStatus', '50')
                ->where('IsTP', '<>', config('constants.number.one'))
                ->whereIn('DeptCode', $arrayDeptCode)
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
                $additionalWorkTotal[$value] = $additionalWork->toArray();
            };
        }
        return $additionalWorkTotal;
    }

    public function approveLeave($connectCompany, $RowId, $DocCode)
    {
        return $connectCompany->update('EXEC Usp_ApproveBSNP ?, ?', [$RowId, $DocCode]);
    }
    
    public function cancelLeave($connectCompany, $RowId)
    {
        return $connectCompany->update('EXEC Usp_CancelBSNP ?', [$RowId]);
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
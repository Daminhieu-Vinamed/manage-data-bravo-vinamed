<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnLeaveRepository
{
    public function getData($timeNow)
    {
        if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two')) {
            foreach (config('constants.company') as $value) {
                $onLeave = DB::connection($value)->table('vB30HrmPTimesheet')
                ->where('IsActive', config('constants.number.one'))
                ->where('DocCode', 'NP')
                ->where('DocStatus', '19')
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
                $onLeaveTotal[$value] = $onLeave->toArray();
            };
        }elseif (Auth::user()->role->id === config('constants.number.three')) {
            $arrayDeptCode = json_decode(Auth::user()->department->DeptCode);
            foreach (config('constants.company') as $value) {
                $onLeave = DB::connection($value)->table('vB30HrmPTimesheet')
                ->where('IsActive', config('constants.number.one'))
                ->where('DocCode', 'NP')
                ->where('DocStatus', '19')
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
                $onLeaveTotal[$value] = $onLeave->toArray();
            };
        }elseif (Auth::user()->role->id === config('constants.number.four')) {
            $arrayDeptCode = json_decode(Auth::user()->department->DeptCode);
            foreach (config('constants.company') as $value) {
                $onLeave = DB::connection($value)->table('vB30HrmPTimesheet')
                ->where('IsActive', config('constants.number.one'))
                ->where('DocCode', 'NP')
                ->where('DocStatus', '19')
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
                $onLeaveTotal[$value] = $onLeave->toArray();
            };
        }
        return $onLeaveTotal;
    }

    public function calendar() 
    {
        foreach (config('constants.company') as $value) {
            $onLeave = DB::connection($value)->table('vB30HrmPTimesheet')
            ->where('IsActive', config('constants.number.one'))
            ->where('DocCode', 'NP')
            ->whereIn('DocStatus', ['35','36','37'])
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
}
<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Facades\DB;

class AdditionalWorkRepository
{
    public function getData($timeNow)
    {
        foreach (config('constants.company') as $value) {
            $onLeave = DB::connection($value)->table('vB30HrmPTimesheet')
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
                'RowId'
            ]);
            $onLeaveTotal[$value] = $onLeave->toArray();
        };
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

    public function approveLeave($connectCompany, $RowId, $DocCode)
    {
        return $connectCompany->update('EXEC Usp_ApproveBSNP ?, ?', [$RowId, $DocCode]);
    }
    
    public function cancelLeave($connectCompany, $RowId)
    {
        return $connectCompany->update('EXEC Usp_CancelBSNP ?', [$RowId]);
    }
}
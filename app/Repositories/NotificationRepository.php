<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationRepository
{
    public function getData() {
        $notifications = Auth::user()->notifications;
        return $notifications;
    }

    public function getDataAdditionalWorkAndOnLeave($timeNow, $id)
    {
        $user = User::find($id);
        $additionalWorkAndOnLeave = DB::connection($user->company)->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->whereIn('DocCode', ['NP', 'BS'])
        ->whereIn('DocStatus', ['19', '50'])
        ->where('EmployeeCode', $user->EmployeeCode)
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
        return $additionalWorkAndOnLeave->toArray();
    }
}
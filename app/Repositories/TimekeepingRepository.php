<?php

namespace App\Repositories;

use App\Models\User;
use App\Notifications\AdditionalWorkAndOnLeaveNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimekeepingRepository
{
    public function getData($EmployeeCode, $company, $timeNow)
    {
        $np = DB::connection($company)->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->where('EmployeeCode', $EmployeeCode)
        ->get([
            DB::raw("LEFT(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [start]"),
            DB::raw("LEFT(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [end]"), 
            'VAC_Name as title',
            'TimesheetTypeName as type',
            'DocStatus as status'
        ]);
        $bs = DB::connection($company)->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'BS')
        ->where('EmployeeCode', $EmployeeCode)
        ->get([
            DB::raw("LEFT(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(FromDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [start]"),
            DB::raw("LEFT(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt'), LEN(FORMAT(ToDate, 'yyyy-MM-dd hh:mm:ss tt')) - 3) AS [end]"), 
            'VAC_Name as title',
            'TimesheetTypeName as type',
            'DocStatus as status'
        ]);
        $labour = DB::connection($company)->table('vB30HrmCheckInOut')->where('EmployeeCodeCC', $EmployeeCode)->where('IsActive', config('constants.number.one'))->get(['CheckTime as start']);
        $dataCalendar = array_merge($bs->toArray(), $np->toArray(), $labour->toArray());
        $dataArr['dataCalendar'] = $dataCalendar;
        
        //Lấy dữ liệu nghỉ phép và bổ sung
        $npVsBs = DB::connection($company)->table('vB20HRMTimesheetType')
        ->where('IsActive', config('constants.number.one'))
        ->get(['RowId', 'Name', 'WorkDay']);
        $dataArr['npVsBs'] = $npVsBs;
        
        //Kiểm tra và lấy thời gian bắt đầu
        $startTime = DB::connection($company)->table('vB30HrmCheckInOut')
        ->select('checkTime as start')
        ->whereDate('CheckTime', $timeNow->format('Y-m-d'))
        ->where('EmployeeCodeCC', $EmployeeCode)
        ->where('IsActive', config('constants.number.one'))
        ->orderBy('CheckTime', 'ASC')
        ->first();
        if ($startTime !== config('constants.value.null')) {
            $dataArr['start'] = $startTime->start;
        }
        
        //Kiểm tra và lấy thời gian kết thúc
        $count = DB::connection($company)->table('vB30HrmCheckInOut')
        ->whereDate('CheckTime', $timeNow->format('Y-m-d'))
        ->where('IsActive', config('constants.number.one'))
        ->where('EmployeeCodeCC', $EmployeeCode)
        ->count();
        if ($count >= config('constants.number.two')) {
            $endTime = DB::connection($company)->table('vB30HrmCheckInOut')
            ->select('checkTime as end')
            ->whereDate('CheckTime', $timeNow->format('Y-m-d'))
            ->where('EmployeeCodeCC', $EmployeeCode)
            ->where('IsActive', config('constants.number.one'))
            ->orderBy('CheckTime', 'DESC')
            ->first();
            $dataArr['end'] = $endTime->end;
        }
        
        return $dataArr;
    }

    public function timekeeping($connectCompany, $Timekeeping, $EmployeeCode, $company) {
        return $connectCompany->update('EXEC usp_B30HrmCheckInOut_Tuandh ?, ?, ?', [$Timekeeping, $EmployeeCode, $company]);
    }

    public function additionalWork($connectCompany, $EmployeeCode, $company, $type, $start, $end, $description) {
        $user = Auth::user();
        $userManager = User::where('department_code', $user->department_code)->where('role_id', config('constants.number.four'))->first();
        $userManager->notify(new AdditionalWorkAndOnLeaveNotification($user));
        return $connectCompany->update('EXEC usp_ERP_BSCong_Tuandh ?, ?, ?, ?, ?, ?', [$EmployeeCode, $company, $type, $start, $end, $description]);
    }
}
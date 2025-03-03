<?php

namespace App\Repositories;

use App\Models\DeviceInfo;
use App\Models\Locate;
use App\Models\User;
use App\Notifications\AdditionalWorkAndOnLeaveNotification;
use App\Repositories\BaseRepository\AbstractRepository;
use Illuminate\Support\Facades\DB;

class TimekeepingRepository extends AbstractRepository
{
    protected function model(): string
    {
        return Locate::class;
    }
    
    public function getData($EmployeeCode, $company)
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
            'DocStatus as status',
            'RowId as RowId',
            'BranchCode as BranchCode',
            'WorkDay as workday'
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
            'DocStatus as status',
            'RowId as RowId',
            'BranchCode as BranchCode',
            'WorkDay as workday'
        ]);
        
        $labour = DB::connection($company)->table('vB30HrmCheckInOut')
        ->selectRaw('MIN(CheckTime) AS [start], MAX(CheckTime) AS [end]')
        ->where('EmployeeCodeCC', $EmployeeCode)
        ->where('IsActive', config('constants.number.one'))
        ->groupBy(DB::raw('DAY(CheckTime), MONTH(CheckTime), YEAR(CheckTime)'))
        ->get();
        
        $dataCalendar = array_merge($bs->toArray(), $np->toArray(), $labour->toArray());
        $data['dataCalendar'] = $dataCalendar;
        
        //Lấy dữ liệu nghỉ phép và bổ sung
        $npVsBs = DB::connection($company)->table('vB20HRMTimesheetType')
        ->where('IsActive', config('constants.number.one'))
        ->get(['RowId', 'Name', 'WorkDay']);
        $data['npVsBs'] = $npVsBs;

        $Vacation = DB::connection($company)->table('vB30HrmPTimesheet')->where('EmployeeCode', $EmployeeCode)->orderByDesc('Date')->first(['Vacation']);
        $data['vacation'] = $Vacation == config('constants.value.null') ? config('constants.number.zero') : floatval($Vacation->Vacation);
        
        return $data;
    }

    public function getStartTimeAndEndTimeInTimekeeping($EmployeeCode, $company, $timeNow) 
    {
        //Kiểm tra và lấy thời gian bắt đầu
        $startTime = DB::connection($company)->table('vB30HrmCheckInOut')
        ->select('checkTime as start')
        ->whereDate('CheckTime', $timeNow->format('Y-m-d'))
        ->where('EmployeeCodeCC', $EmployeeCode)
        ->where('IsActive', config('constants.number.one'))
        ->orderBy('CheckTime', 'ASC')
        ->first();
        
        if ($startTime !== config('constants.value.null')) {
            $data['start'] = $startTime->start;
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
            $data['end'] = $endTime->end;
        }

        $data['now'] = $timeNow->format('Y-m-d H:i:s');
        
        return $data;
    }

    public function timekeeping($connectCompany, $Timekeeping, $EmployeeCode, $company, $userId, $device, $platform, $browser, $version, $type
    // $lat, $lng, $distance, $type
    ) {
        // $this->create([
        //     'user_id' => $userId,
        //     'latitude' => $lat,
        //     'longitude' => $lng,
        //     'distance' => $distance,
        //     'type' => $type,
        // ]);
        DeviceInfo::create([
            'user_id' => $userId,
            'device' => $device,
            'platform' => $platform,
            'browser' => $browser,
            'version' => $version,
            'type' => $type,
        ]);
        return $connectCompany->update('EXEC usp_B30HrmCheckInOut_Tuandh ?, ?, ?', [$Timekeeping, $EmployeeCode, $company]);
    }

    public function additionalWork($connectCompany, $user, $type, $start, $end, $description) {
        if (!empty($user->parent)) {
            $userManager = User::find($user->parent->id);
            $userManager->notify(new AdditionalWorkAndOnLeaveNotification($user));
        }
        return $connectCompany->update('EXEC usp_ERP_BSCong_Tuandh ?, ?, ?, ?, ?, ?', [$user->EmployeeCode, $user->company, $type, $start, $end, $description]);
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
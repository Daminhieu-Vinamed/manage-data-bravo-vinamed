<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class TimekeepingRepository
{
    public function getData($EmployeeCode, $company, $timeNow)
    {
        $typeOfAdditionalWork = DB::connection($company)->table('vB20HRMTimesheetType')->where('IsActive', config('constants.number.one'))->get(['RowId', 'Name', 'WorkDay']);
        $data = DB::connection($company)->table('vB30HrmCheckInOut')->where('EmployeeCodeCC', $EmployeeCode)->where('IsActive', config('constants.number.one'))->get(['CheckTime as start']);
        $countTimekeeping = DB::connection($company)->table('vB30HrmCheckInOut')->whereDate('CheckTime', $timeNow->format('Y-m-d'))->where('EmployeeCodeCC', $EmployeeCode)->count();
        $starTime = DB::connection($company)->table('vB30HrmCheckInOut')->select('checkTime as start')->whereDate('CheckTime', $timeNow->format('Y-m-d'))->where('EmployeeCodeCC', $EmployeeCode)->orderBy('CheckTime', 'ASC')->first();
        $dataArr['listTimekeeping'] = $data;
        $dataArr['typeOfAdditionalWork'] = $typeOfAdditionalWork;
        if ($starTime !== config('constants.value.null')) {
            $dataArr['start'] = $starTime->start;
        }
        if ($countTimekeeping == config('constants.number.two')) {
            $endTime = DB::connection($company)->table('vB30HrmCheckInOut')->select('checkTime as end')->whereDate('CheckTime', $timeNow->format('Y-m-d'))->where('EmployeeCodeCC', $EmployeeCode)->orderBy('CheckTime', 'DESC')->first();
            $dataArr['end'] = $endTime->end;
        }
        return $dataArr;
    }

    public function timekeeping($connectCompany, $Timekeeping, $EmployeeCode, $company) {
        return $connectCompany->update('EXEC usp_B30HrmCheckInOut_Tuandh ?, ?, ?', [$Timekeeping, $EmployeeCode, $company]);
    }

    public function additionalWork($connectCompany, $EmployeeCode, $company, $type, $start, $end) {
        return $connectCompany->update('EXEC usp_ERP_BSCong_Tuandh ?, ?, ?, ?, ?', [$EmployeeCode, $company, $type, $start, $end]);
    }
}
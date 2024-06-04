<?php

namespace App\Repositories;

use App\Models\Timekeeping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimekeepingRepository
{
    public function getData($EmployeeCode, $company, $timeNow)
    {
        $data = DB::connection($company)->table('vB30HrmCheckInOut')->where('EmployeeCodeCC', $EmployeeCode)->get(['CheckTime as start']);
        $countTimekeeping = DB::connection($company)->table('vB30HrmCheckInOut')->whereDate('CheckTime', $timeNow->format('Y-m-d'))->where('EmployeeCodeCC', $EmployeeCode)->count();
        $starTime = DB::connection($company)->table('vB30HrmCheckInOut')->select('checkTime as start')->whereDate('CheckTime', $timeNow->format('Y-m-d'))->where('EmployeeCodeCC', $EmployeeCode)->orderBy('CheckTime', 'ASC')->first();
        $dataArr['listTimekeeping'] = $data;
        $dataArr['start'] = $starTime->start;
        if ($countTimekeeping == config('constants.number.two')) {
            $endTime = DB::connection($company)->table('vB30HrmCheckInOut')->select('checkTime as end')->whereDate('CheckTime', $timeNow->format('Y-m-d'))->where('EmployeeCodeCC', $EmployeeCode)->orderBy('CheckTime', 'DESC')->first();
            $dataArr['end'] = $endTime->end;
        }
        
        return $dataArr;
    }
}
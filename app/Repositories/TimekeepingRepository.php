<?php

namespace App\Repositories;

use App\Models\Timekeeping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimekeepingRepository
{
    public function getData($EmployeeCode, $timeNow)
    {
        $data = Timekeeping::where('EmployeeCode_user', $EmployeeCode)->get(['start', 'end']);
        $timekeepingToday = Timekeeping::whereDate('start', $timeNow->format('Y-m-d'))->where('EmployeeCode_user', $EmployeeCode)->first();
        return array($data, $timekeepingToday);
    }
}
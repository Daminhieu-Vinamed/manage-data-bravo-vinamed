<?php

namespace App\Http\Controllers;

use App\Models\Timekeeping;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TimekeepingController extends Controller
{
    public function list()
    {
        if(request()->ajax()) {
            $data = Timekeeping::where('EmployeeCode_user', Auth::user()->EmployeeCode)->get(['EmployeeCode_user','start', 'end', 'title']);
            return Response::json($data);
        }
        $timeNow = new Carbon();
        $timekeepingToday = Timekeeping::whereDate('start', $timeNow->format('Y-m-d'))->where('EmployeeCode_user', Auth::user()->EmployeeCode)->first();
        $StandardClockIn = config('constants.timekeeping.clock_in');
        $StandardClockOut = config('constants.timekeeping.clock_out');
        return view('timekeeping.list', compact('timekeepingToday', 'StandardClockIn', 'StandardClockOut'));
    }

    public function clockIn() {
        $clockIn = new Carbon();
        $standardTimeClockIn = $clockIn->createFromFormat('H:i:s', config('constants.timekeeping.clock_in'));
        $timekeeping = new Timekeeping();
        $timekeeping->EmployeeCode_user = Auth::user()->EmployeeCode;
        $timekeeping->start = $clockIn;
        if ($clockIn->greaterThan($standardTimeClockIn)) {
            $lateTime = $clockIn->diff($standardTimeClockIn);
            if (!empty($lateTime->h)) {
                $timekeeping->title = 'Đi trễ: ' . $lateTime->h . ' tiếng ' . $lateTime->i . ' phút ' . $lateTime->s . ' giây';
            }else{
                $timekeeping->title = 'Đi trễ: ' . $lateTime->i . ' phút ' . $lateTime->s . ' giây';
            }
        }
        $timekeeping->save();
        return response()->json(['status' => 'success', 'msg' => 'Đã chấm công !', 'clockIn' => $clockIn->format('H:i:s')], 200);
    }
    
    public function clockOut() {
        $clockOut = new Carbon();
        $timekeeping = Timekeeping::whereDate('start', $clockOut->format('Y-m-d'))->where('EmployeeCode_user', Auth::user()->EmployeeCode)->first();
        $timekeeping->end = $clockOut;
        $timekeeping->save();
        return response()->json(['status' => 'success', 'msg' => 'Kết thúc chấm công !', 'clockOut' => $clockOut->format('H:i:s')], 200);
    }
}
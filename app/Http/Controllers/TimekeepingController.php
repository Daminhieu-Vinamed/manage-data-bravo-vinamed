<?php

namespace App\Http\Controllers;

use App\Http\Requests\Timekeeping\additionalWork;
use App\Models\Timekeeping;
use App\Services\TimekeepingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class TimekeepingController extends Controller
{
    protected TimekeepingService $timekeepingService;

    public function __construct(TimekeepingService $timekeepingService)
    {
        $this->timekeepingService = $timekeepingService;
    }

    public function list()
    {
        $data = $this->timekeepingService->list();
        if(request()->ajax()) {
            return Response::json($data[config('constants.number.one')]);
        }
        $timeNow = $data[config('constants.number.zero')];
        $timekeepingToday = $data[config('constants.number.two')];
        return view('timekeeping.list', compact('timekeepingToday', 'timeNow'));
    }

    public function clockIn() {
        return $this->timekeepingService->clockIn();
    }
    
    public function clockOut() {
        return $this->timekeepingService->clockOut();
    }

    public function additionalWork(additionalWork $request) {
        dd($request->all());
    }
}
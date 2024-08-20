<?php

namespace App\Http\Controllers;

use App\Http\Requests\Timekeeping\SupplementsAndLeaveRequest;
use App\Services\TimekeepingService;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class TimekeepingController extends Controller
{
    protected TimekeepingService $timekeepingService;

    public function __construct(TimekeepingService $timekeepingService)
    {
        $this->timekeepingService = $timekeepingService;
    }

    public function calendar()
    {
        try {
            $data = $this->timekeepingService->calendar();
            if(request()->ajax()) {
                return Response::json($data['dataCalendar']);
            }
            return view('timekeeping.calendar', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function clockIn() {
        return $this->timekeepingService->clockIn();
    }
    
    public function clockOut() {
        return $this->timekeepingService->clockOut();
    }

    public function supplementsAndLeave(SupplementsAndLeaveRequest $request) {
        return $this->timekeepingService->supplementsAndLeave($request);
    }

    public function approve(Request $request)
    {
        return $this->timekeepingService->approve($request);
    }
    
    public function cancel(Request $request)
    {
        return $this->timekeepingService->cancel($request);
    }
}
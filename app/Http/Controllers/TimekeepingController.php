<?php

namespace App\Http\Controllers;

use App\Http\Requests\Timekeeping\additionalWork;
use App\Services\TimekeepingService;
use Illuminate\Support\Facades\Response;

class TimekeepingController extends Controller
{
    protected TimekeepingService $timekeepingService;

    public function __construct(TimekeepingService $timekeepingService)
    {
        $this->timekeepingService = $timekeepingService;
    }

    public function list()
    {
        try {
            $data = $this->timekeepingService->list();
            if(request()->ajax()) {
                return Response::json($data['listTimekeeping']);
            }
            return view('timekeeping.list', compact('data'));
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

    public function additionalWork(additionalWork $request) {
        dd($request->all());
    }
}
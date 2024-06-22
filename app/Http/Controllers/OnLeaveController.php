<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OnLeaveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OnLeaveController extends Controller
{
    protected OnLeaveService $onLeaveService;

    public function __construct(OnLeaveService $onLeaveService)
    {
        $this->onLeaveService = $onLeaveService;
    }

    public function list()
    {
        return view('on-leave.list');
    }

    public function getData()
    {
        return $this->onLeaveService->listData();
    }
    
    public function approve(Request $request)
    {
        return $this->onLeaveService->approve($request);
    }
    
    public function cancel(Request $request)
    {
        return $this->onLeaveService->cancel($request);
    }

    public function calendar()
    {
        $additionalWork = $this->onLeaveService->calendar();
        if(request()->ajax()) {
            return Response::json($additionalWork);
        }
        return view('on-leave.calendar');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\OnLeaveService;
use Illuminate\Http\Request;

class OnLeaveController extends Controller
{
    protected OnLeaveService $onLeaveService;

    public function __construct(OnLeaveService $onLeaveService)
    {
        $this->onLeaveService = $onLeaveService;
    }

    public function list()
    {
        return view('on-leave.admin');
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
}
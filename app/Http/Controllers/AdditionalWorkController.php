<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AdditionalWorkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdditionalWorkController extends Controller
{
    protected AdditionalWorkService $additionalWorkService;

    public function __construct(AdditionalWorkService $additionalWorkService)
    {
        $this->additionalWorkService = $additionalWorkService;
    }

    public function list()
    {
        return view('additional-work.list');
    }

    public function getData()
    {
        return $this->additionalWorkService->listData();
    }
    
    public function approve(Request $request)
    {
        return $this->additionalWorkService->approve($request);
    }
    
    public function cancel(Request $request)
    {
        return $this->additionalWorkService->cancel($request);
    }

    public function calendar()
    {
        $onLeave = $this->additionalWorkService->calendar();
        if(request()->ajax()) {
            return Response::json($onLeave);
        }
        return view('additional-work.calendar');
    }
}
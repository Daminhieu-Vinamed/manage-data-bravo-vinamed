<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdditionalWorkService;
use Illuminate\Http\Request;

class AdditionalWorkController extends Controller
{
    protected AdditionalWorkService $additionalWorkService;

    public function __construct(AdditionalWorkService $additionalWorkService)
    {
        $this->additionalWorkService = $additionalWorkService;
    }

    public function list()
    {
        return view('additional-work.admin');
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
}
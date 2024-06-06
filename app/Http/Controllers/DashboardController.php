<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    
    public function welcome()
    {
        return view('welcome');
    }

    public function statisticalAdmin()
    {
        $statistical = $this->dashboardService->statisticalAdmin();
        if(request()->ajax()) {
            return Response::json($statistical['additionalWorkAll']);
        }
        return view('dashboard.admin', compact('statistical'));
    }
    
    public function statisticalManage()
    {
        $statistical = $this->dashboardService->statisticalManage();
        return view('dashboard.manage', compact('statistical'));
    }
}
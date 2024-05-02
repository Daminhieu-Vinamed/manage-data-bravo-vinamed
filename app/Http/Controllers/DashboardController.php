<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function statisticalAdmin()
    {
        $statistical = $this->dashboardService->statisticalAdmin();
        return view('dashboard.admin', compact('statistical'));
    }
    
    public function statisticalManage()
    {
        $statistical = $this->dashboardService->statisticalManage();
        return view('dashboard.manage', compact('statistical'));
    }
}
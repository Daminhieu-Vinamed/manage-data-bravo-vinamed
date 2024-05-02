<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
use Illuminate\Support\Facades\Auth;

class DashboardService extends DashboardRepository
{
    protected DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function statisticalAdmin()
    {
        $statisticalHead = $this->dashboardRepository->statisticalAdmin();
        $countAll = array_sum($statisticalHead);
        $statisticalHead['countAll'] = $countAll;
        return $statisticalHead;
    }
    
    public function statisticalManage()
    {
        $user = Auth::user();
        $statisticalHead = $this->dashboardRepository->statisticalManager($user->deptCode);
        $countAll = array_sum($statisticalHead);
        $statisticalHead['countAll'] = $countAll;
        return $statisticalHead;
    }
}
<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService extends DashboardRepository
{
    protected DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function statistical()
    {
        $statisticalHead = $this->dashboardRepository->statisticalHead();
        $countAll = array_sum($statisticalHead);
        $statisticalHead['countAll'] = $countAll;
        return $statisticalHead;
    }
}
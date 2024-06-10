<?php

namespace App\Services\Manage;

use App\Repositories\Manage\StatisticalRepository;

class StatisticalService extends StatisticalRepository
{
    protected StatisticalRepository $statisticalRepository;

    public function __construct(StatisticalRepository $statisticalRepository)
    {
        $this->statisticalRepository = $statisticalRepository;
    }

    public function paymentOrder()
    {
        $statisticalHead = $this->statisticalRepository->paymentOrder();
        $countAll = array_sum($statisticalHead);
        $statisticalHead['countAll'] = $countAll;
        return $statisticalHead;
    }
    
    public function onLeave()
    {
        return $this->statisticalRepository->onLeave();
    }
}
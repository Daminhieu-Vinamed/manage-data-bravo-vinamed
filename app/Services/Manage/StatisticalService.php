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
        $paymentOrder = $this->statisticalRepository->paymentOrder();
        $countAll = array_sum($paymentOrder['count']);
        $paymentOrder['count-total'] = $countAll;
        return $paymentOrder;
    }
    
    public function onLeave()
    {
        return $this->statisticalRepository->onLeave();
    }

    public function additionalWork()
    {
        return $this->statisticalRepository->additionalWork();
    }
}
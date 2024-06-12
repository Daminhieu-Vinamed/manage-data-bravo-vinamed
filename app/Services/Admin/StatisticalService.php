<?php

namespace App\Services\Admin;

use App\Repositories\Admin\StatisticalRepository;
use Illuminate\Support\Facades\Auth;

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
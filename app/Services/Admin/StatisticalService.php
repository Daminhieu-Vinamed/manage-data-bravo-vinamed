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
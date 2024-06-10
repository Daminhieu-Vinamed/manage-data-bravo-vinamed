<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\StatisticalService;
use Illuminate\Support\Facades\Response;

class StatisticalController extends Controller
{
    protected StatisticalService $statisticalService;

    public function __construct(StatisticalService $statisticalService)
    {
        $this->statisticalService = $statisticalService;
    }

    public function paymentOrder()
    {
        $statistical = $this->statisticalService->paymentOrder();
        return view('statistical.manage.payment-order', compact('statistical'));
    }

    public function onLeave()
    {
        $onLeave = $this->statisticalService->onLeave();
        if(request()->ajax()) {
            return Response::json($onLeave);
        }
        return view('statistical.manage.on-leave');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentOrder\ChooseCompanyRequest;
use App\Http\Requests\Admin\PaymentOrder\PaymentOrderRequest;
use App\Services\Admin\PaymentOrderService;
use Illuminate\Http\Request;

class PaymentOrderController extends Controller
{

    protected PaymentOrderService $paymentOrderService;

    public function __construct(PaymentOrderService $paymentOrderService)
    {
        $this->paymentOrderService = $paymentOrderService;
    }

    public function list()
    {
        return view('admin.payment-order.list');
    }

    public function getData()
    {
        return $this->paymentOrderService->getData();
    }

    public function approve(Request $request)
    {
        return $this->paymentOrderService->approve($request);
    }

    public function cancelPaymentRequest(PaymentOrderRequest $request)
    {
        return $this->paymentOrderService->cancel($request);
    }

    public function chooseCompany() {
        return view('admin.payment-order.choose-company');
    }

    public function create(ChooseCompanyRequest $request)
    {
        try {
            $data = $this->paymentOrderService->create($request);
            return view('admin.payment-order.create', compact('data'));
        } catch (\Exception $e) {
            $route = 'admin.dashboard';
            return view('404', compact('route'));
        }
    }
}
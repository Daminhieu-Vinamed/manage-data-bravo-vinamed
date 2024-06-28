<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentOrder\ChooseCompanyRequest;
use App\Http\Requests\PaymentOrder\PaymentOrderRequest;
use App\Services\PaymentOrderService;
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
        return view('payment-order.list');
    }

    public function getData()
    {
        return $this->paymentOrderService->getData();
    }

    public function approve(Request $request)
    {
        return $this->paymentOrderService->approve($request);
    }

    public function cancel(PaymentOrderRequest $request)
    {
        return $this->paymentOrderService->cancel($request);
    }

    public function chooseCompany()
    {
        return view('payment-order.choose-company');
    }

    public function create(ChooseCompanyRequest $request)
    {
        try {
            $data = $this->paymentOrderService->create($request);
            return view('payment-order.create', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function store(Request $request)
    {
        $this->paymentOrderService->store($request);
    }

    public function statistical()
    {
        try {
            $statistical = $this->paymentOrderService->statistical();
            return view('payment-order.statistical', compact('statistical'));
        } catch (\Exception $e) {
            return view('404');
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\paymentOrderRequest;
use App\Services\PaymentOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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

    public function cancelPaymentRequest(paymentOrderRequest $request)
    {
        return $this->paymentOrderService->cancel($request);
    }
}

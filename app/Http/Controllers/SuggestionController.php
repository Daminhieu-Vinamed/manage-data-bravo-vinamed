<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suggestion\ChooseCompanyRequest;
use App\Http\Requests\Suggestion\CancelPaymentOrderRequest;
use App\Http\Requests\Suggestion\CreatePaymentOrderRequest;
use App\Services\SuggestionService;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{

    protected SuggestionService $suggestionService;

    public function __construct(SuggestionService $suggestionService)
    {
        $this->suggestionService = $suggestionService;
    }

    public function list()
    {
        return view('suggestion.list');
    }

    public function getData()
    {
        return $this->suggestionService->getData();
    }

    public function approve(Request $request)
    {
        return $this->suggestionService->approve($request);
    }

    public function cancel(CancelPaymentOrderRequest $request)
    {
        return $this->suggestionService->cancel($request);
    }

    public function chooseCompany()
    {
        return view('suggestion.choose-company');
    }

    public function directional(ChooseCompanyRequest $request)
    {
        if ($request->DocCode === "TT") {
            return redirect()->route('suggestion.payment-order', ['company' => $request->company, 'DocCode' => $request->DocCode]);
        } elseif ($request->DocCode === "TG") {
            return redirect()->route('suggestion.requests-for-advances', ['company' => $request->company, 'DocCode' => $request->DocCode]);
        } elseif ($request->DocCode === "CC") {
            return redirect()->route('suggestion.suggested-per-diem', ['company' => $request->company, 'DocCode' => $request->DocCode]);
        }else{
            return view('404');
        }
    }

    public function paymentOrder(ChooseCompanyRequest $request)
    {
        try {
            $data = $this->suggestionService->create($request);
            return view('suggestion.payment-order', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function requestsForAdvances(ChooseCompanyRequest $request)
    {
        try {
            $data = $this->suggestionService->create($request);
            return view('suggestion.requests-for-advances', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }
    public function suggestedPerDiem(ChooseCompanyRequest $request)
    {
        try {
            $data = $this->suggestionService->create($request);
            return view('suggestion.suggested-per-diem', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function store(CreatePaymentOrderRequest $request)
    {
        return $this->suggestionService->store($request);
    }

    public function statistical()
    {
        try {
            $statistical = $this->suggestionService->statistical();
            return view('suggestion.statistical', compact('statistical'));
        } catch (\Exception $e) {
            return view('404');
        }
    }
}
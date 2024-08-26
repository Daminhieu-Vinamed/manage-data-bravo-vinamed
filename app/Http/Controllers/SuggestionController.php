<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suggestion\CancelPaymentOrderRequest;
use App\Http\Requests\Suggestion\ChooseCompanyCreateRequest;
use App\Http\Requests\Suggestion\ChooseCompanyListRequest;
use App\Http\Requests\Suggestion\CreatePaymentOrderRequest;
use App\Http\Requests\Suggestion\CreateRequestsForAdvancesRequest;
use App\Http\Requests\Suggestion\CreateSuggestedPerDiemRequest;
use App\Services\SuggestionService;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{

    protected SuggestionService $suggestionService;

    public function __construct(SuggestionService $suggestionService)
    {
        $this->suggestionService = $suggestionService;
    }

    public function list(Request $request)
    {
        $data = $this->suggestionService->getData($request->DocCode);
        return view('suggestion.list', compact('data'));
    }

    public function approve(Request $request)
    {
        return $this->suggestionService->approve($request);
    }

    public function cancel(CancelPaymentOrderRequest $request)
    {
        return $this->suggestionService->cancel($request);
    }

    public function chooseCompanyList()
    {
        return view('suggestion.choose-company-list');
    }

    public function directionalList(ChooseCompanyListRequest $request)
    {
        if ($request->DocCode === "TT" || $request->DocCode === "TG" || $request->DocCode === "CC") {
            return redirect()->route('suggestion.list', ['DocCode' => $request->DocCode]);
        }else{
            return view('404');
        }
    }
    
    public function chooseCompanyCreate()
    {
        return view('suggestion.choose-company-create');
    }
    
    public function directionalCreate(ChooseCompanyCreateRequest $request)
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

    public function getPaymentOrder(ChooseCompanyCreateRequest $request)
    {
        try {
            $data = $this->suggestionService->getPaymentOrder($request);
            return view('suggestion.create-payment-order', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }
    
    public function editPaymentOrder(Request $request)
    {
        try {
            $data = $this->suggestionService->editPaymentOrder($request);
            return view('suggestion.edit-payment-order', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }

    public function postPaymentOrder(CreatePaymentOrderRequest $request)
    {
        return $this->suggestionService->postPaymentOrder($request);
    }

    public function getRequestsForAdvances(ChooseCompanyCreateRequest $request)
    {
        try {
            $data = $this->suggestionService->getRequestsForAdvances($request);
            return view('suggestion.create-requests-for-advances', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }
    
    public function postRequestsForAdvances(CreateRequestsForAdvancesRequest $request)
    {
        return $this->suggestionService->postRequestsForAdvances($request);
    }
    
    public function getSuggestedPerDiem(ChooseCompanyCreateRequest $request)
    {
        try {
            $data = $this->suggestionService->getSuggestedPerDiem($request);
            return view('suggestion.create-suggested-per-diem', compact('data'));
        } catch (\Exception $e) {
            return view('404');
        }
    }
    
    public function postSuggestedPerDiem(CreateSuggestedPerDiemRequest $request)
    {   
        return $this->suggestionService->postSuggestedPerDiem($request);
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
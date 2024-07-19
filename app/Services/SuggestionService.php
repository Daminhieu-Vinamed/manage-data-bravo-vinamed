<?php

namespace App\Services;

use App\Repositories\SuggestionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SuggestionService extends SuggestionRepository
{
    protected SuggestionRepository $suggestionRepository;

    public function __construct(SuggestionRepository $suggestionRepository)
    {
        $this->suggestionRepository = $suggestionRepository;
    }

    public function getData()
    {
        $arrayDataCollect = $this->suggestionRepository->getData();
        $arrayData = array_merge(
            $arrayDataCollect["A06"],
            $arrayDataCollect["A11"],
            $arrayDataCollect["A12"], 
            $arrayDataCollect["A14"], 
            $arrayDataCollect["A18"], 
            $arrayDataCollect["A19"],
            $arrayDataCollect["A21"],
            $arrayDataCollect["A22"],
            $arrayDataCollect["A25"]
        );
        $collectData = collect($arrayData)->sortByDesc('DocDate')->all();
        return $collectData;
    }

    public function approve($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->approvePaymentOrder($connectCompany, $request->Stt,  Auth::user()->nUserId, $request->description, Auth::user()->username);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Duyệt phiếu thành công'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function cancel($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->cancelPaymentOrder($connectCompany, $request->Stt,  Auth::user()->nUserId, $request->description, Auth::user()->username);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Từ chối duyệt phiếu thành công'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function create($request)
    {
        $data =  $this->suggestionRepository->create($request);
        return $data;
    }
    
    public function store($request)
    {
        return $this->suggestionRepository->store($request);
    }

    public function statistical()
    {
        if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two')) {
            $paymentOrder = $this->suggestionRepository->statisticalAdmin();
        } elseif (Auth::user()->role->id === config('constants.number.three')) {
            $paymentOrder = $this->suggestionRepository->statisticalManage();
        }
        $countAll = array_sum($paymentOrder['count']);
        $paymentOrder['count-total'] = $countAll;
        return $paymentOrder;
    }
}
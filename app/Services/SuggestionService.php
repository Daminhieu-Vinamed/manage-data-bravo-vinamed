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

    public function getData($DocCode)
    {
        $arrayDataCollect = $this->suggestionRepository->getData($DocCode);
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
        return DataTables::of($collectData)
        ->editColumn('TotalAmount', function ($paymentOrder) {
            return number_format($paymentOrder->TotalAmount, config('constants.number.zero'), ".", ".");
        })
        ->editColumn('DocDate', function ($paymentOrder) {
            return date('d-m-Y', strtotime($paymentOrder->DocDate));
        })
        ->addColumn('action', function ($paymentOrder) {
            $action = '<button title="Mẫu in" type="button" class="btn btn-warning shadow-sm btn-circle printed-sample" branch_code="'. $paymentOrder->BranchCode .'" id="'. $paymentOrder->Id .'"><i class="fas fa-print"></i></button>' . 
            ' <a href="' . route('suggestion.directional-edit', ['DocCode' => request()->get('DocCode'), 'company' => $paymentOrder->BranchCode, 'Stt' => $paymentOrder->Stt]) . '" title="Chỉnh sửa đề nghị thanh toán" class="btn btn-info shadow-sm btn-circle"><i class="fas fa-edit"></i></a>' .
            ' <button title="Hủy đề nghị thanh toán" type="button" class="btn btn-danger shadow-sm btn-circle cancel-payment-request" branch_code="'. $paymentOrder->BranchCode .'" stt="'. $paymentOrder->Stt .'"><i class="fas fa-ban"></i></button>';
            if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two') || Auth::user()->role->id === config('constants.number.three') || Auth::user()->role->id === config('constants.number.four') || Auth::user()->role->id === config('constants.number.five') || Auth::user()->role->id === config('constants.number.six')) {
                $action = '<button title="Duyệt đề nghị thanh toán" type="button" class="btn btn-success shadow-sm btn-circle approve-payment-request" branch_code="'. $paymentOrder->BranchCode .'" stt="'. $paymentOrder->Stt .'"><i class="fas fa-check"></i></button> ' . $action;
            }
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
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

    public function getPaymentOrder($request)
    {
        $data =  $this->suggestionRepository->getPaymentOrder($request);
        return $data;
    }
    
    public function editPaymentOrder($request)
    {
        $data =  $this->suggestionRepository->editPaymentOrder($request);
        return $data;
    }
    
    public function postPaymentOrder($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->CreatePaymentOrder($connectCompany, $request);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'TẠO ĐỀ NGHỊ THANH TOÁN THÀNH CÔNG'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }
    
    public function updatePaymentOrder($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->updatePO($connectCompany, $request);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'CẬP NHẬT ĐỀ NGHỊ THANH TOÁN THÀNH CÔNG'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function getRequestsForAdvances($request)
    {
        $data =  $this->suggestionRepository->getRequestsForAdvances($request);
        return $data;
    }
    
    public function editRequestsForAdvances($request)
    {
        $data =  $this->suggestionRepository->editRequestsForAdvances($request);
        return $data;
    }
    
    public function postRequestsForAdvances($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->CreateRequestsForAdvances($connectCompany, $request);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'TẠO ĐỀ NGHỊ TẠM ỨNG THÀNH CÔNG'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }
    
    public function updateRequestsForAdvances($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->updateRFA($connectCompany, $request);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'CẬP NHẬT ĐỀ NGHỊ TẠM ỨNG THÀNH CÔNG'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function getSuggestedPerDiem($request)
    {
        $data =  $this->suggestionRepository->getSuggestedPerDiem($request);
        return $data;
    }
    
    public function editSuggestedPerDiem($request)
    {
        $data =  $this->suggestionRepository->editSuggestedPerDiem($request);
        return $data;
    }

    public function postSuggestedPerDiem($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->createSuggestedPerDiem($connectCompany, $request);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'TẠO ĐỀ NGHỊ CÔNG TÁC PHÍ THÀNH CÔNG'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }
    
    public function updateSuggestedPerDiem($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->suggestionRepository->updateSPD($connectCompany, $request);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'CHỈNH SỬA ĐỀ NGHỊ CÔNG TÁC PHÍ THÀNH CÔNG'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function statistical()
    {
        if (Auth::user()->role->id === config('constants.number.one') || Auth::user()->role->id === config('constants.number.two')) {
            $paymentOrder = $this->suggestionRepository->statisticalAdmin();
        } elseif (Auth::user()->role->id === config('constants.number.three') || Auth::user()->role->id === config('constants.number.four')) {
            $paymentOrder = $this->suggestionRepository->statisticalManage();
        }
        $countAll = array_sum($paymentOrder['count']);
        $paymentOrder['count-total'] = $countAll;
        return $paymentOrder;
    }

    public function showPrintedSample($request)
    {
        // $connectCompany = DB::connection($request->BranchCode);
        // $connectCompany->beginTransaction();
        $printedSample = DB::connection($request->BranchCode)->select('EXEC usp_B33AccDoc_VoucherForm ?', [$request->Id]);
        dd($printedSample);
    }
}
<?php

namespace App\Services;

use App\Repositories\PaymentOrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentOrderService extends PaymentOrderRepository
{
    protected PaymentOrderRepository $paymentOrderRepository;

    public function __construct(PaymentOrderRepository $paymentOrderRepository)
    {
        $this->paymentOrderRepository = $paymentOrderRepository;
    }

    public function getData()
    {
        $arrayDataCollect = $this->paymentOrderRepository->getData();
        $arrayData = array_merge($arrayDataCollect["A11"]->toArray(), $arrayDataCollect["A12"]->toArray(), $arrayDataCollect["A14"]->toArray());
        $collectData = collect($arrayData)->sortByDesc('DocDate')->all();
        return DataTables::of($collectData)
            ->editColumn('TotalAmount', function ($approvalVote) {
                return number_format($approvalVote->TotalAmount, config('constants.number.zero'), ".", ".");
            })
            ->editColumn('DocDate', function ($approvalVote) {
                return date('d-m-Y', strtotime($approvalVote->DocDate));
            })
            ->addColumn('action', function ($approvalVote) {
                return '<button title="Bước đề nghị thanh toán" class="btn btn-info shadow-sm btn-circle" data-toggle="modal" data-target="#paymentOrderModal"><i class="fas fa-walking"></i></button> ' .
                    '<button title="Duyệt đề nghị thanh toán" type="button" class="btn btn-success shadow-sm btn-circle approve-payment-request" branch_code="' . $approvalVote->BranchCode . '" stt="' . $approvalVote->Stt . '"><i class="fas fa-check"></i></button> ' .
                    ' <button title="Hủy đề nghị thanh toán" type="button" class="btn btn-danger shadow-sm btn-circle cancel-payment-request" branch_code="' . $approvalVote->BranchCode . '" stt="' . $approvalVote->Stt . '"><i class="fas fa-ban"></i></button>';
            })->make(true);
    }

    public function approve($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->paymentOrderRepository->approvePaymentOrder($connectCompany, $request->Stt,  Auth::user()->nUserId, $request->description, Auth::user()->username);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Duyệt phiếu thành công !'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function cancel($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->paymentOrderRepository->cancelPaymentOrder($connectCompany, $request->Stt,  Auth::user()->nUserId, $request->description, Auth::user()->username);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Từ chối duyệt phiếu thành công !'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function create($request)
    {
        $data =  $this->paymentOrderRepository->create($request->company);
        return $data;
    }
}
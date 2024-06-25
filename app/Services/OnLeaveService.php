<?php

namespace App\Services;

use App\Repositories\OnLeaveRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OnLeaveService extends OnLeaveRepository
{
    protected OnLeaveRepository $onLeaveRepository;

    public function __construct(OnLeaveRepository $onLeaveRepository)
    {
        $this->onLeaveRepository = $onLeaveRepository;
    }

    public function listData()
    {
        $timeNow = new Carbon();
        $onLeave = $this->onLeaveRepository->getData($timeNow);
        $onLeaveTotal = array_merge(
            $onLeave['A06'],
            $onLeave['A11'],
            $onLeave['A12'],
            $onLeave['A14'],
            $onLeave['A18'],
            $onLeave['A19'],
            $onLeave['A21'],
            $onLeave['A22'],
            $onLeave['A25'],
        );
        return DataTables::of($onLeaveTotal)
        ->addColumn('action', function ($onLeave) {
            return  '<button BranchCode="'.$onLeave->BranchCode.'" DocCode="'.$onLeave->DocCode.'" RowId="'.$onLeave->RowId.'" title="Phê duyệt nghỉ phép" class="btn btn-info shadow-sm btn-circle" id="approve"><i class="fas fa-check"></i></button>' .
                    ' <button BranchCode="'.$onLeave->BranchCode.'" RowId="'.$onLeave->RowId.'" title="Từ chối nghỉ phép" class="btn btn-danger shadow-sm btn-circle" id="cancel"><i class="fas fa-ban"></i></button>';
        })->make(true);
    }

    public function approve($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->onLeaveRepository->approveLeave($connectCompany, $request->RowId, $request->DocCode);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Phê duyệt nghỉ phép thành công'], 200);
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
            $this->onLeaveRepository->cancelLeave($connectCompany, $request->RowId);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Phê duyệt nghỉ phép thành công'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }
    
    public function calendar()
    {
        return $this->onLeaveRepository->calendar();
    }
}
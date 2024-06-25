<?php

namespace App\Services;

use App\Repositories\AdditionalWorkRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdditionalWorkService extends AdditionalWorkRepository
{
    protected AdditionalWorkRepository $additionalWorkRepository;

    public function __construct(AdditionalWorkRepository $additionalWorkRepository)
    {
        $this->additionalWorkRepository = $additionalWorkRepository;
    }

    public function listData()
    {
        $timeNow = new Carbon();
        $additionalWork = $this->additionalWorkRepository->getData($timeNow);
        $additionalWorkTotal = array_merge(
            $additionalWork['A06'],
            $additionalWork['A11'],
            $additionalWork['A12'],
            $additionalWork['A14'],
            $additionalWork['A18'],
            $additionalWork['A19'],
            $additionalWork['A21'],
            $additionalWork['A22'],
            $additionalWork['A25']
        );
        return DataTables::of($additionalWorkTotal)
        ->addColumn('action', function ($additionalWork) {
            return  '<button BranchCode="'.$additionalWork->BranchCode.'" DocCode="'.$additionalWork->DocCode.'" RowId="'.$additionalWork->RowId.'" title="Phê duyệt bổ sung" class="btn btn-info shadow-sm btn-circle" id="approve"><i class="fas fa-check"></i></button>' .
                    ' <button BranchCode="'.$additionalWork->BranchCode.'" RowId="'.$additionalWork->RowId.'" title="Từ chối bổ sung" class="btn btn-danger shadow-sm btn-circle" id="cancel"><i class="fas fa-ban"></i></button>';
        })->make(true);
    }

    public function approve($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->additionalWorkRepository->approveLeave($connectCompany, $request->RowId, $request->DocCode);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Phê duyệt bổ xung thành công'], 200);
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
            $this->additionalWorkRepository->cancelLeave($connectCompany, $request->RowId);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Phê duyệt bổ xung thành công'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }

    public function calendar()
    {
        return $this->additionalWorkRepository->calendar();
    }
}
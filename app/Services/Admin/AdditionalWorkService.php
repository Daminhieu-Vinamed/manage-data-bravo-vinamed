<?php

namespace App\Services\Admin;

use App\Repositories\Admin\AdditionalWorkRepository;
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
        $onLeave = $this->additionalWorkRepository->getData($timeNow);
        return DataTables::of($onLeave)
        ->addColumn('action', function ($onLeave) {
            return  '<button BranchCode="'.$onLeave->BranchCode.'" DocCode="'.$onLeave->DocCode.'" RowId="'.$onLeave->RowId.'" title="Phê duyệt bổ sung" class="btn btn-info shadow-sm btn-circle" id="approve"><i class="fas fa-check"></i></button>' .
                    ' <button BranchCode="'.$onLeave->BranchCode.'" RowId="'.$onLeave->RowId.'" title="Từ chối bổ sung" class="btn btn-danger shadow-sm btn-circle" id="cancel"><i class="fas fa-ban"></i></button>';
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
}
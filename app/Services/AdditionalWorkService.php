<?php

namespace App\Services;

use App\Repositories\AdditionalWorkRepository;
use App\Repositories\TimekeepingRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdditionalWorkService extends AdditionalWorkRepository
{
    protected AdditionalWorkRepository $additionalWorkRepository;
    protected TimekeepingRepository $timekeepingRepository;

    public function __construct(AdditionalWorkRepository $additionalWorkRepository, TimekeepingRepository $timekeepingRepository)
    {
        $this->additionalWorkRepository = $additionalWorkRepository;
        $this->timekeepingRepository = $timekeepingRepository;
    }

    public function listData()
    {
        $timeNow = new Carbon();
        $additionalWorkTotal = $this->additionalWorkRepository->getData($timeNow);
        return DataTables::of($additionalWorkTotal)
        ->addColumn('action', function ($additionalWork) {
            return  '<button BranchCode="'.$additionalWork->BranchCode.'" DocCode="'.$additionalWork->DocCode.'" RowId="'.$additionalWork->RowId.'" title="Phê duyệt bổ sung" class="btn btn-info shadow-sm btn-circle" id="approve"><i class="fas fa-check"></i></button>' .
                    ' <button BranchCode="'.$additionalWork->BranchCode.'" RowId="'.$additionalWork->RowId.'" title="Từ chối bổ sung" class="btn btn-danger shadow-sm btn-circle" id="cancel"><i class="fas fa-ban"></i></button>';
        })->make(true);
    }

    public function calendar()
    {
        return $this->additionalWorkRepository->calendar();
    }
}
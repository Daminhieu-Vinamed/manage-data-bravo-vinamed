<?php

namespace App\Services;

use App\Repositories\OnLeaveRepository;
use App\Repositories\TimekeepingRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OnLeaveService extends OnLeaveRepository
{
    protected OnLeaveRepository $onLeaveRepository;
    protected TimekeepingRepository $timekeepingRepository;

    public function __construct(OnLeaveRepository $onLeaveRepository, TimekeepingRepository $timekeepingRepository)
    {
        $this->onLeaveRepository = $onLeaveRepository;
        $this->timekeepingRepository = $timekeepingRepository;
    }

    public function listData()
    {
        $timeNow = new Carbon();
        $onLeaveTotal = $this->onLeaveRepository->getData($timeNow);
        return DataTables::of($onLeaveTotal)
        ->addColumn('action', function ($onLeave) {
            return  '<button BranchCode="'.$onLeave->BranchCode.'" DocCode="'.$onLeave->DocCode.'" RowId="'.$onLeave->RowId.'" title="Phê duyệt nghỉ phép" class="btn btn-info shadow-sm btn-circle" id="approve"><i class="fas fa-check"></i></button>' .
                    ' <button BranchCode="'.$onLeave->BranchCode.'" RowId="'.$onLeave->RowId.'" title="Từ chối nghỉ phép" class="btn btn-danger shadow-sm btn-circle" id="cancel"><i class="fas fa-ban"></i></button>';
        })->make(true);
    }
    
    public function calendar()
    {
        return $this->onLeaveRepository->calendar();
    }
}
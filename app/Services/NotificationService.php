<?php
namespace App\Services;

use App\Repositories\NotificationRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class NotificationService extends NotificationRepository
{
    protected NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getData()
    {
        $notifications = $this->notificationRepository->getData();
        return DataTables::of($notifications)
        ->addColumn('name', function ($notification) {
            return $notification->data['name'];
        })
        ->addColumn('type', function ($notification) {
            if ($notification->data['type'] == config('constants.number.two')) {
                return 'Tạo bổ sung công và nghỉ phép';
            }
        })
        ->addColumn('date', function ($notification) {
            return date('d-m-Y', strtotime($notification->created_at));
        })
        ->addColumn('time', function ($notification) {
            return date('H:i:s', strtotime($notification->created_at));
        })
        ->addColumn('action', function ($notification) {
            if ($notification->data['type'] == config('constants.number.two')) {
                return '<a href="'.route('notification.list-additional-work-and-on-leave', ['notification_id' => $notification->id, 'user_id' => $notification->data['user_id']]).'" title="Đọc thông báo" class="btn btn-primary shadow-sm btn-circle edit_notification"><i class="fab fa-readme"></i></a>';
            }
        })
        ->make(true);
    }
    
    public function listDataAdditionalWorkAndOnLeave($id)
    {
        $timeNow = new Carbon();
        $AdditionalWorkAndOnLeaveTotal = $this->notificationRepository->getDataAdditionalWorkAndOnLeave($timeNow, $id);
        return DataTables::of($AdditionalWorkAndOnLeaveTotal)
        ->addColumn('action', function ($AdditionalWorkAndOnLeave) {
            return  '<button BranchCode="'.$AdditionalWorkAndOnLeave->BranchCode.'" DocCode="'.$AdditionalWorkAndOnLeave->DocCode.'" RowId="'.$AdditionalWorkAndOnLeave->RowId.'" title="Phê duyệt bổ sung/nghỉ phép" class="btn btn-info shadow-sm btn-circle" id="approve"><i class="fas fa-check"></i></button>' .
                    ' <button BranchCode="'.$AdditionalWorkAndOnLeave->BranchCode.'" RowId="'.$AdditionalWorkAndOnLeave->RowId.'" title="Từ chối bổ sung/nghỉ phép" class="btn btn-danger shadow-sm btn-circle" id="cancel"><i class="fas fa-ban"></i></button>';
        })->make(true);
    }
}
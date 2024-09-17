<?php
namespace App\Services;

use App\Repositories\TimekeepingRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimekeepingService extends TimekeepingRepository
{
    protected TimekeepingRepository $timekeepingRepository;

    public function __construct(TimekeepingRepository $timekeepingRepository)
    {
        $this->timekeepingRepository = $timekeepingRepository;
    }

    public function calendar()
    {
        $data = $this->timekeepingRepository->getData(Auth::user()->EmployeeCode, Auth::user()->company);
        return $data;
    }

    public function getTimeInTimekeeping() 
    {
        try {
            $timeNow = new Carbon();
            $data = $this->timekeepingRepository->getStartTimeAndEndTimeInTimekeeping(Auth::user()->EmployeeCode, Auth::user()->company, $timeNow);
            return response()->json(['status' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'không có dữ liệu chấm công'], 401);
        }
    }

    private function calculateHaversineDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Bán kính trái đất tính bằng km

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Khoảng cách tính bằng km

        return $distance;
    }

    public function clockIn($request) {
        $user = Auth::user();
        $connectCompany = DB::connection($user->company);
        $connectCompany->beginTransaction();
        $clockIn = new Carbon();
        try {
            $currentLat = $request->lat;
            $currentLng = $request->lng;
            $targetLat = config('constants.location.latitude');
            $targetLng = config('constants.location.longitude');
            $type = config('constants.number.zero');
            $distance = $this->calculateHaversineDistance($currentLat, $currentLng, $targetLat, $targetLng);
            $this->timekeepingRepository->timekeeping($connectCompany, $clockIn, $user->EmployeeCode, $user->company, $user->id, $currentLat, $currentLng, $distance, $type);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Đã chấm công', 'data' => $clockIn->format('H:i:s')], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Chấm công lỗi'], 401);
        }
    }

    public function clockOut($request) {
        $user = Auth::user();
        $connectCompany = DB::connection($user->company);
        $connectCompany->beginTransaction();
        $clockOut = new Carbon();
        try {
            $currentLat = $request->lat;
            $currentLng = $request->lng;
            $targetLat = config('constants.location.latitude');
            $targetLng = config('constants.location.longitude');
            $type = config('constants.number.one');
            $distance = $this->calculateHaversineDistance($currentLat, $currentLng, $targetLat, $targetLng);
            $this->timekeepingRepository->timekeeping($connectCompany, $clockOut, $user->EmployeeCode, $user->company, $user->id, $currentLat, $currentLng, $distance, $type);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Kết thúc chấm công', 'data' => $clockOut->format('H:i:s')], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Kết thúc chấm công lỗi'], 401);
        }
    }
    
    public function supplementsAndLeave($request) {
        $user = Auth::user();
        $connectCompany = DB::connection($user->company);
        $connectCompany->beginTransaction();
        try {
            $this->timekeepingRepository->additionalWork($connectCompany, $user, $request->type, $request->start, $request->end, $request->description);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Đã bổ sung công'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Bổ sung công lỗi'], 401);
        }
    }

    public function approve($request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $this->timekeepingRepository->approveLeave($connectCompany, $request->RowId, $request->DocCode);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Phê duyệt nghỉ phép/bổ sung thành công'], 200);
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
            $this->timekeepingRepository->cancelLeave($connectCompany, $request->RowId);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Hủy bỏ nghỉ phép/bổ sung thành công'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ'], 401);
        }
    }
}
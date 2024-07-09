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
        $timeNow = new Carbon();
        $data = $this->timekeepingRepository->getData(Auth::user()->EmployeeCode, Auth::user()->company, $timeNow);
        $data['now'] = $timeNow;
        return $data;
    }

    public function clockIn() {
        $user = Auth::user();
        $connectCompany = DB::connection($user->company);
        $connectCompany->beginTransaction();
        $clockIn = new Carbon();
        try {
            $this->timekeepingRepository->timekeeping($connectCompany, $clockIn, $user->EmployeeCode, $user->company);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Đã chấm công', 'data' => $clockIn->format('H:i:s')], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Chấm công lỗi'], 401);
        }
    }

    public function clockOut() {
        $user = Auth::user();
        $connectCompany = DB::connection($user->company);
        $connectCompany->beginTransaction();
        $clockOut = new Carbon();
        try {
            $this->timekeepingRepository->timekeeping($connectCompany, $clockOut, $user->EmployeeCode, $user->company);
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
            $this->timekeepingRepository->additionalWork($connectCompany, $user->EmployeeCode, $user->company, $request->type, $request->start, $request->end, $request->description);
            $connectCompany->commit();
            return response()->json(['status' => 'success', 'msg' => 'Đã bổ sung công'], 200);
        } catch (\Exception $e) {
            $connectCompany->rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Bổ sung công lỗi'], 401);
        }
    }

}
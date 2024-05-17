<?php

namespace App\Services\Admin;

use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    protected UserRepository $userRepository;
    public $storePath = 'public/images/user_images/';
    public $imagePath = 'storage/images/user_images/';
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getData()
    {
        $users = $this->userRepository->getData();
        return DataTables::of($users)
        ->editColumn('status', function ($user) {
            return $user->status->name; 
        })
        ->editColumn('gender', function ($user) {
            return $user->gender->name; 
        })
        ->editColumn('role', function ($user) {
            return $user->role->name; 
        })
        ->editColumn('deptCode', function ($user) {
            $arrayDeptCode = json_decode($user->department->DeptCode);
            $department = DB::connection($user->company)->table('B20Dept')->select('Name')->whereIn('Code', $arrayDeptCode)->first();
            return $department->Name;
        })
        ->editColumn('avatar', function ($user) {
            return '<img class="w-25 img-thumbnail" src="'. $user->avatar .'" />';
        })
        ->addColumn('action', function ($user) {
            return '<button title="Chỉnh sửa tài khoản" class="btn btn-info shadow-sm btn-circle"><i class="fas fa-user-edit"></i></button> ' .
                    ' <button title="Xóa tài khoản" id="'. $user->id .'" class="btn btn-danger shadow-sm btn-circle delete_user"><i class="fas fa-trash-alt"></i></button>';
        })
        ->rawColumns(['avatar', 'action'])
        ->make(true);
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            unset($data['re_password']);
            if (empty($request->file('avatar'))) {
                $data['gender_id'] == config('constants.number.one') ? $data['avatar'] = 'assets/images/man.png' : $data['avatar'] = 'assets/images/woman.png';
            }else{
                $imageName = $request->file('avatar')->hashName();
                unset($data['avatar']);
                $data['avatar'] = $this->imagePath . $imageName;
                $request->avatar->storeAs($this->storePath, $imageName);
            }
            $this->userRepository->store($data);
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Tạo tài khoản thành công !'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đang xảy ra lỗi !'], 401);
        }
    }

    public function delete($id)
    { 
        DB::beginTransaction();
        try {
            $this->userRepository->destroy($id);
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Xóa tài khoản thành công !'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đang xảy ra lỗi !'], 401);
        }
    }
}
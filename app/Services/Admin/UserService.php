<?php

namespace App\Services\Admin;

use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    protected UserRepository $userRepository;
    public $storePath = 'public/images/user/';
    public $imagePath = 'storage/images/user/';
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getData()
    {
        $users = $this->userRepository->getData();
        return DataTables::of($users)
        ->editColumn('department', function ($user) {
            return $user->department->name;
        })
        ->editColumn('gender', function ($user) {
            return $user->gender->name; 
        })
        ->editColumn('role', function ($user) {
            return $user->role->name; 
        })
        ->editColumn('avatar', function ($user) {
            return '<img class="w-25 img-thumbnail" src="'. $user->avatar .'" />';
        })
        ->editColumn('parent_user_id', function ($user) {
            if (!empty($user->parent)) {
                return $user->parent->name;
            }
        })
        ->addColumn('action', function ($user) {
            return  '<a href="'. route('user.edit', ['id' => $user->id]) .'" title="Chỉnh sửa tài khoản" class="btn btn-info shadow-sm btn-circle edit_user"><i class="fas fa-user-edit"></i></a>' .
                    ' <button id="'. $user->id .'" title="Xóa tài khoản" class="btn btn-danger shadow-sm btn-circle delete_user"><i class="fas fa-user-times"></i></button>';
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
                $data['avatar'] = $this->imagePath . $imageName;
                $request->avatar->storeAs($this->storePath, $imageName);
            }
            $this->userRepository->store($data);
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Tạo tài khoản thành công'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Tạo tài khoản thất bại'], 401);
        }
    }

    public function delete($id)
    { 
        DB::beginTransaction();
        try {
            $this->userRepository->destroy($id);
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Xóa tài khoản thành công'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Hệ thống đang xảy ra lỗi'], 401);
        }
    }

    public function getDataDeleted() 
    {
        $users = $this->userRepository->getDataDeleted();
        return DataTables::of($users)
        ->editColumn('department', function ($user) {
            return $user->department->name;
        })
        ->editColumn('gender', function ($user) {
            return $user->gender->name; 
        })
        ->editColumn('role', function ($user) {
            return $user->role->name; 
        })
        ->editColumn('avatar', function ($user) {
            dd();
            return '<img class="w-25 img-thumbnail" src="'. $user->avatar .'" />';
        })
        ->editColumn('parent_user_id', function ($user) {
            if (!empty($user->parent)) {
                return $user->parent->name;
            }
        })
        ->addColumn('action', function ($user) {
            return '<a href="'. route('user.edit', ['id' => $user->id]) .'" title="Khôi phục tài khoản" class="btn btn-info shadow-sm btn-circle user_restore"><i class="fas fa-trash-restore-alt"></i></a>' .
            ' <button id="'. $user->id .'" title="Hủy tài khoản" class="btn btn-danger shadow-sm btn-circle destroy_user"><i class="fas fa-user-slash"></i></button>';
        })
        ->rawColumns(['avatar', 'action'])
        ->make(true);
    }
    
    public function edit($id)
    {
        return $this->userRepository->edit($id);
    }
    
    public function updateUser($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            unset($data['re_password']);
            if (empty($request->file('avatar'))) {
                if ($data['old_avatar'] === config('constants.value.null')) {
                    $data['gender_id'] == config('constants.number.one') ? $data['avatar'] = 'assets/images/man.png' : $data['avatar'] = 'assets/images/woman.png';
                }else{
                    $data['avatar'] = $data['old_avatar'];
                }
            }else{
                $imageUrl = $this->userRepository->getImageUrl($request->id);
                if (Storage::exists(str_replace("storage", "public", $imageUrl))) {
                    Storage::delete(str_replace("storage", "public", $imageUrl));
                }
                $imageName = $request->file('avatar')->hashName();
                $data['avatar'] = $this->imagePath . $imageName;
                $request->avatar->storeAs($this->storePath, $imageName);
            }
            unset($data['old_avatar']);
            $this->userRepository->updateUser($request->id, $data);
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'Cập nhật tài khoản thành công'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'msg' => 'Cập nhật tài khoản thất bại'], 401);
        }
    }
}
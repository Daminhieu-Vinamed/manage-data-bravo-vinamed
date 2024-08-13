<?php

namespace App\Services;

use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }    
    
    public function postLogin($request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['status' => 'success', 'msg' => 'Đăng nhập thành công'], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Sai tên đăng nhập hoặc mật khẩu'], 401);
        }
    }

    public function logout($request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.get');
    }
    
    public function changePassword($request)
    {
        $id = Auth::user()->id;
        $data['password'] = Hash::make($request->new_password);
        $this->userRepository->updateUser($id, $data);
        return response()->json(['status' => 'success', 'msg' => 'Đổi mật khẩu thành công'], 200);
    }

    public function markAsRead($id) 
    {
        if ($id) {
            Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return back();
    }
}
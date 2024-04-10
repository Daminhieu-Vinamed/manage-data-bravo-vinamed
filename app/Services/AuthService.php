<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function postLogin($request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['status' => 'success', 'msg' => 'Đăng nhập thành công !', 'url' => '/payment-order'], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Sai tên đăng nhập hoặc mật khẩu !'], 401);
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
}
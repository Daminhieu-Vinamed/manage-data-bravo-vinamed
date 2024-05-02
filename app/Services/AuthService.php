<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function postLogin($request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->role === config('constants.number.one') || Auth::user()->role === config('constants.number.two')) {
                $url = '/dashboard/admin';
            } elseif(Auth::user()->role === config('constants.number.three')) {
                $url = '/dashboard/manage';
            }else{
                $url = '/payment-order';
            }
            return response()->json(['status' => 'success', 'msg' => 'Đăng nhập thành công !', 'url' => $url], 200);
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
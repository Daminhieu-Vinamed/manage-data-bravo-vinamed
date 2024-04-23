<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function postAdminLogin($request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json(['status' => 'success', 'msg' => 'Đăng nhập thành công !', 'url' => '/admin/payment-order'], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Sai tên đăng nhập hoặc mật khẩu !'], 401);
        }
    }
    
    public function postClientLogin($request)
    {
        $dataCompany = DB::connection($request->company);
        $user = $dataCompany->table("B00UserList")->select('username', 'Checksum')->where('username', $request->username)->first();
        $pass = decrypt($user->Checksum);
        dd(bcrypt($user->Checksum), bcrypt($request->password));
        // if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        //     return response()->json(['status' => 'success', 'msg' => 'Đăng nhập thành công !', 'url' => '/admin/payment-order'], 200);
        // } else {
        //     return response()->json(['status' => 'error', 'msg' => 'Sai tên đăng nhập hoặc mật khẩu !'], 401);
        // }
    }

    public function logout($request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.get');
    }
}
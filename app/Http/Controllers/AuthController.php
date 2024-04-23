<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function getAdminLogin()
    {
        return view('auth.admin');
    }

    public function postAdminLogin(AuthRequest $request)
    {
        return $this->authService->postAdminLogin($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    public function getClientLogin()
    {
        return view('auth.client');
    }

    public function postClientLogin(Request $request)
    {
        return $this->authService->postClientLogin($request);
    }
}
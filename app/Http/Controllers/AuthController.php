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
    
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(AuthRequest $request)
    {
        return $this->authService->postLogin($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
}
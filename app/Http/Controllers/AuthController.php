<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\Information\UpdateBirthdayRequest;
use App\Http\Requests\Auth\Information\UpdateEmailRequest;
use App\Http\Requests\Auth\Information\UpdateNameRequest;
use App\Http\Requests\Auth\Information\UpdateUsernameRequest;
use App\Http\Requests\Auth\LoginRequest;
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

    public function postLogin(LoginRequest $request)
    {
        return $this->authService->postLogin($request);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->authService->changePassword($request);
    }

    public function updateBirthday(UpdateBirthdayRequest $request)
    {
        return $this->authService->updateInfo($request);
    }

    public function updateName(UpdateNameRequest $request)
    {
        return $this->authService->updateInfo($request);
    }

    public function updateUsername(UpdateUsernameRequest $request)
    {
        return $this->authService->updateInfo($request);
    }

    public function updateEmail(UpdateEmailRequest $request)
    {
        return $this->authService->updateInfo($request);
    }
}

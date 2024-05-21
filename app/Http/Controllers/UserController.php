<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function list()
    {
        return view('user.list');
    }

    public function getData()
    {
        return $this->userService->getData();
    }

    public function create(CreateRequest $request)
    {
        return $this->userService->create($request);
    }

    public function delete(Request $request)
    {
        return $this->userService->delete($request->id);
    }

    public function edit(Request $request)
    {
        return $this->userService->edit($request->id);
    }
}
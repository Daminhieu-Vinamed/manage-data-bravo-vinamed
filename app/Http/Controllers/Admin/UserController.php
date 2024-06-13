<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
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
        $user = $this->userService->edit($request->id);
        return view('user.edit', compact('user'));
    }
    
    public function update(UpdateRequest $request)
    {
        return $this->userService->updateUser($request);
    }
}
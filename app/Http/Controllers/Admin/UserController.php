<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
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
        $departments = Department::select('code', 'name')->get();
        $roles = Role::select('id', 'name')
        ->where('id', '<>', config('constants.number.one'))
        ->where('id', '<>', config('constants.number.two'))
        ->where('id', '<>', config('constants.number.nine'))
        ->get();
        $parents = User::select('id', 'name')
        ->where('role_id', '<>', config('constants.number.seven'))
        ->where('role_id', '<>', config('constants.number.eight'))
        ->get();
        return view('user.list', compact('departments', 'roles', 'parents'));
    }

    public function getData()
    {
        return $this->userService->getData();
    }

    public function create(CreateRequest $request)
    {
        return $this->userService->create($request);
    }

    public function deleted()
    {
        return view('user.deleted');
    }

    public function getDataDeleted() 
    {
        return $this->userService->getDataDeleted();
    }

    public function restore(Request $request)
    {
        return $this->userService->restore($request->id);
    }
    
    public function destroy(Request $request)
    {
        return $this->userService->destroy($request->id);
    }
    
    public function delete(Request $request)
    {
        return $this->userService->delete($request->id);
    }

    public function edit(Request $request)
    {
        $user = $this->userService->edit($request->id);
        $departments = Department::select('code', 'name')->get();
        $roles = Role::select('id', 'name')
        ->where('id', '<>', config('constants.number.one'))
        ->where('id', '<>', config('constants.number.two'))
        ->where('id', '<>', config('constants.number.nine'))
        ->get();
        $parents = User::select('id', 'name')
        ->where('role_id', '<>', config('constants.number.seven'))
        ->where('role_id', '<>', config('constants.number.eight'))
        ->get();
        return view('user.edit', compact('user', 'departments', 'roles', 'parents'));
    }
    
    public function update(UpdateRequest $request)
    {
        return $this->userService->updateUser($request);
    }
}
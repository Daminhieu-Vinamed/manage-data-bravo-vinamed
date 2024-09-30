<?php

namespace App\Repositories\Admin;

use App\Models\User;
use App\Repositories\BaseRepository\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends AbstractRepository
{
    protected function model(): string
    {
        return User::class;
    }
    
    public function getData() {
        $users = $this->builder()->where('role_id', '<>', config('constants.number.one'))->where('id', '<>', Auth::user()->id);
        if (Auth::user()->role_id == config('constants.number.nine')) {
            $users->where('role_id', '<>', config('constants.number.two'));
        }
        $users->get();
        return $users;
    }
    
    public function getDataDeleted() {
        $users = $this->builder()->onlyTrashed()->where('role_id', '<>', config('constants.number.one'))->where('id', '<>', Auth::user()->id);
        if (Auth::user()->role_id == config('constants.number.nine')) {
            $users->where('role_id', '<>', config('constants.number.two'));
        }
        $users->get();
        return $users;
    }
    
    public function store($data) {
        $users = $this->create($data);
        return $users;
    }
    
    public function destroy($id) {
        $users = $this->builder()->where('id', $id)->delete();
        return $users;
    }

    public function edit($id) {
        $users = $this->find($id);
        return $users;
    }
    
    public function updateUser($id, $data) {
        return $this->update($id, $data);
    }

    public function getImageUrl($id) {
        $users = $this->find($id);
        return $users->avatar;
    }
}
<?php

namespace App\Repositories\Admin;

use App\Models\User;
use App\Repositories\BaseRepository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    protected function model(): string
    {
        return User::class;
    }
    
    public function getData() {
        $users = $this->builder()->where('role_id', '<>', config('constants.number.one'))->get();
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
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['EmployeeCode' => '000000', 'company' => 'A00', 'username' => 'administrator', 'name' => 'Quản trị hệ thống', 'email' => 'administrator@catoc24.com', 'password' => bcrypt('administrator@1703'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.one'), 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '000000', 'company' => 'A00', 'username' => 'admin', 'name' => 'Quản trị', 'email' => 'admin@caotoc24.com', 'password' => bcrypt('admin@1703'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.two'), 'avatar' => 'assets/images/man.png'],
        ];

        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
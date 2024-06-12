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
            ['EmployeeCode' => '000000', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'administrator', 'name' => 'Quản trị hệ thống', 'email' => 'administrator@gmail.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_code' => 'SUPER_ADMIN', 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '000000', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'tung.dothanh', 'name' => 'Đỗ Thanh Tùng', 'email' => 'tung.dothanh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_code' => 'ADMIN', 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '000000', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'hieu.dm', 'name' => 'Đàm Minh Hiếu', 'email' => 'hieu.dm@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_code' => 'ADMIN', 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '000000', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'tuan.dh', 'name' => 'Đinh Huy Tuân', 'email' => 'tuan.dh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_code' => 'ADMIN', 'avatar' => 'assets/images/man.png'],
           
            ['EmployeeCode' => '140035', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'linh.dangthuy', 'name' => 'Đặng Thùy Linh', 'email' => 'linh.dangthuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_code' => 'MANAGER', 'avatar' => 'assets/images/woman.png'],
            
            ['EmployeeCode' => '140064', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'ngoc.phamthivan', 'name' => 'Phạm Thị Vân Ngọc', 'email' => 'ngoc.phamthivan@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_code' => 'USER_MULTI', 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '140081', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'hieu.damminh', 'name' => 'Đàm Minh Hiếu', 'email' => 'hieu.damminh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_code' => 'USER_MULTI', 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '140070', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'tuan.dinhhuy', 'name' => 'Đinh Huy Tuân', 'email' => 'tuan.dinhhuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_code' => 'USER_MULTI', 'avatar' => 'assets/images/man.png'],
            
            ['EmployeeCode' => '140111', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'tung.tranthanh', 'name' => 'Trần Thanh Tùng', 'email' => 'tung.tranthanh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_code' => 'USER', 'avatar' => 'assets/images/man.png'],
        ];
        
        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
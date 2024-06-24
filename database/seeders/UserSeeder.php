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
            //ADMIN
            ['EmployeeCode' => '000000', 'department_code' => 'ADMIN', 'company' => 'A00', 'username' => 'administrator', 'name' => 'Quản trị hệ thống', 'email' => 'administrator@catoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.one'), 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '000000', 'department_code' => 'ADMIN', 'company' => 'A00', 'username' => 'admin', 'name' => 'Quản trị', 'email' => 'admin@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.two'), 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '000000', 'department_code' => 'ADMIN', 'company' => 'A00', 'username' => 'tung.dothanh', 'name' => 'Đỗ Thanh Tùng', 'email' => 'tung.dothanh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.two'), 'avatar' => 'assets/images/man.png'],
            
            //MANAGER
            //A14
            ['EmployeeCode' => '140035', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'linh.dangthuy', 'name' => 'Đặng Thùy Linh', 'email' => 'linh.dangthuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.three'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '140116', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'lieu.doanthikim', 'name' => 'Đoàn Thị Kim Liễu', 'email' => 'lieu.doanthikim@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.three'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '140022', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'lan.nguyenthi', 'name' => 'Nguyễn Thị Lan', 'email' => 'lan.nguyenthi@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.three'), 'avatar' => 'assets/images/woman.png'],
            //A12
            ['EmployeeCode' => '120004', 'department_code' => 'PURCHASE', 'company' => 'A12', 'username' => 'yen.hoanghai', 'name' => 'Hoàng Hải Yến', 'email' => 'yen.hoanghai@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.three'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '120042', 'department_code' => 'PURCHASE', 'company' => 'A12', 'username' => 'thao.nguyenphuong', 'name' => 'Nguyễn Phương Thảo', 'email' => 'thao.nguyenphuong@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.three'), 'avatar' => 'assets/images/woman.png'],
            
            //USER
            //A14
            ['EmployeeCode' => '140064', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'ngoc.phamthivan', 'name' => 'Phạm Thị Vân Ngọc', 'email' => 'ngoc.phamthivan@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '140081', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'hieu.damminh', 'name' => 'Đàm Minh Hiếu', 'email' => 'hieu.damminh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '140070', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'tuan.dinhhuy', 'name' => 'Đinh Huy Tuân', 'email' => 'tuan.dinhhuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/man.png'],
            ['EmployeeCode' => '140059', 'department_code' => 'PURCHASE', 'company' => 'A14', 'username' => 'tien.duongminh', 'name' => 'Dương Minh Tiến', 'email' => 'tien.duongminh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.one'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/man.png'],
            //A18
            ['EmployeeCode' => '180152', 'department_code' => 'PURCHASE', 'company' => 'A18', 'username' => 'lan.nguyenthi2', 'name' => 'Nguyễn Thị Lan', 'email' => 'lan.nguyenthi2@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '180177', 'department_code' => 'PURCHASE', 'company' => 'A18', 'username' => 'anh.tranthikim', 'name' => 'Trần Thị Kim Anh', 'email' => 'anh.tranthikim@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '180039', 'department_code' => 'PURCHASE', 'company' => 'A18', 'username' => 'anh.lequynh', 'name' => 'Lê Quỳnh Anh', 'email' => 'anh.lequynh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '180081', 'department_code' => 'PURCHASE', 'company' => 'A18', 'username' => 'uyen.hoangthitu', 'name' => 'Hoàng Thị Tú Uyên', 'email' => 'uyen.hoangthitu@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            //A25
            ['EmployeeCode' => '250043', 'department_code' => 'PURCHASE', 'company' => 'A25', 'username' => 'thu.vothi', 'name' => 'Võ Thị Thu', 'email' => 'thu.vothi@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            //A12
            ['EmployeeCode' => '120009', 'department_code' => 'PURCHASE', 'company' => 'A12', 'username' => 'hue.dangminh', 'name' => 'Đặng Minh Huệ', 'email' => 'hue.dangminh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '120013', 'department_code' => 'PURCHASE', 'company' => 'A12', 'username' => 'chi.nguyenngoc', 'name' => 'Nguyễn Ngọc Chi', 'email' => 'chi.nguyenngoc@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            ['EmployeeCode' => '120024', 'department_code' => 'PURCHASE', 'company' => 'A12', 'username' => 'linh.nguyenthithuy', 'name' => 'Nguyễn Thị Thùy Linh', 'email' => 'linh.nguyenthithuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
            //A11
            ['EmployeeCode' => '110022', 'department_code' => 'PURCHASE', 'company' => 'A11', 'username' => 'hue.buithi', 'name' => 'Bùi Thị Huệ', 'email' => 'hue.buithi@caotoc24.com', 'password' => bcrypt('abcd@123'), 'status_id' => config('constants.number.one'), 'gender_id' => config('constants.number.two'), 'role_id' => config('constants.number.four'), 'avatar' => 'assets/images/woman.png'],
        ];

        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
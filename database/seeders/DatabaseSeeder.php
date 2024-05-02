<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $data = [
            ['nUserId' => 1, 'DeptCode' => 1, 'company' => 'A14', 'username' => 'hieu.damminh', 'name' => 'Đàm Minh Hiếu', 'email' => 'hieu.damminh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 1],
            ['nUserId' => 2, 'DeptCode' => 2, 'company' => 'A14', 'username' => 'tuan.dinhhuy', 'name' => 'Đinh Huy Tuân', 'email' => 'tuan.dinhhuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 2],
            ['nUserId' => 3, 'DeptCode' => 3, 'company' => 'A14', 'username' => 'hieu.trungnguyen', 'name' => 'Nguyễn Trung Hiếu', 'email' => 'hieu.trungnguyen@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 2],
            ['nUserId' => 4, 'DeptCode' => 4, 'company' => 'A14', 'username' => 'tung.dothanh', 'name' => 'Đỗ Thanh Tùng', 'email' => 'tung.dothanh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 2],
            ['nUserId' => 5, 'DeptCode' => 5, 'company' => 'A14', 'username' => 'linh.dangthuy', 'name' => 'Đặng Thùy Linh', 'email' => 'linh.dangthuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 2, 'role' => 3],
            ['nUserId' => 6, 'DeptCode' => 6, 'company' => 'A14', 'username' => 'ngoc.phamthivan', 'name' => 'Phạm Thị Vân Ngọc', 'email' => 'ngoc.phamthivan@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 2, 'role' => 4],
            ['nUserId' => 7, 'DeptCode' => 7, 'company' => 'A14', 'username' => 'tung.tranthanh', 'name' => 'Trần Thanh Tùng', 'email' => 'tung.tranthanh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 5],
        ];
        
        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
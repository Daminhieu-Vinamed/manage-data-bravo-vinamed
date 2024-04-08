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
            ['nUserId' => 1, 'username' => 'hieu.damminh', 'name' => 'Đàm Minh Hiếu', 'email' => 'hieu.damminh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 1,],
            ['nUserId' => 2, 'username' => 'tuan.dinhhuy', 'name' => 'Đinh Huy Tuân', 'email' => 'tuan.dinhhuy@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 2,],
            ['nUserId' => 3, 'username' => 'hieu.trungnguyen', 'name' => 'Nguyễn Trung Hiếu', 'email' => 'hieu.trungnguyen@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 2,],
            ['nUserId' => 4, 'username' => 'tung.dothanh', 'name' => 'Đỗ Thanh Tùng', 'email' => 'tung.dothanh@caotoc24.com', 'password' => bcrypt('abcd@123'), 'gender' => 1, 'role' => 3,],
        ];
        
        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
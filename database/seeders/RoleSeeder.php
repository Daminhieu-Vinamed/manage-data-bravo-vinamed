<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 'SUPER_ADMIN', 'name' => 'Quản trị hệ thống'],
            ['code' => 'ADMIN', 'name' => 'Quản trị'],
            ['code' => 'MANAGER', 'name' => 'Trưởng phòng'],
            ['code' => 'USER_MULTI', 'name' => 'Nhân viên đa công ty'],
            ['code' => 'USER', 'name' => 'Nhân viên'],
        ];
        DB::table('roles')->insert($data);
    }
}
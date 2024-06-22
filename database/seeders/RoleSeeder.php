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
            ['name' => 'Quản trị hệ thống'],
            ['name' => 'Quản trị'],
            ['name' => 'Trưởng phòng'],
            ['name' => 'Nhân viên'],
        ];
        DB::table('roles')->insert($data);
    }
}
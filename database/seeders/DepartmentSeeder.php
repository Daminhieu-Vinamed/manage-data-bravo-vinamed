<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 'PURCHASE', 'name' => 'Phòng mua hàng và Dịch vụ', 'DeptCode' => '["167", "168", "169", "197"]'],
            ['code' => 'ACCOUNTANT', 'name' => 'Phòng kế toán', 'DeptCode' => '["179"]'],
            ['code' => 'ADMIN', 'name' => 'Quản lý hệ thống', 'DeptCode' => '["167", "168", "169", "197", "179"]'],
        ];
        DB::table('departments')->insert($data);
    }
}
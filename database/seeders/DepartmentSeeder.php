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
            ['code' => 'IT', 'name' => 'Phòng IT', 'DeptCode' => '["174", "175", "176"]'],
            ['code' => 'PERSONNEL', 'name' => 'Phòng nhân sự', 'DeptCode' => '["181", "182", "183", "184"]'],
            ['code' => 'PURCHASE', 'name' => 'Phòng mua hàng', 'DeptCode' => '["167", "168", "169", "197", "221"]'],
            ['code' => 'ACCOUNTANT', 'name' => 'Phòng kế toán', 'DeptCode' => '["179"]'],
            ['code' => 'AM_NORTH_1', 'name' => 'AM MIỀN BẮC 1', 'DeptCode' => '["187"]'],
            ['code' => 'AM_NORTH_2', 'name' => 'AM MIỀN BẮC 2', 'DeptCode' => '["188"]'],
            ['code' => 'AM_SOUTHERN_1', 'name' => 'AM MIỀN NAM 1', 'DeptCode' => '["111"]'],
            ['code' => 'AM_SOUTHERN_2', 'name' => 'AM MIỀN NAM 2', 'DeptCode' => '["112"]'],
            ['code' => 'CONTRACT', 'name' => 'Hợp đồng', 'DeptCode' => '["193"]'],
            ['code' => 'CONTRACTOR_&_BG', 'name' => 'Thầu & BG', 'DeptCode' => '["191"]'],
            ['code' => 'NORTHERN_TECHNICAL_SERVICES', 'name' => 'Kỹ thuật dịch vụ Miền Bắc', 'DeptCode' => '["120"]'],
            ['code' => 'SOUTHERN_TECHNICAL_SERVICE', 'name' => 'Kỹ thuật dịch vụ Miền Nam', 'DeptCode' => '["121"]'],
            ['code' => 'SOUTHERN_BUSINESS_3_(CONSUMPTION)', 'name' => 'Kinh doanh miền Nam 3 (Tiêu hao)', 'DeptCode' => '["134"]'],
            ['code' => 'SOUTHERN_BUSINESS_(KSNK)', 'name' => 'Kinh doanh miền Nam (KSNK)', 'DeptCode' => '["162"]'],
            ['code' => 'CONSUMPTION BUSINESS_(CTNS)', 'name' => 'Kinh doanh tiêu hao (CTNS)', 'DeptCode' => '["158"]'],
            ['code' => 'PROJECT_CONSULTATION_AND_MANAGEMENT', 'name' => 'Tư vấn và quản lý dự án', 'DeptCode' => '["208"]'],
            ['code' => 'ADMIN', 'name' => 'Quản lý hệ thống', 'DeptCode' => '["174", "175", "176", "181", "182", "183", "184", "167", "168", "169", "197", "221", "179"]'],
        ];
        DB::table('departments')->insert($data);
    }
}
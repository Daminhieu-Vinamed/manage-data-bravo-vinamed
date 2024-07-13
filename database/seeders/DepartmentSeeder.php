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
            ['code' => 'Information_technology', 'name' => 'Công nghệ thông tin', 'DeptCode' => '["173", "174", "175", "176"]'],
            ['code' => 'Board_of_manager', 'name' => 'Ban giám đốc', 'DeptCode' => '["100", "145"]'],
            ['code' => 'Industry_marketing', 'name' => 'Marketing ngành hàng', 'DeptCode' => '["101", "103", "104", "106", "107", "206"]'],
            ['code' => 'Assistant_Secretary', 'name' => 'Trợ lý - Thư ký', 'DeptCode' => '["109", "185"]'],
            ['code' => 'Equipment_trading', 'name' => 'Kinh doanh thiết bị', 'DeptCode' => '["111", "112", "187", "188"]'],
            ['code' => 'QC_equipment', 'name' => 'QC thiết bị', 'DeptCode' => '["119"]'],
            ['code' => 'Service_engineering', 'name' => 'Kỹ thuật dịch vụ', 'DeptCode' => '["120", "121"]'],
            ['code' => 'KTDV_support', 'name' => 'Hỗ trợ KTDV', 'DeptCode' => '["124"]'],
            ['code' => 'Consumable_Business', 'name' => 'Kinh Doanh Tiêu hao', 'DeptCode' => '["126", "129", "130", "131", "132", "133", "134", "136", "205", "214"]'],
            ['code' => 'Business_Support', 'name' => 'Hỗ trợ kinh doanh', 'DeptCode' => '["138", "139"]'],
            ['code' => 'Orthopedics_&_Spine', 'name' => 'Chỉnh hình & cột sống', 'DeptCode' => '["147", "148", "149", "150", "155"]'],
            ['code' => 'Intervention_&_Endoscopy', 'name' => 'Can thiệp & Nội soi', 'DeptCode' => '["157", "158"]'],
            ['code' => 'Infection_control_Consumption', 'name' => 'Kiểm soát nhiễm khuẩn Tiêu hao', 'DeptCode' => '["161", "162", "163"]'],
            ['code' => 'Supply_chain', 'name' => 'Chuỗi cung ứng', 'DeptCode' => '["167", "168", "169"]'],
            ['code' => 'Internal_control', 'name' => 'Kiểm soát nội bộ', 'DeptCode' => '["170", "171", "204"]'],
            ['code' => 'Accountant', 'name' => 'Kế toán', 'DeptCode' => '["179"]'],
            ['code' => 'Finance_Planning', 'name' => 'Tài chính - Kế hoạch', 'DeptCode' => '["180"]'],
            ['code' => 'Operate', 'name' => 'Vận hành', 'DeptCode' => '["181", "182", "183", "184"]'],
            ['code' => 'Business_operations', 'name' => 'Tác nghiệp kinh doanh', 'DeptCode' => '["190", "191", "192", "193", "199", "211"]'],
            ['code' => 'Test', 'name' => 'Xét nghiệm', 'DeptCode' => '["221"]'],
            ['code' => 'Marketing_(Onelab)', 'name' => 'Marketing (Onelab)', 'DeptCode' => '["223"]'],
            ['code' => 'Business_(Onelab)', 'name' => 'Kinh doanh (Onelab)', 'DeptCode' => '["228", "229"]'],
            ['code' => 'Purchase_&_Services', 'name' => 'Mua hàng & Dịch vụ', 'DeptCode' => '["197"]'],
            ['code' => 'Consulting_and_Project_Management', 'name' => 'Tư vấn và Quản lý dự án', 'DeptCode' => '["208"]'],

            [
                'code' => 'Admin', 
                'name' => 'Quản lý hệ thống', 
                'DeptCode' => '["173", "174", "175", "176", "100", "145", "101", "103", "104", "106", "107", "206", "109", "185", "111", "112", "119", "120", "121", "124", "126", "129", "130", "131", "132", "133", "134", "136", "205", "214", "138", "139", "147", "148", "149", "150", "155", "157", "158", "161", "162", "163", "167", "168", "169", "170", "171", "204", "179", "180", "181", "182", "183", "184", "187", "188", "190", "191", "192", "193", "199", "211", "221", "223", "228", "229", "197", "208"]'
            ],
        ];
        DB::table('departments')->insert($data);
    }
}
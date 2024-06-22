<?php
return [
    'value' => [
        'null' => NULL,
        'empty' => ''
    ],
    
    'boolean' => [
        'true' => true,
        'false' => false,
    ],
    
    'number' => [
        'zero' => 0,
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5
    ],
    
    'role' => [
        'super_admin' => ['id' => 1, 'name' => 'Quản trị hệ thống'] ,
        'admin' => ['id' => 2, 'name' => 'Quản trị'],
        'manage' => ['id' => 3, 'name' => 'Trưởng phòng'],
        'user' => ['id' => 4, 'name' => 'Nhân viên']
    ],
    
    'department' => [
        'purchase' => ['code' => 'PURCHASE', 'name' => 'Mua hàng']
    ],

    'timekeeping' => [
        'clock_in' => '08:15:00',
        'clock_out' => '17:15:00',
        'min' => '00:00:00',
    ],

    'company' => ['A06', 'A11', 'A12', 'A14', 'A18', 'A19', 'A21', 'A22', 'A25'],
];
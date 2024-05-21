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
        'super_admin' => ['code' => 'SUPER_ADMIN', 'name' => 'Quản trị hệ thống'] ,
        'admin' => ['code' => 'ADMIN', 'name' => 'Quản trị'],
        'manage' => ['code' => 'MANAGER', 'name' => 'Trưởng phòng'],
        'user_multi' => ['code' => 'USER_MULTI', 'name' => 'Nhân viên đa công ty'],
        'user' => ['code' => 'USER', 'name' => 'Nhân viên']
    ],
    
    'department' => [
        'purchase' => ['code' => 'PURCHASE', 'name' => 'Mua hàng']
    ],

    'timekeeping' => [
        'clock_in' => '08:15:00',
        'clock_out' => '17:15:00',
        'min' => '00:00:00',
    ],
];
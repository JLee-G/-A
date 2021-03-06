<?php

return [

    /*
    |--------------------------------------------------------------------------
    | routes settings
    |--------------------------------------------------------------------------
    |
    | Use 'DELETE', 'GET', 'HEAD', 'OPTIONS', 'PATCH', 'POST', 'PUT'; Or use '' include all
    |
     */
    'routes'      => [
        '/'        => [
            'GET' => 'Home Page',
        ],
        'api/user' => [
            'GET' => 'API',
        ],
        'admin/setting' => [
            'GET' => '設定頁面',
        ],
        'admin/ModifyPermissions' => [
            'POST' => '修改權限路由功能',
        ],
        'admin/ModifyUser' => [
            'POST' => '修改使用者權限',
        ],
        'admin/company' => [
            'GET' => '廠商管理',
        ],
        'admin/client' => [
            'GET' => '客戶管理',
        ],
        'admin/order' => [
            'GET' => '訂單管理',
        ],
        'admin/amount' => [
            'GET' => '觀看金額資訊',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Actions settings
    |--------------------------------------------------------------------------
    |
     */
    'actions'     => [
        // 'slug' => 'name',
    ],

    /*
    |--------------------------------------------------------------------------
    | permissions settings
    |--------------------------------------------------------------------------
    |
     */
    'permissions' => [
        'setting' => '權限管理',
        'test01' => '測試用01',
        'test02' => '測試用02',
        'amount' => '觀看金額權限',
    ],

    /*
    |--------------------------------------------------------------------------
    | views settings
    |--------------------------------------------------------------------------
    |
     */
    'views'       => [
        // 'slug' => 'name',
    ],

    /*
    |--------------------------------------------------------------------------
    | blades settings
    |--------------------------------------------------------------------------
    |
     */
    'blades'      => [
        // 'slug' => 'name',
    ],

    /*
    |--------------------------------------------------------------------------
    | assets settings
    |--------------------------------------------------------------------------
    |
     */
    'assets'      => [
        // 'slug' => [
        //     'name' => 'asset',
        // ],
    ],
];

<?php


return [
    'default' => env('LOG_DEFAULT', 'default'),

    'channels' => [
        'default' => [
            'driver' => 'daily',
            'name' => 'local',
            'path' => env('RETAIL_LOG_PATH') . 'laravel.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'sale' => [
            'driver' => 'daily',
            'name' => 'sale',
            'path' => env('RETAIL_LOG_PATH') . 'sale/sale.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'outGoingSale' => [
            'driver' => 'daily',
            'name' => 'outGoingBillRequest',
            'path' => env('RETAIL_LOG_PATH') . 'sale/outGoingSale.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'incomingSale' => [
            'driver' => 'daily',
            'name' => 'incomingSale',
            'path' => env('RETAIL_LOG_PATH') . 'sale/incomingSale.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'incomingSaleCheck' => [
            'driver' => 'daily',
            'name' => 'incomingSaleCheck',
            'path' => env('RETAIL_LOG_PATH') . 'sale/incomingSaleCheck.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'purchase' => [
            'driver' => 'daily',
            'name' => 'purchase',
            'path' => env('RETAIL_LOG_PATH') . 'purchase/purchase.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'outGoingPurchase' => [
            'driver' => 'daily',
            'name' => 'outGoingPurchase',
            'path' => env('RETAIL_LOG_PATH') . 'purchase/outGoingPurchase.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'incomingPurchase' => [
            'driver' => 'daily',
            'name' => 'incomingPurchase',
            'path' => env('RETAIL_LOG_PATH') . 'purchase/incomingPurchase.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'incomingPurchaseCheck' => [
            'driver' => 'daily',
            'name' => 'incomingPurchaseCheck',
            'path' => env('RETAIL_LOG_PATH') . 'purchase/incomingPurchaseCheck.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'incomingItemCheck' => [
            'driver' => 'daily',
            'name' => 'incomingItemCheck',
            'path' => env('RETAIL_LOG_PATH') . 'purchase/incomingItemCheck.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'outGoingNotification' => [
            'driver' => 'daily',
            'name' => 'outGoingNotification',
            'path' => env('RETAIL_LOG_PATH') . 'notify/outGoingNotification.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'user' => [
            'driver' => 'daily',
            'name' => 'user',
            'path' => env('RETAIL_LOG_PATH') . 'user/user.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'userLogin' => [
            'driver' => 'daily',
            'name' => 'user',
            'path' => env('RETAIL_LOG_PATH') . 'user/userLogin.log',
            'level' => 'debug',
            'days' => 0,
        ],


        'incomingPayment' => [
            'driver' => 'daily',
            'name' => 'incomingNormalPayment',
            'path' => env('RETAIL_LOG_PATH') . 'payment/incomingPayment.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'setting' => [
            'driver' => 'daily',
            'name' => 'setting',
            'path' => env('RETAIL_LOG_PATH') . 'setting/setting.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'incomingSetting' => [
            'driver' => 'daily',
            'name' => 'incomingSetting',
            'path' => env('RETAIL_LOG_PATH') . 'setting/incomingSetting.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'systemMaintenance' => [
            'driver' => 'daily',
            'name' => 'systemMaintenance',
            'path' => env('RETAIL_LOG_PATH') . 'setting/systemMaintenance.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'outGoingSetting' => [
            'driver' => 'daily',
            'name' => 'outGoingSetting',
            'path' => env('RETAIL_LOG_PATH') . 'setting/outGoingSetting.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'defectItem' => [
            'driver' => 'daily',
            'name' => 'defectItem',
            'path' => env('RETAIL_LOG_PATH') . 'defect-item/defect-item.log',
            'level' => 'debug',
            'days' => 0,
        ],
        'outGoingDefectItem' => [
            'driver' => 'daily',
            'name' => 'outGoingDefectItem',
            'path' => env('RETAIL_LOG_PATH') . 'defect-item/outGoingDefectItem.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'incomingDefectItem' => [
            'driver' => 'daily',
            'name' => 'incomingDefectItem',
            'path' => env('RETAIL_LOG_PATH') . 'defect-item/incomingDefectItem.log',
            'level' => 'debug',
            'days' => 0,
        ], 'incomingZReport' => [
            'driver' => 'daily',
            'name' => 'incomingZReport',
            'path' => env('RETAIL_LOG_PATH') . 'report/incomingZReport.log',
            'level' => 'debug',
            'days' => 0,
        ], 'outGoingZReport' => [
            'driver' => 'daily',
            'name' => 'outGoingZReport',
            'path' => env('RETAIL_LOG_PATH') . 'report/outGoingZReport.log',
            'level' => 'debug',
            'days' => 0,
        ],

        'report' => [
            'driver' => 'daily',
            'name' => 'report',
            'path' => env('RETAIL_LOG_PATH') . 'report/report.log',
            'level' => 'debug',
            'days' => 0,
        ],
    ],

];

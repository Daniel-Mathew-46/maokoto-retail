<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Retail Settings
    |--------------------------------------------------------------------------
    */
    'rabbitmq' => [
        'host' => env('RABBITMQ_HOST', 'localhost'),
        'port' => env('RABBITMQ_PORT', '5672'),
        'virtualhost' => env('RABBITMQ_VIRTUALHOST', 'SPRtlService'),
        'username' => env('RABBITMQ_USERNAME', 'SPRtlService'),
        'password' => env('RABBITMQ_PASSWORD', 'SPRtlService@123'),

        'retryCounterSettingQueueInRetryTimes' => 4,
        'retryCounterSettingQueueInRetryLimit' => 32,
        'retryCounterSettingQueueInToDbRetryTimes' => 4,
        'retryCounterSettingQueueInToDbRetryLimit' => 32,
        'retryCounterSettingQueueOutRetryTimes' => 4,
        'retryCounterSettingQueueOutRetryLimit' => 32,

        'retryCounterSaleQueueInRetryTimes' => 4,
        'retryCounterSaleQueueInRetryLimit' => 32,
        'retryCounterSaleQueueInToDbRetryTimes' => 4,
        'retryCounterSaleQueueInToDbRetryLimit' => 32,
        'retryCounterSaleQueueOutRetryTimes' => 4,
        'retryCounterSaleQueueOutRetryLimit' => 32,

        'retryCounterPurchaseQueueInRetryTimes' => 4,
        'retryCounterPurchaseQueueInRetryLimit' => 32,
        'retryCounterPurchaseQueueInToDbRetryTimes' => 4,
        'retryCounterPurchaseQueueInToDbRetryLimit' => 32,
        'retryCounterPurchaseQueueOutRetryTimes' => 4,
        'retryCounterPurchaseQueueOutRetryLimit' => 32,

        'retryCounterDefectItemQueueInRetryTimes' => 4,
        'retryCounterDefectItemQueueInRetryLimit' => 32,
        'retryCounterDefectItemQueueInToDbRetryTimes' => 4,
        'retryCounterDefectItemQueueInToDbRetryLimit' => 32,
        'retryCounterDefectItemQueueOutRetryTimes' => 4,
        'retryCounterDefectItemQueueOutRetryLimit' => 32,
    ]
];

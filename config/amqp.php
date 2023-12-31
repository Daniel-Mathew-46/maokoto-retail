<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Define which configuration should be used
    |--------------------------------------------------------------------------
    */

    'use' => 'production',

    /*
    |--------------------------------------------------------------------------
    | AMQP properties separated by key
    |--------------------------------------------------------------------------
    */

    'properties' => [

        'production' => [
            
            'host'                  => env('RABBITMQ_HOST','localhost'),
            'port'                  => env('RABBITMQ_PORT','5672'),
            'username'              => env('RABBITMQ_USERNAME','smlt-service'),
            'password'              => env('RABBITMQ_PASSWORD','123456a*'),
            'vhost'                 => env('RABBITMQ_VIRTUALHOST','smlt-service'),

            'connect_options'       => [],
            'ssl_options'           => [],

            'exchange'              => 'amq.topic',
            'exchange_type'         => 'topic',
            'exchange_passive'      => false,
            'exchange_durable'      => true,
            'exchange_auto_delete'  => false,
            'exchange_internal'     => false,
            'exchange_nowait'       => false,
            'exchange_properties'   => [],

            'queue_force_declare'   => false,
            'queue_passive'         => false,
            'queue_durable'         => true,
            'queue_exclusive'       => false,
            'queue_auto_delete'     => false,
            'queue_nowait'          => false,
            'queue_properties'      => ['x-ha-policy' => ['S', 'all']],

            'consumer_tag'          => 'consumer',
            'consumer_no_local'     => false,
            'consumer_no_ack'       => false,
            'consumer_exclusive'    => false,
            'consumer_nowait'       => false,
            'timeout'               => 30,
            'heartbeat'             => 3,
            'persistent'            => true,
            'keepalive'            => false,
        ],

    ],

];

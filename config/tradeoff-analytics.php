<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tradeoff Analytics API version
    |--------------------------------------------------------------------------
    |
    | The API version of Tradeoff analytics being used.
    |
    */

    'api_version' => env('TRADEOFF_ANALYTICS_API_VERSION', 'v1'),

    /*
    |--------------------------------------------------------------------------
    | Default bridge
    |--------------------------------------------------------------------------
    |
    | The name of the default bridge to use for communicating with Watson.
    |
    */

    'default_bridge' => env('TRADEOFF_ANALYTICS_DEFAULT_BRIDGE', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Bridges list
    |--------------------------------------------------------------------------
    |
    | Here you may define bridges that your application will use to communicate
    | with the Tradeoff analytics service. You may define as many bridges
    | as necessary.
    |
    */

    'bridges' => [
        'default' => [
            'credential_name' => env('TRADEOFF_ANALYTICS_DEFAULT_CREDENTIAL_NAME', 'default'),
            'service'         => env('TRADEOFF_ANALYTICS_DEFAULT_SERVICE_NAME', 'tradeoff_analytics'),
            'auth_method'     => env('TRADEOFF_ANALYTICS_DEFAULT_AUTH_METHOD', 'credentials'),
        ],
    ],
];

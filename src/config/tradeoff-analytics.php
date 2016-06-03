<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Credentials to use
    |--------------------------------------------------------------------------
    |
    | Here you may define the default service credentials to use
    | for performing API calls to Tradeoff Analytics
    |
    */

    'default_credentials' => env('TRADEOFF_ANALYTICS_DEFAULT_CREDENTIALS', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    | 
    | Here you may define credentials for your Tradeoff Analytics Service
    | you should find them in your Bluemix console. You can define as
    | many credentials as you want
    |
    */
    
    'credentials' => [

        'default' => [
            'url' => env('TRADEOFF_ANALYTICS_URL', 'https://gateway.watsonplatform.net/tradeoff-analytics/api/'),
            'password' => env('TRADEOFF_ANALYTICS_PASSWORD', 'SomePassword'),
            'username' => env('TRADEOFF_ANALYTICS_USERNAME', 'SomeUsername')
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth method
    |--------------------------------------------------------------------------
    |
    | This specifies which Authentication method we will use for
    | making request to Watson, default is credentials
    | - credentials
    | - token
    |
    */

    'auth_method' => 'credentials',

    /*
    |--------------------------------------------------------------------------
    | X-Watson-Learning-Opt-Out
    |--------------------------------------------------------------------------
    |
    | By default, Watson collects data from all requests and uses the data
    | to improve the service. If you do not want to share your data,
    | set this value to true.
    |
    */

    'x_watson_learning_opt_out' => false,
];

<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'database' => [
        'connection' => env('DB_FACEBOOK_MARKETING_API_CONNECTION'),

    ],

    'access_token' => env('FACEBOOK_MARKETING_API_ACCESS_TOKEN'),
    'ad_account_id' => env('FACEBOOK_MARKETING_API_AD_ACCOUNT_ID'),
];

<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PayPal Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains PayPal API credentials and configuration settings.
    | You can use either sandbox or production environment.
    |
    */

    'mode' => env('PAYPAL_MODE', 'live'), // 'sandbox' or 'live'

    'sandbox' => [
        'client_id' => env('PAYPAL_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', ''),
        'app_id' => 'APP-80W284485P519543T', // Default sandbox app ID
    ],

    'live' => [
        'client_id' => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id' => '', // Your live app ID
    ],

    'payment_action' => 'Sale', // 'Sale', 'Authorization', 'Order'
    'currency' => 'USD',
    'notify_url' => '', // Change this accordingly for your application.
    'locale' => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl' => true, // Validate SSL when creating api client.

    // PayPal.me configuration for QR codes
    'paypal_me' => [
        'enabled' => true,
        'username' => env('PAYPAL_ME_USERNAME', 'Blowblackhaze'),
    ],

    // Business email for receiving payments
    'business_email' => env('PAYPAL_BUSINESS_EMAIL', 'blow.blackhaze24@gmail.com'),
];
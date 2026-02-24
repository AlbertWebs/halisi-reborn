<?php

return [
    'environment' => env('PESAPAL_ENVIRONMENT', 'sandbox'), // sandbox | live
    'consumer_key' => env('PESAPAL_CONSUMER_KEY', ''),
    'consumer_secret' => env('PESAPAL_CONSUMER_SECRET', ''),
    'callback_url' => env('PESAPAL_CALLBACK_URL', env('APP_URL') . '/billing/callback'),
    'ipn_url' => env('PESAPAL_IPN_URL', env('APP_URL') . '/billing/ipn'),
    'ipn_id' => env('PESAPAL_IPN_ID', ''),
];

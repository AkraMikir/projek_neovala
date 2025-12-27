<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Meta Ads (Facebook Pixel) Configuration
    |--------------------------------------------------------------------------
    */
    'meta_ads' => [
        'pixel_id' => env('META_PIXEL_ID'),
        'enabled' => env('META_ADS_ENABLED', false),
        'access_token' => env('META_ACCESS_TOKEN'), // Optional: untuk Conversions API
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Ads Configuration
    |--------------------------------------------------------------------------
    */
    'google_ads' => [
        'conversion_id' => env('GOOGLE_ADS_CONVERSION_ID'),
        'conversion_label' => env('GOOGLE_ADS_CONVERSION_LABEL'),
        'enabled' => env('GOOGLE_ADS_ENABLED', false),
        // Conversion Labels untuk berbagai event
        'conversion_labels' => [
            'book_now' => env('GOOGLE_ADS_BOOK_NOW_LABEL'),
            'download_promo' => env('GOOGLE_ADS_DOWNLOAD_PROMO_LABEL'),
            'form_submit' => env('GOOGLE_ADS_FORM_SUBMIT_LABEL'),
            'visit' => env('GOOGLE_ADS_VISIT_LABEL'),
        ],
    ],

];

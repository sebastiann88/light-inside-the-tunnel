<?php
/**
 * Snipcart plugin configuration.
 *
 * API keys should be set in .env:
 *   SNIPCART_PUBLIC_API_KEY=...
 *   SNIPCART_SECRET_API_KEY=...
 */

use craft\helpers\App;

return [
    'publicApiKey' => App::env('SNIPCART_PUBLIC_API_KEY') ?: '',
    'secretApiKey' => App::env('SNIPCART_SECRET_API_KEY') ?: '',
    'currency' => 'cad',
    'orderComments' => '',
    'orderNotificationEmails' => [],
    'reduceQuantitiesOnOrder' => false,
    'cacheResponses' => true,
    'cacheDurationLimit' => 300,
    'logCustomRates' => false,
    'logWebhookRequests' => true,
];

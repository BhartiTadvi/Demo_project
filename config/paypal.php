<?php 

return [ 
    'client_id' => env('PAYPAL_CLIENT_ID','Ae6Jg_YMdb5nGGpxZ7Ukyb-QR2dt53BIb7VXY7ZJ8likJZbWU4N2L0kVBHPGc90XGwTo2TWQCaV-qHzQ'),
    'secret' => env('PAYPAL_SECRET','EHjJJ59eJbHz8uLIb01wWVqtG91zWNeo089RRHxKkUMIkLxjla06LO4gEte66QcgwjCK-WVc2kY64iMu'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];

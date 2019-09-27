<?php

return array(
/** set your paypal credential **/
'client_id' =>'Ae6Jg_YMdb5nGGpxZ7Ukyb-QR2dt53BIb7VXY7ZJ8likJZbWU4N2L0kVBHPGc90XGwTo2TWQCaV-qHzQ',
'secret' => 'EHjJJ59eJbHz8uLIb01wWVqtG91zWNeo089RRHxKkUMIkLxjla06LO4gEte66QcgwjCK-WVc2kY64iMu',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);

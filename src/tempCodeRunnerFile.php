<?php
require_once '/Apps/XAMPP/htdocs/src/VedicRishiClient.php';
$userId = "618859";
$apiKey = "ad7cb5518b5f322a4f9f2d89ae5d399e";
$data = array(
'date' => 19,
'month' => 07,
'year' => 2002,
'hour' =>11,
'minute' => 45,
'latitude' => 18.123,
'longitude' => 72.34,
'timezone' => 5.5
);
$resourceName = "daily_nakshatra_prediction";

$vedicRishi = new VedicRishiClient($userId, $apiKey);
$responseData = $vedicRishi->setLanguage('ma');
$responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
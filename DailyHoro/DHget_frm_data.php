<?php

include ("../php/api_includes.php");
require "../src/VedicRishiClient.php";


if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location:/403.html");
    $directaccess = 1;
}

session_start();
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

$data = $_SESSION['prs_data'];
try {
    $vedicRishi = new VedicRishiClient($AstrouserId, $AstroapiKey);
    $V_Dob_DD = (int)$data['V_Dob_DD'];
    $V_Dob_MM = (int)$data['V_Dob_MM'];
    $V_Dob_YY = (int)$data['V_Dob_YY'];
    $V_Tob_HR = (int)$data['V_Tob_HR'];
    $V_Tob_MIN = (int)$data['V_Tob_MIN'];
    $V_Lati = (float)$data['V_Lati'];
    $V_Long = (float)$data['V_Long'];
    $V_Lang = $data['V_Lang'];
    $V_Get_Tz = $data['V_Get_Tz'];
    $V_Timezone = $vedicRishi->getTimezone($data['V_Get_Tz'], 'false');
    $V_Timezone = json_decode($V_Timezone, JSON_UNESCAPED_UNICODE);
    $data = array(
        'language' => $V_Lang,
        'date' => $V_Dob_DD,
        'month' => $V_Dob_MM,
        'year' => $V_Dob_YY,
        'hour' => $V_Tob_HR,
        'minute' => $V_Tob_MIN,
        'latitude' => $V_Lati,
        'longitude' => $V_Long,
        'timezone' => $V_Timezone['timezone'],
        'prediction_timezone' => 5.5 // Optional. Only For Transit Prediction API
    );
    if ($data['language'] == 'en') {
        $vedicRishi->setLanguage('en');
    }
    if ($data['language'] == 'hi') {
        $vedicRishi->setLanguage('hi');
    }
    if ($data['language'] == 'ma') {
        $vedicRishi->setLanguage('ma');
    }
    $date = $data['month'] . '-' . $data['date'] . '-' . $data['year'];
    $V_Timezone = $vedicRishi->timezoneWithDst($date, $data['latitude'], $data['longitude']);
    $V_Timezone = json_decode($V_Timezone, JSON_UNESCAPED_UNICODE);

    $resourceName = "daily_nakshatra_prediction";
    $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $V_Timezone['timezone']);

    $success = "true";
    $_SESSION['frmres'] = $responseData;
    header($_SERVER["SERVER_PROTOCOL"] . ' 200 Details Passed To Form Page', true, 200);
} catch (ErrorException $e) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
    echo $e;
}

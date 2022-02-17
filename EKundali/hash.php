<?php
include "../php/api_includes.php";
session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
    header("Location:/403.html");
    $directaccess=1;
}



$hashstr="{$_POST['data']}{$_SESSION['orderid']}";
$key=$Encr_key;
$encrypt=openssl_encrypt($hashstr,"AES-128-ECB",$key);
$_SESSION['encrypt']=$encrypt;
echo $encrypt;
?>


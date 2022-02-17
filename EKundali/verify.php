<?php
session_start();
if(!isset($_SERVER['HTTP_REFERER'])){
    header("Location:/403.html");
    $directaccess=1;
}

require('../php/razorpay/Razorpay.php');
include "../php/api_includes.php";

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


$keyId = $razorkey_id;
$keySecret = $razorkey_secret;
error_reporting(0);
$error = "Payment Failed";
$success = false;
if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)

        $attributes = array(
            'razorpay_order_id' => $_SESSION['orderid'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );
        $api->utility->verifyPaymentSignature($attributes);
        $success = true;
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}


if ($success === true) {
    // $html = "Your payment was successful
    // Payment ID: {$_POST['razorpay_payment_id']} Copy this id for future refrence";


    $keyId = $razorkey_id;
    $keySecret = $razorkey_secret;
    $paymentstatus = "success";
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $V_Name = $_POST['V_Name'];
    $V_Gender = $_POST['V_Gender'];
    $V_Dob_DD = (int)$_POST['V_Dob_DD'];
    $V_Dob_MM = (int)$_POST['V_Dob_MM'];
    $V_Dob_YY = (int)$_POST['V_Dob_YYYY'];
    $V_Tob_HR = (int)$_POST['V_Tob_Hour'];
    $V_Tob_MIN = (int)$_POST['V_Tob_Mins'];
    $V_Tob_SEC = (int)$_POST['V_Tob_Sec'];
    $V_Lati = (float)$_POST['V_Lati'];
    $V_Long = (float)$_POST['V_Longi'];
    $V_Get_Tz = $_POST['V_Timezone'];
    $V_Place = $_POST['V_Place'];
    $VLang = $_POST['V_Lang'];

    $V_hash = $_POST['k_id'];
    $V_OrderId = $_SESSION['orderid'];
    $hashstr = $V_Name . $razorpay_payment_id . $_SESSION['orderid'];
    $decryptstr = openssl_decrypt($_SESSION['encrypt'], "AES-128-ECB", $Encr_key);
    $encrpt = $_SESSION['encrypt'];
    $n = "\ ";
    $n2 = "n";
    $n1 = trim($n);
    $hashverify = "failed";
    if ($hashstr == $decryptstr) {
        $hashverify = "success";
    } else {
        $error = "Hash Verification Failed";
    }
} else {

    $n = "\ ";
    $n2 = "n";
    $n1 = trim($n);

    $paymentstatus = "failed";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASM | Verification</title>
    <link rel="stylesheet" href="../css/loading.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GJ5DBG81P3');
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php
    if ($paymentstatus == "success" && $hashverify == "success") {
        echo '<script>',
        'function notify() {',
        'swal({',
        "title: 'Payment Verified{$n1}{$n2}',",
        "text: 'Take a screenshot for future reference{$n1}{$n2}{$n1}{$n2}Payment ID:{$razorpay_payment_id} {$n1}{$n2}Order ID:{$V_OrderId} {$n1}{$n2}K Id:{$encrpt}',",
        'type: "success",',
        ' button: "Ok",',
        '},function() {',
        "document.getElementById('r').innerHTML='Parsing Data';",
        "get_frm_data();",
        '});',
        '}',
        '</script>';


        $data = [
            "V_Name" => $V_Name,
            "V_Gender" => $V_Gender,
            "V_KId" => $encrpt,
            "V_Dob_DD" => $V_Dob_DD,
            "V_Dob_MM" => $V_Dob_MM,
            "V_Dob_YY" => $V_Dob_YY,
            "V_Tob_HR" => $V_Tob_HR,
            "V_Tob_MIN" => $V_Tob_MIN,
            "V_Tob_SEC" => $V_Tob_SEC,
            "V_Lati" => $V_Lati,
            "V_Long" => $V_Long,
            "V_Get_Tz" => $V_Get_Tz,
            "V_Place" => $V_Place,
            "V_Lang" => $VLang,
        ];
        $_SESSION['inpt_data'] = $data;
    } else {
        echo '<script>',
        'function notify() {',
        'swal({',
        "title: 'Payment Verification Failed{$n1}{$n2}',",
        "text: 'Take a screenshot for future reference{$n1}{$n2}{$n1}{$n2}{$error} {$n1}{$n2}',",
        'type: "error",',
        ' button: "Ok",',
        '},function() {',
        "document.getElementById('r').innerHTML='Redirecting back to form ';",
        'window.location="./index.php"',
        '});',
        '}',
        '</script>';
    }

    ?>
</head>

<body>
    <nav class="navbar" style="background-color:rgb(121, 47, 34); height:fit-content;height:70px;width:100%">
        <div>
            <a class="navbar-brand" href="#">
                <img src="../img/a24main.png" alt="" height="50px">
            </a>
        </div>
    </nav>
    <div>
    <p id="r" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-size:larger;">Verifying Payment</p>
       <div id="s" class="spinner spinner3" style="margin-left: 30%;"></div>
    </div>

    <script>
        notify();
    </script>
    <?php
    if ($paymentstatus == "success" && $hashverify == "success") {
    ?>
        <script>
            function get_frm_data() {
                var data = <?php echo json_encode($data, JSON_UNESCAPED_UNICODE) ?>;
                document.getElementById('r').innerHTML = 'Waiting For Response';
                $.ajax({
                    type: "POST",
                    url: "./get_frm_data.php",
                    data: {
                        data
                    },
                    cache: false,
                    success: function(data, textStatus, jqXHR) {
                        document.getElementById('r').innerHTML = 'Success !!';
                        document.getElementById('s').style.display = "none";
                        swal({
                            title: 'Data Parsing Success',
                            text: 'Click Okay To Continue',
                            type: "success",
                            button: "Ok",
                        }, function() {
                            document.getElementById('r').innerHTML = 'Redirecting...';
                            document.getElementById('s').style.display = "";
                            window.location = ("./form.php");
                        });

                    },
                    error: function(xhr, status, error) {
                        document.getElementById('r').innerHTML = "Data Fetch Failed Code: " + error + " Contact Site Administrator For Further";
                        document.getElementById('s').style.display = "none";
                        console.error(xhr);
                    }
                });

            }
        </script>
    <?php } ?>



</body>

</html>
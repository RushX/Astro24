<?php
session_start();
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location:/403.html");
    $directaccess = 1;
}

include "../php/api_includes.php";

error_reporting(0);
// $html = "Your payment was successful
// Payment ID: {$_POST['razorpay_payment_id']} Copy this id for future refrence";


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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASM | Verification</title>
    <link rel="stylesheet" href="/css/loading.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GJ5DBG81P3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GJ5DBG81P3');
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php
    echo '<script>',
    'function notify() {',
    "document.getElementById('r').innerHTML='Parsing Data';",
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
    $_SESSION['prs_data'] = $data;

    ?>
</head>

<body>
    <nav class="navbar" style="background-color:rgb(121, 47, 34); height:fit-content;height:70px;width:100%">
        <div>
            <a class="navbar-brand" href="#">
                <img src="/img/a24main.png" alt="" height="50px">
            </a>
        </div>
    </nav>
    <div>
        <p id="r" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-size:larger;">Loading</p>
        <div id="s" class="spinner spinner3" style="margin-left: 30%;"></div>
    </div>

    <script>
        function update() {
            $.ajax({
                type: "POST",
                url: "/EKundali/updt.php",
                data: {
                    name: '<?php echo $V_Name ?>',
                    gender: '<?php echo $V_Gender ?>',
                    language: '<?php echo $VLang ?>',
                    place: '<?php echo $V_Place ?>',
                    dob: '<?php echo $V_Dob_DD, "/", $V_Dob_MM, "/", $V_Dob_YY ?>',
                    tob: '<?php echo $V_Tob_HR, ":", $V_Tob_MIN, ":", $V_Tob_SEC ?>',
                    orderid: 'Null',
                    transactionid: 'Null',
                    modules: 'DH096'
                },
                cache: false,
                success: function(data) {
                    alert(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        }

        function get_frm_data() {
            var data = <?php echo json_encode($data, JSON_UNESCAPED_UNICODE) ?>;
            document.getElementById('r').innerHTML = 'Waiting For Response';
            $.ajax({
                type: "POST",
                url: "./DHget_frm_data.php",
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
                        window.location = ("./DailyHoroFrm.php");
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
    <script>
        update();
        notify();
        get_frm_data();
    </script>



</body>

</html>
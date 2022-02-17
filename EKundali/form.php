<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header("Location:/403.html");
    $directaccess=1;
}
session_start();
error_reporting(0);

$data = $_SESSION['inpt_data'];
if ($data['V_KId'] != $_SESSION['encrypt']) {
    header('HTTP/1.0 403 Forbidden');
    die();
}
if (!isset($_SESSION['frmres']) || !isset($_SESSION['frmplanet']) || !isset($_SESSION['frmpanchang'])) {
    header('HTTP/1.0 400 Bad Request');
    die();
}
$frmres = $_SESSION['frmres'];
$frmplanet = $_SESSION['frmplanet'];
$frmpanchang = $_SESSION['frmpanchang'];
$frmres = json_decode($frmres, JSON_UNESCAPED_UNICODE);
$frmplanet = json_decode($frmplanet, JSON_UNESCAPED_UNICODE);
$frmpanchang = json_decode($frmpanchang, JSON_UNESCAPED_UNICODE);
$Nakshatra = $frmres['Naksahtra'];
function trns($num)
{
    $data = $_SESSION['inpt_data'];
    if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
        $array = str_split($num);
        $num_digits = strlen($num);
        $newarray = array();
        for ($i = 0; $i < $num_digits; $i++) {

            switch ($array[$i]) {
                case ".":
                    echo ".";
                    break;

                case "0":
                    array_push($newarray, '०');
                    break;
                case "1":
                    array_push($newarray, '१');
                    break;
                case "2":
                    array_push($newarray, '२');
                    break;
                case "3":
                    array_push($newarray, '३');
                    break;
                case "4":
                    array_push($newarray, '४');
                    break;
                case "5":
                    array_push($newarray, '५');
                    break;
                case "6":
                    array_push($newarray, '६');
                    break;
                case "7":
                    array_push($newarray, '७');
                    break;
                case "8":
                    array_push($newarray, '८');
                    break;
                case "9":
                    array_push($newarray, '९');
                    break;
            }
        }
        echo join($newarray);
    } else {
        echo $num;
    }
}

if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
    $posdetails = json_decode($_SESSION['frmplanetpos'], JSON_UNESCAPED_UNICODE);
} else {
    $posdetails = $frmres;
}
$positions = ["Aries" => 1, "Taurus" => 2, "Gemini" => 3, "Cancer" => 4, "Leo" => 5, "Virgo" => 6, "Libra" => 7, "Scorpio" => 8, "Sagittarius" => 9, "Capricorn" => 10, "Aquarius" => 11, "Pisces" => 12];
$startpos = $positions["{$posdetails['ascendant']}"] - 1;
$myArray = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
$posarray = array_merge(
    array_slice($myArray, $startpos),
    array_slice($myArray, 0, $startpos)
);

$var = $frmplanet;

$houseplans = [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => [], 10 => [], 11 => [], 12 => []];
for ($i = 0; $i < sizeof($var); $i++) {
    if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
        if ($var[$i]['name'] == "यूरेनस") {
            $varname = "हर्षल";
        } else {
            $varname = $var[$i]['name'];
        }
    } else {
        $varname = $var[$i]['name'];
    }
    if ($var[$i]['isRetro'] == "true") {
        if ($var[$i]['is_planet_set'] == "true") {


            $varname = $varname . "*^";
        } else {
            $varname = $varname . "*";
        }
    } elseif ($var[$i]['isRetro'] == "false") {
        if ($var[$i]['is_planet_set'] == "true") {
            $varname = $varname . "^";
        } else {
            $varname = $varname;
        }
    }
    array_push($houseplans[$var[$i]['house']], $varname);
}
array_pop($houseplans[1]);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="../css/form.css" rel="stylesheet">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GJ5DBG81P3');
    </script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>ASM | E-Kundali</title>
    <script src="../js/jquery.PrintArea.js">
    </script>
    <style>
        @media print {

            body* {
                visibility: hidden;
            }

            .downloadable {
                visibility: visible;
            }

            @page {
                size: auto;
                /* auto is the current printer page size */
                margin: 0mm;
                /* this affects the margin in the printer settings */
            }

            body {
                background-color: #FFFFFF;
                margin: 0px;
                /* the margin on the content before printing */
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#printButton").click(function() {
                var mode = 'iframe'; //popup
                var close = mode == "iframe";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.main1").printArea(popHt = 200);
            });
        });
    </script>
</head>
<body>
    
    <nav class="navbar"  style="background-color:rgba(0, 0, 0, 0.707); height:fit-content;height:70px;">
        <div>
            <a class="navbar-brand" href="#">
                <img src="../img/a24main.png" alt="" height="50px">
            </a>
        </div>
    </nav>
    <div class="page" style="padding: 15%;">
        <div class="main1">
            <div class="downloadable" id="downlodable" style="background-color: white;">

            <?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                echo '<img class="ma" src="../img/header_ma.png" alt="">';
            } else {
                echo '<img class="ma" src="../img/header_en.png" alt="">';
                            } ?>
                <table class="infotab">
                    <tr>
                        <td colspan="2">
                            <u><b><span class="var_name"><?php echo $data['V_Name'] ?></span></b></u>

                        </td>
                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'लिंग';
                            } else {
                                echo 'Gender';
                            } ?> :
                            <span class="var_fname" for="Gender"><?php if ($data['V_Gender'] == 'm') {
                                                                        switch ($data['V_Lang']) {
                                                                            case 'ma':
                                                                                echo 'पुरुष';
                                                                                break;
                                                                            case 'hi':
                                                                                echo 'पुरुष';
                                                                                break;
                                                                            case 'en':
                                                                                echo 'Male';
                                                                                break;
                                                                        }
                                                                    };

                                                                    if ($data['V_Gender'] == 'f') {
                                                                        switch ($data['V_Lang']) {
                                                                            case 'ma':
                                                                                echo 'स्त्री';
                                                                                break;
                                                                            case 'hi':
                                                                                echo 'स्त्री';
                                                                                break;
                                                                            case 'en':
                                                                                echo 'Female';
                                                                                break;
                                                                        }
                                                                    };
                                                                    if ($data['V_Gender'] == 'na') {
                                                                        echo 'na';
                                                                    };
                                                                    ?></span>

                        </td>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'जन्म दिनांक';
                            } else {
                                echo 'Date Of Birth';
                            } ?> :
                            <span class="var_date" for="Dob"><?php trns(substr(str_repeat(0, 2) . $data['V_Dob_DD'], -2));
                                                                echo "/";
                                                                trns(substr(str_repeat(0, 2) . $data['V_Dob_MM'], -2));
                                                                echo "/";
                                                                trns($data['V_Dob_YY']); ?></span>
                        </td>

                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'जन्म वेळ';
                            } else {
                                echo 'Time Of Birth';
                            } ?> :
                            <span class="var_time" for=Tob><?php trns(substr(str_repeat(0, 2) . $data['V_Tob_HR'], -2));
                                                            echo ":";
                                                            trns(substr(str_repeat(0, 2) . $data['V_Tob_MIN'], -2));
                                                            echo ":";
                                                            trns(substr(str_repeat(0, 2) . $data['V_Tob_SEC'], -2)); ?></span>
                        </td>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'वार';
                            } else {
                                echo 'Day';
                            } ?> :
                            <span class="var_day" for="day"><?php echo $frmpanchang['day']; ?></span>
                        </td>

                    </tr>
                    <tr>
                        <td style='max-width:200px'><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                        echo 'जन्म स्थळ';
                                                    } else {
                                                        echo 'Birth Place';
                                                    } ?> :
                            <span class="var_pos" for="Place"><?php echo $data['V_Place'] ?></span>
                        </td>

                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'जन्म नक्षत्र';
                            } else {
                                echo 'Nakshatra';
                            } ?> :
                            <span class="var_pos" for="Nakshatra"><?php echo $Nakshatra ?>(<?php trns($frmres['Charan']); ?>)</span>
                        </td>
                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'तिथी';
                            } else {
                                echo 'Tithi';
                            } ?> :
                            <span class="var_pos" for="Nak_ak"><?php echo $frmres['Tithi']; ?></span>
                        </td>

                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'योग';
                            } else {
                                echo 'Yog';
                            } ?> :
                            <span class="var_pos" for="Rashi"><?php echo $frmres['Yog']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'जन्म जन्माक्षर';
                            } else {
                                echo 'Birth Name Alphabet';
                            } ?> :
                            <span class="var_pos" for="Nak_ak"><?php echo $frmres['name_alphabet']; ?></span>
                        </td>

                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'राशी';
                            } else {
                                echo 'Sign';
                            } ?> :
                            <span class="var_pos" for="Rashi"><?php echo $frmres['sign']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'नाडी';
                            } else {
                                echo 'Nadi';
                            } ?> :
                            <span class="var_pos" for="nadi"><?php echo $frmres['Nadi']; ?></span>
                        </td>

                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'योनी';
                            } else {
                                echo 'Yoni';
                            } ?> :
                            <span class="var_pos" for="yoni"><?php echo $frmres['Yoni']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'गण';
                            } else {
                                echo 'Gan';
                            } ?> :
                            <span class="var_pos" for="gan"><?php echo $frmres['Gan']; ?></span>
                        </td>

                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'राशी स्वामी';
                            } else {
                                echo 'Sign Lord';
                            } ?> :
                            <span class="var_pos" for="Rashi Swami"><?php echo $frmres['SignLord']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'वर्ण';
                            } else {
                                echo 'Varna';
                            } ?> :
                            <span class="var_pos" for="varna"><?php echo $frmres['Varna']; ?></span>
                        </td>

                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'वश्य';
                            } else {
                                echo 'Vashya';
                            } ?> :
                            <span class="var_pos" for="vashya"><?php echo $frmres['Vashya']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'तत्व';
                            } else {
                                echo 'Tatva';
                            } ?> :
                            <span class="var_pos" for="varg"><?php echo $frmres['tatva']; ?></span>
                        </td>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'करण';
                            } else {
                                echo 'Karan';
                            } ?> :
                            <span class="var_pos" for="varg"><?php echo $frmres['Karan']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="kundali">

                                <?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                    echo '॥ जन्म लग्न कुंडली ॥';
                                } else {
                                    echo 'Janma Lagna Kundali';
                                } ?>
                            </div>
                            <div class="kunmain">
                                <div class="container">
                                    <img src="/img/birth.jpg" alt="Norway" width="100%" height="100%">

                                    <div class="text-block">
                                        <div class="block n1">
                                            <p class="k p1"><?php foreach ($houseplans[1] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[0]) ?></p>
                                        </div>
                                        <div class="block n2">
                                            <p class="k p2"><?php foreach ($houseplans[2] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[1]) ?></p>
                                        </div>
                                        <div class="block n3">
                                            <p class="k p3"><?php foreach ($houseplans[3] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[2]) ?></p>
                                        </div>
                                        <div class="block n4">
                                            <p class="k p4"><?php foreach ($houseplans[4] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[3]) ?></p>
                                        </div>
                                        <div class="block n5">
                                            <p class="k p5"><?php foreach ($houseplans[5] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[4]) ?></p>
                                        </div>
                                        <div class="block n6">
                                            <p class="k p6"><?php foreach ($houseplans[6] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[5]) ?></p>
                                        </div>
                                        <div class="block n7">
                                            <p class="k p7"><?php foreach ($houseplans[7] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[6]) ?></p>
                                        </div>
                                        <div class="block n8">
                                            <p class="k p8"><?php foreach ($houseplans[8] as $value) {
                                                                echo $value . " ";
                                                            } ?><br><?php trns($posarray[7]) ?></p>
                                        </div>
                                        <div class="block n9">
                                            <p class="k p9"><?php foreach ($houseplans[9] as $value) {
                                                                echo $value . " ";
                                                            } ?>&nbsp;<br><?php trns($posarray[8]) ?></p>
                                        </div>
                                        <div class="block n10">
                                            <p class="k p10"><?php foreach ($houseplans[10] as $value) {
                                                                    echo $value . " ";
                                                                } ?>&nbsp;<br><?php trns($posarray[9]) ?></p>
                                        </div>
                                        <div class="block n11">
                                            <p class="k p11"><?php foreach ($houseplans[11] as $value) {
                                                                    echo $value . " ";
                                                                } ?>&nbsp;<br><?php trns($posarray[10]) ?></p>
                                        </div>
                                        <div class="block n12">
                                            <p class="k p12"><?php foreach ($houseplans[12] as $value) {
                                                                    echo $value . " ";
                                                                } ?>&nbsp;<br><?php trns($posarray[11]) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right;font-size:smaller;margin-right:7%">

                                <?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                    echo '* वक्री&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^ अस्तंगत ';
                                } else {
                                    echo '* Retrograde&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^ Combust';
                                } ?>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class=payment_data style="text-align: center;">
                    <span style="font-size: 10px;"> Unique ID: <?php echo  $_SESSION['encrypt'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Order ID: <?php echo  $_SESSION['orderid'] ?></span>
                </div>
            </div>
        </div>
        <div class="buttons" style="display:block; padding-top: 20px;margin-left:35%;margin-right:auto;justify-content:center">
            <button id="printButton" class="btn btn-success">Print Form</button>
            <button onclick="window.location.href='./index.php'" class="btn btn-danger">Generate New </button>
        </div>
    </div>
	<div class="footer">
        <footer class="footer m1" style="margin-bottom: 0%;">
            <p> <a href="../term.html">Terms and Conditions</a> | <a href="/privacy.html">Privacy Policy</a> | <a
                    href="../refund.html">Refund Policy</a></p>
            <p class="copyright">
                Copyright &copy;
                Astro24
            </p>
        </footer>
    </div>
</body>

</html>
<?php
// $_SESSION['start'] = array(0=> 'active', 'registered' => time());
// if ((time() - $_SESSION['start']['registered']) > (60 * 30)) {
//     unset($_SESSION['start']);
//     echo "session destroyed";
// }
// $_SESSION['start'] = time();
?>
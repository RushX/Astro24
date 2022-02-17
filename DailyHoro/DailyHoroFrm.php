<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location:/403.html");
    $directaccess = 1;
}
session_start();
error_reporting(0);

$data = $_SESSION['prs_data'];

if (!isset($_SESSION['frmres'])) {
    header('HTTP/1.0 400 Bad Request');
    die();
}
$frmres = $_SESSION['frmres'];
$frmres = json_decode($frmres, JSON_UNESCAPED_UNICODE);
$preds = $frmres['prediction'];
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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../CSS/form.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GJ5DBG81P3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GJ5DBG81P3');
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Martel&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>ASM | Daily Horoscope</title>
    <script src="/js/jquery.PrintArea.js">
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

    <nav class="navbar" style="background-color:rgba(0, 0, 0, 0.707); height:fit-content;height:70px;">
        <div>
            <a class="navbar-brand" href="#">
                <img src="/img/a24main.png" alt="" height="50px">
            </a>
        </div>
    </nav>
    <div class="page" style="padding: 15%;">
        <div class="main1">
            <div class="downloadable" id="downlodable" style="background-color: white;">

                <?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                    echo '<img class="ma" src="/img/header_ma.png" alt="">';
                } else {
                    echo '<img class="ma" src="/img/header_en.png" alt="">';
                } ?>
                <table class="infotab">
                    <tr>
                        <td colspan="2">
                            <h4 style="text-align: center;font-size:large"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                                echo 'दिनांक';
                                                                            } else {
                                                                                echo 'Date Of Prediciton';
                                                                            } ?>:
                                <span class="date" for=dop><?php echo $frmres['prediction_date'] ?></span>
                            </h4>
                        </td>

                    </tr>
                    <tr>

                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'राशी';
                            } else {
                                echo 'Sign';
                            } ?> :
                            <span class="var_pos" for="Rashi"><?php echo $frmres['birth_moon_sign']; ?></span>
                        </td>
                        <td><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                echo 'नक्षत्र';
                            } else {
                                echo 'Nakshatra';
                            } ?> :
                            <span class="var_pos" for="Nakshatra"><?php echo $frmres['birth_moon_nakshatra'] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:2%;">
                            <h1 style="text-align: center;"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                echo 'फलित';
                                                            } else {
                                                                echo 'Predictions';
                                                            } ?>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style="padding: 5%;"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                    echo '<h3>आरोग्य</h3>';
                                                                } else {
                                                                    echo '<h3>Health</h3>';
                                                                } ?>
                            <span class="health" for="health"><?php echo $preds['health']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5%;"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                    echo '<h3>भावना</h3>';
                                                                } else {
                                                                    echo '<h3>Emotions</h3>';
                                                                } ?>
                            <span class="emotions" for="emotions"><?php echo $preds['emotions']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5%;"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                    echo '<h3>व्यवसाय</h3>';
                                                                } else {
                                                                    echo '<h3>Profession</h3>';
                                                                } ?>
                            <span class="profesion" for="profession"><?php echo $preds['profession']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5%;"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                    echo '<h3>नशीब</h3>';
                                                                } else {
                                                                    echo '<h3>Luck</h3>';
                                                                } ?>
                            <span class="luck" for="luck"><?php echo $preds['luck']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5%;"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                    echo '<h3>वैयक्तिक जीवन</h3>';
                                                                } else {
                                                                    echo '<h3>Personal Life</h3>';
                                                                } ?>
                            <span class="personallife" for="personallife"><?php echo $preds['personal_life']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5%;"><?php if ($data['V_Lang'] == 'ma' || $data['V_Lang'] == 'hi') {
                                                                    echo '<h3>प्रवास</h3>';
                                                                } else {
                                                                    echo '<h3>Travel</h3>';
                                                                } ?>
                            <span class="travel" for="travel"><?php echo $preds['travel']; ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="buttons" style="display:block; padding-top: 20px;margin-left:35%;margin-right:auto;justify-content:center">
            <button id="printButton" class="btn btn-success">Print Form</button>
            <button onclick="window.location.href='./index.php'" class="btn btn-danger">Generate New </button>
        </div>
    </div>
    <div class="footer">
        <footer class="footer m1" style="margin-bottom: 0%;">
            <p> <a href="/terms.html">Terms and Conditions</a> | <a href="/privacy.html">Privacy Policy</a> | <a href="/refund.html">Refund Policy</a></p>
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
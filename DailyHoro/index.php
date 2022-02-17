<?php


include "../php/api_includes.php";
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Patrika Registration</title>
    <link rel="stylesheet" href="../css/index.css">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GJ5DBG81P3');
    </script>
    <link rel="stylesheet" href="../css/hf.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../js/jsmain.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <title>ASM | Index </title>

</head>

<body class="forms">
    <nav class="navbar" style="background-color:rgba(0, 0, 0, 0.707); 
    height:fit-content;
    height:70px;">
        <div>
            <a class="navbar-brand" href="#">
                <img src="/img/a24main.png" alt="" height="100%">
            </a>
        </div>
    </nav>

    <h2 style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;text-align:center;padding-top:5%">Daily Horoscope Portal</h2>
    <form action="javascript:void(0);" class="needs-validation" novalidate>
        <div class="form-group">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
            <div class="row">
                <div class="col-auto">
                    <label for="uname">पूर्ण नावं / Full Name</label>
                    <input type="text" class="form-control" id="uname" placeholder="Enter the name for registration" name="uname" style="width:max-content;" required>
                </div>
                <div class="col-2" style="width: max-content;">
                    <label for="uname" style="width:max-content">लिंग / Gender</label>
                    <select class="form-control" id="gender" placeholder="Enter the name for registration" name="mname" style="width:max-content;" required>
                        <option value='m'>Male</option>
                        <option value='f'>Female</option>
                        <option value='na'>N/A</option>
                    </select>
                </div>
            </div>
            <div class="invalid-feedback">Please fill out this field.</div>
            <label for="Date Of Birth">जन्म तारीख / Date Of Birth</label>
            <div class="row">
                <div class="col-sm-4">
                    <input type="number" min="1" max="31" class="form-control" placeholder="DD" id="DD" required>
                </div>
                <div class="col-sm-4">
                    <input type="number" min="1" max="12" class="form-control" placeholder="MM" id="MM" required>
                </div>
                <div class="col-sm-4">
                    <input type="number" min="1700" max="2050" class="form-control" placeholder="YYYY" id="YYYY" required>
                </div>
            </div>
            <label for="Time Of Birth">जन्म वेळ / Time Of Birth</label>
            <div class="row">
                <div class="col-sm-4">
                    <input type="number" min="00" max="23" class="form-control" placeholder="Hour" id="HR" required>
                </div>
                <div class="invalid-feedback">Please fill out this field.</div>
                <div class="col-sm-4">
                    <input type="number" min="00" max="59" class="form-control" placeholder="Mins" id="MINS" required>
                </div>
                <div class="invalid-feedback">Please fill out this field.</div>
                <div class="col-sm-4">
                    <input type="number" style="width:100px;" min="00" max="59" class="form-control" placeholder="Seconds" id="SECS" required>
                </div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <label for="Place Of Birth">जन्म ठिकाण / Place Of Birth</label>
                    <input type="text" class="form-control" placeholder="Place" id="place" style="width:max-content;" oninput="getlat();updatelocation()" required>
                </div>
                <div class="col-auto">
                    <label for="Latitude" style="width: max-content;">Latitude and Longitude Details</label>
                    <input id="Latitude" class="form-control" value='' placeholder="Latitude" readonly style="width:max-content" required>
                    <input id="Longitude" class="form-control" value='' placeholder="Longitude" readonly style="width:max-content" required>
                    <p style="color: crimson;width: max-content;">*Ensure that
                        this field is not empty </p>
                </div>
            </div>
            <div class="invalid-feedback">Please fill out this field.</div>
            <div class="timezone" style="margin-top:-10%">
                <label for="uname">TimeZone</label>
                <input type="text" class="form-control" id="timezone" placeholder="Timezone" value="" name="timezone" style="width:max-content;" required>
                <p style="color: crimson;width: max-content;">*This Timezone is based on your device IP,</p>
                <p style="color: crimson;width: max-content; margin-top:-20px;margin-left:8px"> Change if it is incorrect </p>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="Lang">भाषा / Language</label>
                    <select class="form-control" id="lang" placeholder="Language" name="mname" style="width:max-content;" required>
                        <option value='ma'>Marathi</option>
                        <option value='hi'>Hindi</option>
                        <option value='en'>English</option>
                    </select>
                </div>
            </div>
            <div class="form-check">
                <label class="form-check-label">

                    <input class="form-check-input" type="checkbox" name="remember" required> I here by confirm that the information provide for the calculations is correct.If MISTAKENLY/UNKNOWINGNLY I have entered the incorrect details, I shall NOT be liable for any kind of refund
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
            </div>
            <div class="buttons">
                <button id="Cnfrm" onclick="updt_horo()" class="btn btn-primary">Submit</button>

                <button type="reset" class="btn btn-danger   ">Reset Form</button>
            </div>
        </div>
    </form>

    <form name='razorpayform' action="./DHverify.php" method="POST">
        <input type="hidden" name="V_Name" id="V_Name">
        <input type="hidden" name="V_Gender" id="V_Gender">
        <input type="hidden" name="V_Lang" id="V_Lang">
        <input type="hidden" name="V_Dob_DD" id="V_Dob_DD">
        <input type="hidden" name="V_Dob_MM" id="V_Dob_MM">
        <input type="hidden" name="V_Dob_YYYY" id="V_Dob_YYYY">
        <input type="hidden" name="V_Tob_Hour" id="V_Tob_Hour">
        <input type="hidden" name="V_Tob_Mins" id="V_Tob_Mins">
        <input type="hidden" name="V_Tob_Sec" id="V_Tob_Sec">
        <input type="hidden" name="V_Lati" id="V_Lati">
        <input type="hidden" name="V_Longi" id="V_Longi">
        <input type="hidden" name="V_Timezone" id="V_Timezone">
        <input type="hidden" name="V_Place" id="V_Place">
    </form>
    <!-- Trigger/Open The Modal -->

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h3>Continue To the Next Step?</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Please make sure you have entered correct details</p>
                <button id="pay_verify" class="btn btn-primary" onclick="document.razorpayform.submit();" style="width: max-content;">Continue</button>

            </div>
        </div>

    </div>
    <script>
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("Cnfrm");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <div class="footer">
        <footer class="footer m1" style="margin-bottom: 0%;">
            <p> <a href="/term.html">Terms and Conditions</a> | <a href="/privacy.html">Privacy Policy</a> | <a href="/refund.html">Refund Policy</a></p>
            <p class="copyright">
                Copyright &copy;
                Astro24
            </p>
        </footer>
    </div>




</body>

</html>
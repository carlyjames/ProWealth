<?php
session_start();
include "conn.php";
include "config.php";
require_once 'account/BrowserDetection.php';
$browser = new Wolfcast\BrowserDetection;
$msg = "";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$email_err = $password_err = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email verification code from the form
    $emailVerify = test_input($_POST["emailVerify"]);

    // Check if the provided verification code matches the code stored in the database
    $sql = $link->query("SELECT id,email,password,emailVerify FROM users WHERE emailVerify='$emailVerify' LIMIT 1");
    if ($sql->num_rows > 0) {
        // Verification code matches, proceed with login process
        $data = $sql->fetch_array();
        $_SESSION['email'] = $data['email'];
        $_SESSION['username'] = $data['username'];
        header("location: account/index.php");
    } else {
        // Verification code does not match, display error message
        $msg = "Email verification code incorrect!";
    }
}



function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//Add Applicant details to eRegister record

?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>BinaWealth - Login</title>
    <meta name="next-head-count" content="3" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="icon" href="public/favicon.ico" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="preload" href="_next/static/css/7530baf1a97da1b7.css" as="style" />
    <link rel="stylesheet" href="_next/static/css/7530baf1a97da1b7.css" data-n-g="" />
    <noscript data-n-css=""></noscript>
    <script defer="" nomodule="" src="_next/static/chunks/polyfills-c67a75d1b6f99dc8.js"></script>
    <script src="_next/static/chunks/webpack-166d73e47d3c518f.js" defer=""></script>
    <script src="_next/static/chunks/framework-bf241d83758e7947.js" defer=""></script>
    <script src="_next/static/chunks/main-6c9622ac220665ac.js" defer=""></script>
    <script src="_next/static/chunks/pages/_app-73254b7b1562874c.js" defer=""></script>
    <script src="_next/static/chunks/7536-bfaac5dfe5db7690.js" defer=""></script>
    <script src="_next/static/chunks/6725-2bb66f2ca68ba6f0.js" defer=""></script>
    <script src="_next/static/chunks/pages/contact-e95088dbe6a28c92.js" defer=""></script>
    <script src="_next/static/4nlDt-lU996erpQc_pHMi/_buildManifest.js" defer=""></script>
    <script src="_next/static/4nlDt-lU996erpQc_pHMi/_ssgManifest.js" defer=""></script>
    <style>
        .site-header {
            background: white;
        }
    </style>
</head>

<body>
    <div id="__next">


        <main>
            <div class="section ">
                <div class="">
                    <div class="" style="display: flex;alignItems:center;justifyContent:center;width:100%;height:100vh;">
                            <div class="fugu-contact-wrap wow fadeInUpX">
                                <form method="post" name="mainform" onsubmit="return checkform()">
                                    <?php if ($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" . "";  ?>
                                    <?php if (isset($_GET['success']) && $msg == "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> You have successfully registered. Kindly enter email verification code.</div class='btn btn-success'>" . "";  ?>
                                    <div class="fugu-input-field">
                                        <label>Enter verification code sent to your email.</label>
                                        <input type="password" name="emailVerify" id="emailVerify" placeholder="Enter verification code" aria-invalid="false" />
                                    </div>

                                    <button id="fugu-input-submit" type="submit">
                                        Sign in
                                    </button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>

        </main>

    </div>
    <script>
        $("#input1").on("keypress", function(e) {
            return e.which !== 32;
        });
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

    <script type="text/javascript">
        emailjs.init('6h47dFkUeY67Ex3iK')
    </script>
    <script>
        const btn = document.getElementById('fugu-input-submit');

        document.getElementById('form')
            .addEventListener('submit', function(event) {
                event.preventDefault();

                btn.value = 'Sending...';

                const serviceID = 'default_service';
                const templateID = 'template_f1gq1sa';

                emailjs.sendForm(serviceID, templateID, this)
                    .then(() => {
                        btn.value = 'Send Email';
                        alert('Sent!');
                    }, (err) => {
                        btn.value = 'Send Email';
                        alert(JSON.stringify(err));
                    });
            });
    </script>
</body>

</html>
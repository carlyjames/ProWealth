<?php

session_start();


include "../../conn.php";
include "../../config.php";
include "header.php";
$msg = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION['uid'])) {
} else {


  header("location:../c2wadmin/signin.php");
}











if (isset($_POST['submit'])) {





  $subject = $link->real_escape_string($_POST['subject']);

  $message = $link->real_escape_string($_POST['message']);


  $emails = $link->real_escape_string($_POST['emails']);



  include_once "PHPMailer/PHPMailer.php";
  require_once 'PHPMailer/Exception.php';

  //PHPMailer Object
  $mail = new PHPMailer;

  //From email address and name
  $mail->setFrom($emaila);
  $mail->FromName = $name;

  //To address and name
  $mail->addAddress("$emails"); //Recipient name is optional

  //Address to which recipient will reply

  //Send HTML or Plain Text email
  $mail->isHTML(true);

  $mail->Subject = $subject;

  $mail->Body = '<div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 

<div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">



<div style="clear: both;"></div> 

<div class="be_bluebar" style="background: red; padding: 20px; color: #fff;margin-top: 10px;">

<h1>' . $subject . ' </h1>

</div> </div> 

<div class="be_body" style="padding: 20px;"> <p style="line-height: 25px;">

' . $message . '
</p>  </div> </div>';

  if ($mail->send()) {

    $msg =  "Mail has been sent successfully!";
  } else {
    $msg = "Something went wrong. Please try again later!";
  }
}







?>




<div class="content-wrapper">



  <!-- Main content -->
  <section class="content">


    <div style="width:100%">
      <div class="box box-default">
        <div class="box-header with-border">

          <div class="row">
            <h2 class="text-center">MAIL MANAGEMENT</h2>
            </br>
            </br>
            <hr>
            </hr>
            <div class="box-header with-border">
              <?php if ($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" . "</br></br>";  ?>
              </br>
              <!-- <form id="form" class="form-horizontal" action="">
                <legend>Send Mail To An Investor</legend>
                <div class="form-group" style="display: flex;align-items : center; flex-direction : column;">
                  <div class="form-group field" style="width: 90%;">
                    <input type="text" name="from_name" id="from_name" placeholder="Email Sender" class="form-control">
                  </div>

                  <div class="form-group field" style="width: 90%;">
                    <input type="text" name="subject" id="subject" placeholder="Email Subject" class="form-control">
                  </div>

                  <div class="form-group field" style="width: 90%;">
                    <input type="email" name="to_email" id="to_email" placeholder="Recipient Email" class="form-control">
                  </div>

                  <div class="form-group field" style="width: 90%;">
                    <textarea name="message" id="message" placeholder="Write your mail here" class="form-control"></textarea>
                  </div>

                  <div class="field" style="display: none;">
                    <label for="reply_to">reply_to</label>
                    <input type="text" name="reply_to" id="reply_to">
                  </div>

                  <button type="submit" style="background: #333e35;width : 30%;padding : 4px" class="btn btn-primary p-4" id="button" value="Send Email"> <i class="fa fa-send"></i>&nbsp; Send Mail </button>
              </form> -->
              <form id="form" class="form-horizontal">
              <legend>Send Mail To An Investor</legend>
                <div class="field">
                  <label for="from_name">from_name</label>
                  <input type="text" name="from_name" id="from_name" value="BinaWealth" class="form-control" required>
                </div>
                <div class="field">
                  <label for="subject">subject</label>
                  <input type="text" name="subject" id="subject" class="form-control" required>
                </div>
                <div class="field">
                  <label for="to_email">Username</label>
                  <input type="text" name="to_email" id="to_email" class="form-control" required>
                </div>
                <div class="field">
                  <label for="message">message</label>
                  <input type="text" name="message" id="message" class="form-control" required>
                </div>
                <div class="field">
                  <label for="email">Investors's email</label>
                  <input type="text" name="email" id="email" class="form-control" required>
                </div>

                <input type="submit" style="background: #333e35;width : 30%;padding : 8px;margin-top : 10px;" class="btn btn-primary p-4" id="button" value="Send Email">
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

<script type="text/javascript">
  emailjs.init('E-TbbX_1e5TWs042y')
</script>

<script>
  const btn = document.getElementById('button');

  document.getElementById('form')
    .addEventListener('submit', function(event) {
      event.preventDefault();

      btn.value = 'Sending...';

      const serviceID = 'default_service';
      const templateID = 'template_egruvjl';

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
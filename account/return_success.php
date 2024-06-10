<?php
session_start(); 
include "../conn.php";
include "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$amount = $_POST['PAYMENT_AMOUNT'];

$exp_id = explode("_", $_POST['PAYMENT_ID']);
$uid = $exp_id[0];
$pid = $exp_id[1];


		 $sql1 = "SELECT * FROM users WHERE id = '$uid' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){

        $row1 = mysqli_fetch_assoc($result);
        $email = $row1['email'];
        $username = $row1['username'];
        
    }

   include_once "../PHPMailer/PHPMailer.php";
              require_once '../PHPMailer/Exception.php';
            
              $mail= new PHPMailer();
              $mail->setFrom($emaila);
               $mail->FromName = $name;
              $mail->addAddress($email);
              $mail->Subject = "Deposit Alert!";
              $mail->isHTML(true);
              $mail->Body = '
            <div style="background: #f5f7f8;width: 100%;height: 100%; font-family: sans-serif; font-weight: 100;" class="be_container"> 
            
            <div style="background:#fff;max-width: 600px;margin: 0px auto;padding: 30px;"class="be_inner_containr"> <div class="be_header">
            
            <div class="be_logo" style="float: left;"> <img src="https://'.$bankurl.'/admin/c2wad/logo/'.$logo.'"> </div>
            
            <div class="be_user" style="float: right"> <p>Dear: '.$username.'</p> </div> 
            
            <div style="clear: both;"></div> 
            
            <div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">
            
            <h1>Thank you for investing on '.$name.'</h1>
            
            </div> </div> 
            
            <div class="be_body" style="padding: 20px;"> <p style="line-height: 25px; color:#000;"> 
            
            Your deposit of '.$amount.' USD through Perfect Money has been approved and your Trading is now active! Thank for investing in us.
            
            
            </p>
            
            <div class="be_footer">
            <div style="border-bottom: 1px solid #ccc;"></div>
            
            
            <div class="be_bluebar" style="background: #1976d2; padding: 20px; color: #fff;margin-top: 10px;">
            
            <p> Please do not reply to this email. Emails sent to this address will not be answered. 
            Copyright ©'.$cy.' '.$name.'. </p> <div class="be_logo" style=" width:60px;height:40px;float: right;"> </div> </div> </div> </div></div>' ;
            
            
            
              if($mail->send()){
              $_SESSION['email']=$email;
                         echo "<script>
                
                alert('Your deposit of ".$amount." USD through Perfect Money has been approved and your Trading is now active! Thank for investing in us.');
                window.location.href='history.php';
                </script>";     
            
              }
              

?>
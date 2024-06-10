<?php
session_start();


include "../../conn.php";
include "../../config.php";

$msg = "";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION['uid'])) {
} else {


  header("location:../c2wadmin/signin.php");
}


if (isset($_POST['set'])) {

  $ids = $_POST['id'];
  $sname = $_POST['sname'];
  $wl = $_POST['wl'];
  $rb = $_POST['rb'];
  $currency = $_POST['currency'];
  $branch = $_POST['branch'];
  $bname = $_POST['bname'];
  $baddress = $_POST['baddress'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $title = $_POST['title'];
  $logo = $_FILES['logo']['name'];
  $target = "logo/" . basename($logo);
  $scy = $_POST['cy'];

  $bwallet = $_POST['bwallet'];
  $usdtTRC20 = $_POST['usdtTRC20'];
  $ethereum = $_POST['ethereum'];

  $sql = "SELECT email FROM settings WHERE id = '$ids'";
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) > 0) {
    $msg = 'Settings already added.';
  } else {

    if ($logo != "") {
      $sql = "INSERT INTO settings (sname, wl, rb, currency, branch, bname, baddress, email, phone, title, logo, cy, bwallet, usdtTRC20, ethereum  ) VALUES ('$sname','$wl','$rb','$currency','$branch','$bname','$baddress','$email','$phone','$title','$logo','$scy','$bwallet', '$usdtTRC20', '$ethereum')";
    } else {
      $sql = "INSERT INTO settings (sname, wl, rb, currency, branch, bname, baddress, email, phone, title, cy, bwallet, usdtTRC20, ethereum) VALUES ('$sname','$wl','$rb','$currency','$branch','$bname','$baddress','$email','$phone','$title','$scy', '$bwallet', '$usdtTRC20', '$ethereum')";
    }
    if (mysqli_query($link, $sql)) {

      if ($logo != "") {
        move_uploaded_file($_FILES['logo']['tmp_name'], $target);
      }

      $msg = "Settings Added!";
    } else {

      $msg = "Settings Not Added!";
    }
  }
}




if (isset($_POST['uset'])) {
  $ids = $_POST['id'];
  $sname = $_POST['sname'];


  $bname = $_POST['bname'];
  $email = $_POST['email'];
  $mw = $_POST['mw'];
  $title = $_POST['title'];
  // $logo = $_FILES['logo']['name'];
  // $target = "logo/" . basename($logo);
  $scy = $_POST['cy'];

  $bwallet = $_POST['bwallet'];
  $usdtTRC20 = $_POST['usdtTRC20'];
  $ethereum = $_POST['ethereum'];



  if ($logo != "") {
    $sql = "UPDATE settings SET
      sname='$sname', bname='$bname', email='$email', mw='$mw', title='$title', cy='$scy',bwallet='$bwallet',usdtTRC20='$usdtTRC20',ethereum='$ethereum'   =   WHERE id = '$ids' ";
  } else {
    $sql = "UPDATE settings SET  sname='$sname', bname='$bname', email='$email', mw='$mw', title='$title', cy='$scy',bwallet='$bwallet',usdtTRC20='$usdtTRC20',ethereum='$ethereum' WHERE id = '$ids' ";
  }

  // if (mysqli_query($link, $sql)) {
  //   if ($logo != "") {
  //     move_uploaded_file($_FILES['logo']['tmp_name'], $target);
  //   }
  //   $msg = "Settings Updated!";
  // } else {

  //   $msg = "Settings Not Updated!";
  // }
}



include "header.php";






?>


<div class="content-wrapper">



  <!-- Main content -->
  <section class="content">




    <div style="width:100%">
      <div class="box box-default">
        <div class="box-header with-border">

          <div class="row">


            <h2 class="text-center">CONFIGURATION</h2>
            </br>





            <hr>
            </hr>



            <div class="box-header with-border">

              <?php if ($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" . "</br></br>";  ?>
              </br>

              <form class="form-horizontal" action="settings.php?id=<?php echo $ids; ?>" method="POST" enctype="multipart/form-data">

                <legend> <?php echo $name; ?> Settings </legend>

                <div class="form-group">
                  <input type="hidden" name="id" value="<?php echo $ids; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" name="sname" placeholder="site url" value="<?php echo $bankurl; ?>" class="form-control">
                </div>









                <div class="form-group">
                  <input type="text" name="bname" placeholder="Name" value="<?php echo $name; ?>" class="form-control">
                </div>






                <div class="form-group">
                  <input type="text" name="email" placeholder="email" value="<?php echo $emaila; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <input type="text" name="mw" placeholder="Minimum Withdrawal" value="<?php echo $mw; ?>" class="form-control">
                </div>



                <div class="form-group">
                  <input type="text" name="title" placeholder="title" value="<?php echo $title; ?>" class="form-control">
                </div>


                <div class="form-group">
                  <input type="text" name="cy" placeholder="Copyright Year" value="<?php echo $cy; ?>" class="form-control">
                </div>


                <div class="form-group">
                  <input type="text" name="bwallet" placeholder="bitcoin wallet" value="<?php echo $bwallet; ?>" class="form-control">
                </div>


                <div class="form-group">
                  <input type="text" name="usdtTRC20" placeholder="usdt wallet" value="<?php echo $usdtTRC20; ?>" class="form-control">
                </div>


                <div class="form-group">
                  <input type="text" name="ethereum" placeholder="ethereum wallet" value="<?php echo $ethereum; ?>" class="form-control">
                </div>

                <!-- <div class="form-group">
                  <input type="file" name="logo" placeholder="logo" value="<?php echo $logo; ?>" class="form-control">
                </div> -->








                <button style="" type="submit" class="btn btn-success" name="uset"> <i class="fa fa-send"></i>&nbsp; Update Settings </button>

              </form>


            </div>
          </div>

        </div>
      </div>
  </section>
</div>
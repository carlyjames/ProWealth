<?php
session_start();
include "../conn.php";
include "../config.php";

if (isset($_SESSION['email'])) {

  $email = $link->real_escape_string($_SESSION['email']);

  $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($link, $sql1);
  if (mysqli_num_rows($result) > 0) {

    $row1 = mysqli_fetch_assoc($result);
    $ubalance = isset($row1['balance']) ? round($row1['balance'], 2) : 0;
    $balance = isset($row1['refbonus']) ? round($row1['refbonus'], 2) : 0;
    $profit = isset($row1['profit']) ? round($row1['profit'], 2) : 0;
    $username = $row1['username'];
    $udate = $row1['date'];
    $uip = $row1['ip'];
    $ulast_login = $row1['last_login'];
    $uprofit = isset($row1['profit']) ? round($row1['profit'], 2) : 0;
    $referred = $row1['referred'];
  } else {


    header("location: ../SignIn.php");
  }
} else {
  header('location: ../SignIn.php');
  die();
}

$btcbal = 0;
$ltcbal = 0;
$dashbal = 0;
$ethbal = 0;
$bitcashbal = 0;
$pmbal = 0;

$sql_qry1 = "SELECT SUM(usd) AS count FROM btc WHERE email='$email' AND type = 'Withdrawal' AND status = 'successful' ";

if ($duration1 = $link->query($sql_qry1)) {
    while ($record1 = $duration1->fetch_array()) {
        if (isset($record1['count'])) {
            $withdraw1 = round($record1['count'], 2);
        } else {
            $withdraw1 = 0;
        }
    }
} else {
    $withdraw1 = 0;
}

$sql_qry12 = "SELECT SUM(usd) AS total_value FROM investment WHERE email='$email' AND activate = '1'";

if ($duration12 = $link->query($sql_qry12)) {
  $record12 = $duration12->fetch_array();
  if ($record12['total_value'] != "") {
    $withdraw12 = round($record12['total_value'], 2);
  } else {
    $withdraw12 = 0;
  }
} else {
  $withdraw12 = 0;
}


////////

$sql_qry = "SELECT SUM(usd) AS counter FROM btc WHERE email='$email' AND type = 'Deposit' AND status = 'approved' ";

if ($duration = $link->query($sql_qry)) {
    while ($record = $duration->fetch_array()) {
        if (isset($record['counter'])) {
            $deposit1 = round($record['counter'], 2);
        } else {
            $deposit1 = 0;
        }
    }
} else {
    $deposit1 = 0;
}

$sql11 = "SELECT * FROM btc WHERE email = '$email' AND type = 'Deposit' AND status = 'approved' ORDER BY id DESC";
$result11 = mysqli_query($link, $sql11);
if (mysqli_num_rows($result11) > 0) {
  $row11 = mysqli_fetch_assoc($result11);
  $lastdepo = round($row11['usd'], 2);
} else {
  $lastdepo = 0;
}

$sql12 = "SELECT * FROM btc WHERE email = '$email' AND type = 'Withdrawal' AND status = 'successful' ORDER BY id DESC";
$result12 = mysqli_query($link, $sql12);
if (mysqli_num_rows($result12) > 0) {
  $row12 = mysqli_fetch_assoc($result12);
  $lastwth = round($row12['usd'], 2);
} else {
  $lastwth = 0;
}

$sql12f = "SELECT SUM(profit) as profit_value FROM investment WHERE email = '$email'";
$result12f = mysqli_query($link, $sql12f);
$row12f = mysqli_fetch_assoc($result12f);
if ($row12f['profit_value'] != "") {

  $total_earned = round($row12f['profit_value'], 2);
} else {
  $total_earned = 0;
}


$sql44 = "SELECT * FROM investment WHERE email='$email' ORDER BY id DESC ";
$result = mysqli_query($link, $sql44);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {

    $pdate = $row['pdate'];
    $duration = $row['duration'];
    $increase = $row['increase'];
    $usd = $row['usd'];
    $uid = $row['id'];

    $date = $row['pdate'];
    $payday = $row['payday'];
    $lprofit = $row['lprofit'];

    $paypackage = new DateTime($payday);
    $payday = $paypackage->format('Y/m/d');


    if (isset($row['pdate']) &&  $row['pdate'] != '0' && isset($row['duration'])  && isset($row['increase'])  && isset($row['usd'])) {

      if ($row['activate'] == 0) {
        $endpackage = new DateTime($pdate);
        $endpackage->modify('+ ' . $duration . 'day');
        $Date2 = $endpackage->format('Y/m/d');
        $days = 0;
      } else {



        $endpackage = new DateTime($pdate);
        $endpackage->modify('+ ' . $duration . 'day');
        $Date2 = $endpackage->format('Y/m/d');
        $current = date("Y/m/d");

        $diff = abs(strtotime($Date2) - strtotime($current));
        $one = 1;

        $date3 = new DateTime($Date2);
        $date3->modify('+' . $one . 'day');
        $date4 = $date3->format('Y/m/d');

        $days = floor($diff / (60 * 60 * 24));


        $daily = $duration - $days;




        $one = 1;
        $f = date('Y-m-d', strtotime($Date2 . ' + ' . $one . 'day'));


        if ($payday != $current && $payday < $current) {

          if ($current <= $Date2) {
          }
        }


        if (isset($days) && $days == 0 || $Date2 == (date("Y/m/d")) || (date("Y/m/d")) >= $Date2) {


          $percentage = ($increase / 100) * $duration * $usd;
          $allprofit = $percentage - $lprofit;
          $pp =   $allprofit;
          $ppr = $pp + $usd;

          $_SESSION['pprofit'] = $percentage;
          $sql = "UPDATE users SET balance = balance + $pp, profit = profit + $pp  WHERE email='$email'";

          $sql13 = "UPDATE investment SET activate = '0', profit = '$percentage', payday = '$current'  WHERE email='$email' AND id = '$uid'";


          if (mysqli_query($link, $sql)) {
            mysqli_query($link, $sql13);

            $percentage = $pp = 0;

            $Date2 = 0;
            $current = 0;
            $duration = 0;

            $days = 'package completed &nbsp;&nbsp;<i style="color:green; font-size:20px;" class="fa  fa-check" ></i>';
            $days = 0;

            $current = 0;
            $duration = 0;
          }
        } else {

          if ($payday == $current) {
          } else {

            $percentage = ($increase / 100) * $daily * $usd;

            $allprofit = $percentage - $lprofit;

            $sql131 = "UPDATE investment SET profit = '$percentage', payday = '$current', lprofit = '$percentage' WHERE email='$email' AND id = '$uid'";
            $sql21 = "UPDATE users SET balance = balance + $allprofit, profit = profit + $allprofit  WHERE email='$email'";

            mysqli_query($link, $sql131);
            mysqli_query($link, $sql21);
          }
        }
        $add = "days";
      }
    }
    if (isset($_SESSION['pprofit'])) {

      $profit = $_SESSION['pprofit'];
    } else {
      //session_destroy($_SESSION['pprofit']);
      $profit = "";
    }




    $sql40 = "SELECT * FROM investment WHERE email='$email' AND id = '$uid'";
    $result40 = mysqli_fetch_assoc(mysqli_query($link, $sql40));
    $percentage = $result40['profit'];


    if (isset($result40['activate']) &&  $result40['activate'] == '1') {

      $mim = 1;
      $sec = 'Active &nbsp;&nbsp;<i style="background-color:green;color:#fff; font-size:20px;" class="fa  fa-refresh" ></i>';
    } else {
      $mim = 0;
      $sec = 'Completed &nbsp;&nbsp;<i style="color:green; font-size:20px;" class="fa  fa-check" ></i>';
    }
  }
}



$sqld = "SELECT * FROM btc WHERE email='$email' AND status='confirmed' AND type='Deposit'";
$resultut = mysqli_query($link, $sqld);
if (mysqli_num_rows($resultut) > 0) {
  while ($row = mysqli_fetch_assoc($resultut)) {
    $tx_date = strtotime($row['date']) + $row['timeout'];

    $cdate = date('Y-m-d H:i:s');
    $ucdate = strtotime(date('Y-m-d H:i:s'));

    $tnx_id = $row['tnxid'];
    $ustatus = $row['status'];
    $upname = $row['account'];
    $uemail = $row['email'];
    $uamount = $row['usd'];
    $uallamount = $row['allamount'];

    if ($ucdate > $tx_date) {

      $sqld1 = "DELETE FROM btc WHERE tnxid='$tnx_id'";
      mysqli_query($link, $sqld1);
    } else {


      // Fill these in from your API Keys page
      $public_key = $pbkey;
      $private_key = $prikey;

      //Set the API command and required fields
      $req['version'] = 1;
      $req['cmd'] = 'get_tx_info';
      $req['txid'] = $tnx_id;
      $req['key'] = $public_key;
      $req['format'] = 'json'; //supported values are json and xml

      // Generate the query string
      $post_data = http_build_query($req, '', '&');

      // Calculate the HMAC signature on the POST data
      $hmac = hash_hmac('sha512', $post_data, $private_key);

      // Create cURL handle and initialize (if needed)
      static $ch = NULL;
      if ($ch === NULL) {
        $ch = curl_init('https://www.coinpayments.net/api.php');
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      }
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

      // Execute the call and close cURL handle
      $data = curl_exec($ch);
      // Parse and return data if successful.
      if ($data !== FALSE) {
        if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
          // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
          $result = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        } else {
          $result = json_decode($data, TRUE);
        }
        if ($result !== NULL && count($result)) {


          if ($result['error'] == "ok") {
            $status = $result['result']['status'];
            $amount1 = $result['result']['receivedf'];




            $sql121 = "SELECT * FROM package1 WHERE pname = '$upname' LIMIT 1";
            $result21 = mysqli_query($link, $sql121);
            if (mysqli_num_rows($result21) > 0) {

              $row121 = mysqli_fetch_assoc($result21);
              $uincrease = $row121['increase'];
              $utype = $row121['type'];
              $uduration = $row121['duration'];
              $ufrom = $row121['froms'];
              $uto = $row121['tos'];
            }




            if ($status >= 100 || $status == 2) {

              // Check amount against order total
              if ($amount1 < $uallamount) {
                errorAndDie('Amount is less than order total!');
              } else {

                // payment is complete or queued for nightly payout, success

                $sql = "UPDATE btc SET status = 'approved' WHERE tnxid = '$tnx_id'";

                mysqli_query($link, $sql);

                $sql22 = "INSERT INTO investment (email,pname,increase,bonus,duration,pdate,froms,activate,usd,payday)
VALUES ('$uemail','$upname','$uincrease','0','$uduration','$cdate','$ufrom','1','$uamount','$cdate')";
                mysqli_query($link, $sql22);

                if ($referred != "") {

                  $refb = ($uamount / 100) * 5;
                  $sql6 = "UPDATE users SET refbonus = refbonus + $refb, balance = balance + $refb  WHERE refcode ='$referred'";
                  mysqli_query($link, $sql6);
                }
              }
            } elseif ($status == 0) {
            } else {
            }
          } else {
          }
        } else {
          // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message

        }
      } else {
      }
    }
  }
}


$sql1wth = "SELECT * FROM btc WHERE email = '$email' AND type = 'Deposit' AND status = 'confirmed'";
$resultwth = mysqli_query($link, $sql1wth);
if (mysqli_num_rows($resultwth) > 0) {
  while ($row1wth = mysqli_fetch_assoc($resultwth)) {

    if ($row1wth['cointype'] == "Bitcoin") {
      $btcbal = $ubalance;
    }
    if ($row1wth['cointype'] == "Litecoin") {
      $ltcbal = $ubalance;
    }
    if ($row1wth['cointype'] == "Dash") {
      $dashbal = $ubalance;
    }
    if ($row1wth['cointype'] == "ETH") {
      $ethbal = $ubalance;
    }
    if ($row1wth['cointype'] == "Bitcoin Cash") {
      $bitcashbal = $ubalance;
    }
    if ($row1wth['cointype'] == "Perfect Money") {
      $pmbal = $ubalance;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Codescandy">

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-M8S4MT3EYG');
  </script>


  <!-- Favicon icon-->
  <link rel="apple-touch-icon" sizes="180x180" href="../temp/favicon/apple-touch-icon.png">
  <link rel="icon" href="favicon.ico" />
  <link rel="icon" type="image/png" sizes="16x16" href="../temp/favicon/favicon-16x16.png">
  <link rel="manifest" href="../temp/favicon/site.webmanifest">

  <!-- Libs CSS -->
  <link href="./assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="./assets/libs/bootstrap-icons/font/bootstrap-icons.css"> -->
  <link href="./assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="./assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">



  <!-- Theme CSS -->
  <link rel="stylesheet" href="./assets/css/theme.min.css">
  <title>Dashboard | BinaWealth</title>
</head>

<body>
  <main id="main-wrapper" class="main-wrapper">
    <div class="header">
      <!-- navbar -->
      <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">
          <a class="navbar-brand d-block d-md-none" href="../index.php">
            <img width="300px" src="./logo.svg" alt="Image">
          </a>



          <a id="nav-toggle" class="ms-auto ms-md-0 me-0 me-lg-3 ">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
              <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
            </svg></a>

          <div class="d-none d-md-none d-lg-block">
            <!-- Form -->
            <form action="#">


              <div class="input-group ">
                <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
                <span class="input-group-append">
                  <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                  </button>
                </span>
              </div>
            </form>
          </div>
          <!--Navbar nav -->
          <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">
            <a href="#" class="form-check form-switch theme-switch btn btn-ghost btn-icon rounded-circle mb-0 ">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
              <label class="form-check-label" for="flexSwitchCheckDefault"></label>

            </a>
            </li>

            <li class="dropdown stopevent ms-2">
              <a class="btn btn-ghost btn-icon rounded-circle" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-xs" data-feather="bell"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                <div>
                  <div class="border-bottom px-3 pt-2 pb-3 d-flex
              justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                    <a class="text-muted">
                      <span>
                        <i class="me-1 icon-xs" data-feather="settings"></i>
                      </span>
                    </a>
                  </div>
                  <div data-simplebar style="height: 250px;">
                    <!-- List group -->
                    <ul class="list-group list-group-flush notification-list-scroll">
                      <!-- List group item -->
                      <li class="list-group-item">
                        <a class="text-muted">
                          <h5 class=" mb-1">Welcome onboard</h5>
                          <p class="mb-0">
                            hello <?php echo $username; ?> welcome to BinaWealth, click on make deposit to get started.
                          </p>
                        </a>
                      </li>
                      <!-- List group item -->
                      <li class="list-group-item bg-light">
                        <a class="text-muted">
                          <h5 class=" mb-1">Make Deposit</h5>
                          <p class="mb-0">
                            Click on the make deposit button to fund account and start investing today
                          </p>
                        </a>
                      </li>
                      <!-- List group item -->
                      <li class="list-group-item">
                        <a class="text-muted">
                          <h5 class=" mb-1">View investment plans</h5>
                          <p class="mb-0">
                            Check out our investment plans and make a deposit to get started.
                          </p>
                        </a>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
            </li>
            <!-- account profile -->
            <li class="dropdown ms-2">
              <a class="rounded-circle" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                  <img alt="avatar" src="./assets/images/avatar/avatar-11.jpg" class="rounded-circle">
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                <div class="px-4 pb-0 pt-2">
                  <!-- username -->
                  <div class="lh-1 ">
                    <h5 class="mb-1"> <?php echo $username; ?></h5>
                  </div>
                  <div class=" dropdown-divider mt-3 mb-2"></div>
                </div>

                <ul class="list-unstyled">

                  <li>
                    <a class="dropdown-item d-flex align-items-center">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Registration Date
                    </a>
                    <a class="dropdown-item d-flex align-items-center">
                      <?php echo $udate; ?>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item d-flex align-items-center">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Last Access:
                    </a>
                    <a class="dropdown-item d-flex align-items-center">
                      date
                    </a>
                  </li>

                  <li>
                    <a class="dropdown-item" href="logout.php">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
                    </a>
                  </li>
                </ul>

              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- navbar vertical -->
    <!-- Sidebar -->

    <div class="navbar-vertical navbar nav-dashboard">
      <div class="h-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="../index.php">
          <img  src="./logo.svg" alt="logo">
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-expanded="true" aria-controls="navDashboard">
              <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
              Dashboard
            </a>

            <div id="navDashboard" class="collapse show" data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link has-arrow   active" href="index.php">
                    Account
                  </a>

                </li>
              </ul>
            </div>

          </li>

          <!-- Nav item -->
          <li class="nav-item">
            <div class="navbar-heading">Apps</div>
          </li>
          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow " href="#!" data-bs-toggle="collapse" data-bs-target="#navecommerce" aria-expanded="false" aria-controls="navecommerce">
              <i data-feather="shopping-cart" class="nav-icon me-2 icon-xxs">
              </i> Deposit
            </a>

            <div id="navecommerce" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">

                <li class="nav-item">
                  <a class="nav-link has-arrow " href="./deposit.php">

                    Make Deposit
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navKanban" aria-expanded="false" aria-controls="navKanban">
              <i data-feather="layout" class="nav-icon me-2 icon-xxs">
              </i> Active Plans
            </a>
            <div id="navKanban" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link has-arrow " href="ActiveDeposits.php">
                    My Active Plans
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <!-- Nav item -->
          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navinvoice" aria-expanded="false" aria-controls="navinvoice">
              <i data-feather="clipboard" class="nav-icon me-2 icon-xxs">
              </i> Withdrawal
            </a>
            <div id="navinvoice" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">

                <li class="nav-item">
                  <a class="nav-link has-arrow " href="./Withdrawal.php">
                    Place Withdrawal
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link   collapsed  " href="#!" data-bs-toggle="collapse" data-bs-target="#navprofilePages" aria-expanded="false" aria-controls="navprofilePages">

              <i data-feather="user" class="nav-icon me-2 icon-xxs">
              </i> Profile
            </a>
            <div id="navprofilePages" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link " href="./profile.php">
                    Settings
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navblog" aria-expanded="false" aria-controls="navblog">
              <i data-feather="edit" class="nav-icon me-2 icon-xxs">
              </i> Transactions
            </a>

            <div id="navblog" class="collapse" data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link has-arrow" href="Transactions.php">

                    Transaction History
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>


    <!-- page content -->
    <div id="app-content">
      <div class="app-content-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="d-flex justify-content-between mb-5 align-items-center">
                <h3 class="mb-0 ">Your Account</h3>
                <!-- <a  class="btn btn-primary">Add Product</a> -->
              </div>
            </div>
          </div>
          <!-- dashboard details -->
          <div class="row row-cols-1  row-cols-xl-4 row-cols-md-2 ">
            <div class="col mb-5">
              <div class="card h-100 card-lift">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted fw-semi-bold ">Username</span>
                    <span><i data-feather="user" class="text-info"></i></span>

                  </div>
                  <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                    <h3 class="fw-bold  mb-0"><?php echo $username; ?></h3>
                  </div>
                  <!-- <a class="btn-link ">Joined : <?php echo $udate; ?></a> -->
                </div>
              </div>
            </div>
            <div class="col mb-5" >
              <div class="card h-100 card-lift" style="background-color: #3b82f6;">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text fw-semi-bold " style="color: white;">Auto Trading Bot</span>
                    <!-- <span><i data-feather="shopping-cart" class="text-info" style="color: white;"></i></span> -->

                  </div>
                  <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                    <a href="./deposit.php">
                      <h3 class="fw-bold  mb-0" style="color: white;">Start Trade</h3>
                    </a>
                    <!-- <span class="mt-1 ms-2 text-success "><i data-feather="arrow-up" class="icon-xs"></i>2.29%</span> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-5">
              <div class="card h-100 card-lift">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted fw-semi-bold ">Earned Total</span>
                    <span><i data-feather="dollar-sign" class="text-info"></i></span>

                  </div>
                  <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                    <h3 class="fw-bold  mb-0">$<?php echo $profit; ?></h3>
                    <!-- <span class="mt-1 ms-2 text-success "><i data-feather="arrow-up" class="icon-xs"></i>2.29%</span> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-5">
              <div class="card h-100 card-lift">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted fw-semi-bold ">Account Balance</span>
                    <span><i data-feather="credit-card" class="text-info"></i></span>

                  </div>
                  <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                    <h3 class="fw-bold  mb-0">$<?php echo $profit; ?></h3>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row ">
            <div class="col-xl-12 col-12 mb-5">
              <div class="card h-100">
                <!-- crypto chart -->
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4 class="mb-0">Market Overview</h4>
                </div>
                <div class="card-body">
                  <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on
                          TradingView</span></a></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
                      {
                        "symbols": [
                          [
                            "OANDA:EURUSD|1D"
                          ],
                          [
                            "FX:GBPUSD|1D"
                          ],
                          [
                            "FX:AUDUSD|1D"
                          ],
                          [
                            "FX:NZDUSD|1D"
                          ],
                          [
                            "BINANCE:BTCUSDT|1D"
                          ],
                          [
                            "BINANCE:ETHUSDT|1D"
                          ],
                          [
                            "BINANCE:MATICUSDT|1D"
                          ],
                          [
                            "BINANCE:LINKUSDT|1D"
                          ],
                          [
                            "COINBASE:SOLUSD|1D"
                          ],
                          [
                            "NSE:NIFTY|1D"
                          ],
                          [
                            "TVC:DXY|1D"
                          ],
                          [
                            "SP:SPX|1D"
                          ],
                          [
                            "FRED:FEDFUNDS|1D"
                          ],
                          [
                            "ECONOMICS:USINTR|1D"
                          ],
                          [
                            "NASDAQ:TSLA|1D"
                          ],
                          [
                            "NASDAQ:AAPL|1D"
                          ],
                          [
                            "NASDAQ:NVDA|1D"
                          ],
                          [
                            "NASDAQ:QQQ|1D"
                          ]
                        ],
                        "chartOnly": false,
                        "width": "100%",
                        "height": "100%",
                        "locale": "en",
                        "colorTheme": "light",
                        "autosize": true,
                        "showVolume": false,
                        "showMA": false,
                        "hideDateRanges": false,
                        "hideMarketStatus": false,
                        "hideSymbolLogo": false,
                        "scalePosition": "right",
                        "scaleMode": "Normal",
                        "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
                        "fontSize": "10",
                        "noTimeScale": false,
                        "valuesTracking": "1",
                        "changeMode": "price-and-percent",
                        "chartType": "area",
                        "maLineColor": "#2962FF",
                        "maLineWidth": 1,
                        "maLength": 9,
                        "lineWidth": 2,
                        "lineType": 0,
                        "dateRanges": [
                          "1d|5",
                          "5d|5",
                          "1m|30",
                          "3m|60",
                          "12m|1D",
                          "60m|1W",
                          "all|1M"
                        ],
                        "downColor": "#f7525f",
                        "upColor": "#22ab94",
                        "borderUpColor": "#22ab94",
                        "borderDownColor": "#f7525f",
                        "wickUpColor": "#22ab94",
                        "wickDownColor": "#f7525f"
                      }
                    </script>
                  </div>

                </div>
              </div>
            </div>

          </div>
          <!-- deposit information -->
          <div class="row">
            <div class="col-xl-12 col-lg-12 mb-5">
              <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center ">
                  <h4 class="mb-0">Deposit Information</h4>
                </div>
                <div class="card-body ">
                  <div class="table-responsive table-card">
                    <table class="table text-nowrap mb-0 table-centered">
                      <thead class="table-light ">
                        <tr>
                          <th>Deposit</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><a class="text-inherit">Total Deposit</a></td>
                          <td class="  text-dark">$<?php echo $balance; ?></td>
                        </tr>
                        <tr>
                          <td><a class="text-inherit">Active Deposit</a></td>
                          <td class="  text-dark">$<?php echo $balance; ?></td>
                        </tr>
                        <tr>
                          <td><a class="text-inherit">Last Deposit</a></td>
                          <td class="  text-dark">$<?php echo $balance; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <a href="deposit.php" class="btn btn-primary mx-4 mb-2">Make Deposit</a>
                <?php
                if ($balance > 0) {
                  // User has more than $0 balance, display the withdraw button.
                  echo '<a href="Withdrawal.php" class="btn btn-primary mx-4 mb-2">Make Withdrawal</a>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Scripts -->


  <!-- Libs JS -->
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/libs/feather-icons/dist/feather.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.min.js"></script>




  <!-- Theme JS -->
  <script src="./assets/js/theme.min.js"></script>
  <!-- jsvectormap -->
  <script src="./assets/libs/jsvectormap/dist/js/jsvectormap.min.js"></script>
  <script src="./assets/libs/jsvectormap/dist/maps/world.js"></script>
  <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="./assets/js/vendors/chart.js"></script>



</body>

</html>
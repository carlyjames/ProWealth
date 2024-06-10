<?php
session_start();
include "../conn.php";
include "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg = "";
$date = date('Y-m-d H:i:s');
if (isset($_SESSION['email'])) {

  $email = $link->real_escape_string($_SESSION['email']);

  $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($link, $sql1);
  if (mysqli_num_rows($result) > 0) {

    $row1 = mysqli_fetch_assoc($result);
    $ubalance = round($row1['balance'], 2);
    $username = $row1['username'];
    $btc = $row1['btc'];
    $usdtTRC20 = $row1['usdtTRC20'];
  } else {
    header("location: ../SignIn.php");
  }
} else {
  header('location: ../SignIn.php');
  die();
}

$btcbal = 0;
$usdtTRC20 = 0;



$sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
$result = mysqli_query($link, $sql1);
if (mysqli_num_rows($result) > 0) {

  $row1 = mysqli_fetch_assoc($result);
  $ubalance = round($row1['profit'], 2);

  $btcw = ($row1['btc']);
  $usdtw = ($row1['usdtTRC20']);
}

$sql1wth = "SELECT * FROM btc WHERE email = '$email' ";
$resultwth = mysqli_query($link, $sql1wth);
if (mysqli_num_rows($resultwth) > 0) {
  while ($row1wth = mysqli_fetch_assoc($resultwth)) {
    if ($row1wth['cointype'] == "Bitcoin") {
      $btcbal = $ubalance;
    }
    if ($row1wth['cointype'] == "usdtTRC20") {
      $usdtTRC20 = $usdtTRC20;
    }
  }
} else {
  $btcbal = 0;
  $usdtTRC20 = 0;
}


$title = "Withdrawal";
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
  <link rel="icon" href="favicon.ico" />

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
  <!-- Wrapper -->
  <main id="main-wrapper" class="main-wrapper">
    <div class="header">
      <!-- navbar -->
      <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">
          <a class="navbar-brand d-block d-md-none" href="./index.html">
            <img width="100px" src="./logo.svg" alt="Image">
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
                          <h5 class=" mb-1">View Trading plans</h5>
                          <p class="mb-0">
                            Check out our Trading plans and make a deposit to get started.
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
        <a class="navbar-brand" href="index.php">
          <img src="./logo.svg" alt="logo">
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

          <!-- Nav item -->
          <li class="nav-item">
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-expanded="true" aria-controls="navDashboard">
              <i data-feather="home" class="nav-icon me-2 icon-xxs"></i>
              Dashboard
            </a>

            <div id="navDashboard" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link has-arrow   " href="index.php">
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

            <div id="navinvoice" class="collapse show" data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">

                <li class="nav-item">
                  <a class="nav-link has-arrow active" href="./Withdrawal.php">
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

            <div id="navblog" class="collapse " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link has-arrow " href="./Transactions.php">

                    Transaction History
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Page Content -->
    <div id="app-content">
      <!-- Container fluid -->
      <div class="app-content-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="mb-5">
                <h3 class="mb-0 ">Make Withdrawal</h3>
              </div>
            </div>
          </div>
          <div>
            <!-- row -->
            <div class="row">
              <div class="col-lg-6 col-md-6 col-12 mb-5">
                <div class="card card-lift">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                      <div class="icon-shape icon-md bg-warning-soft text-warning rounded-3">
                        <i data-feather="credit-card" class="icon-xs"></i>
                      </div>
                      <div>
                        <span class="text-success"><i data-feather="arrow-up-right" class="icon-xs"></i>
                          +9.18 %</span>
                      </div>
                    </div>
                    <div>
                      <span class="fw-semi-bold">Account Balance</span>
                      <h3 class="mb-0 mt-1 fw-bold ">
                        $<span class="counter-value" data-target="3156"><?php echo $ubalance; ?></span>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12 mb-5">
                <div class="card card-lift">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                      <div class="icon-shape icon-md bg-info-soft text-info rounded-3">
                        <i data-feather="clock" class="icon-xs"></i>
                      </div>
                      <div>
                        <span class="text-danger"><i data-feather="arrow-down-right" class="icon-xs"></i>
                          0.00 %</span>
                      </div>
                    </div>
                    <div>
                      <span class="fw-semi-bold">Pending Withdrawal</span>
                      <h3 class="mb-0 mt-1 fw-bold ">
                        $<span class="counter-value" data-target="167">0</span>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
              <!-- wallet addresses -->

              <div class="col-lg-6 col-md-6 col-12 mb-5">
                <div class="card card-lift">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                      <div class="icon-shape icon-md bg-info-soft text-success rounded-3">
                        <i data-feather="dollar-sign" class="icon-xs"></i>
                      </div>
                      <div>
                      </div>
                    </div>
                    <div>
                      <span class="fw-semi-bold">Bitcoin</span>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">
                              <h4 class="mb-0 mt-1 fw-bold ">Pending</h4>
                            </th>
                            <th scope="col">
                              <h4 class="mb-0 mt-1 fw-bold text-danger">
                                $<span class="counter-value" data-target="0">0</span>
                              </h4>
                            </th>
                          </tr>
                          <h5 class="mb-0 mt-1 fw-bold text-truncate">
                            <?php echo $btcw; ?>
                          </h5>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12 mb-5">
                <div class="card card-lift">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                      <div class="icon-shape icon-md bg-info-soft text-success rounded-3">
                        <i data-feather="dollar-sign" class="icon-xs"></i>
                      </div>
                      <div>
                      </div>
                    </div>
                    <div>
                      <span class="fw-semi-bold">UsdtTRC20</span>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">
                              <h4 class="mb-0 mt-1 fw-bold ">Pending</h4>
                            </th>
                            <th scope="col">
                              <h4 class="mb-0 mt-1 fw-bold text-danger">
                                $<span class="counter-value" data-target="0">0</span>
                              </h4>
                            </th>
                          </tr>
                          <h5 class="mb-0 mt-1 fw-bold text-truncate">
                            <?php echo $usdtw; ?>
                          </h5>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <form id="form">
                <div class="field" style="display : none">
                  <label for="from_name">from_name</label>
                  <input type="text" name="from_name" id="from_name" value=<?php echo $username; ?>>
                </div>
                <div class="mb-3 row">
                  <label for="amount" class="col-sm-4 col-form-label form-label">Amount to withdraw :</label>
                  <div class="col-md-4 col-12">
                    <input type="number" class="form-control" placeholder="100.00" name="amount" id="amount" required>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="wallet" class="col-sm-4 col-form-label form-label">Wallet to Credit :</label>
                  <div class="col-md-4 col-12">
                    <input type="text" class="form-control" placeholder="Bitcoin or UsdtTRC20" name="wallet" id="wallet" required>
                  </div>
                </div>
                <div class="field" style="display : none">
                  <label for="reply_to">reply_to</label>
                  <input type="text" name="reply_to" id="reply_to" value=<?php echo $email; ?>>
                </div>
                <div class="field" style="display : none">
                  <label for="name">name</label>
                  <input type="text" name="name" id="name" value=<?php echo $username; ?>>
                </div>

                <div class="field" style="display : none">
                  <label for="to_email">to_email</label>
                  <input type="text" name="to_email" id="to_email" value=<?php echo $email; ?>>
                </div>
                <?php
                $userBalance = 100; // Replace this with the actual user's balance value.

                if ($ubalance > 0) {
                  // User has more than $0 balance, display the withdraw button.
                  echo '<input type="submit" id="button" class="btn btn-primary " value="Confirm Withdrawal">';
                }
                ?>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>


    <!-- Scripts -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

    <script type="text/javascript">
      emailjs.init('Hl2cDCdU8MREIuhkf')
    </script>

    <script>
      const btn = document.getElementById('button');

      document.getElementById('form')
        .addEventListener('submit', function(event) {
          event.preventDefault();

          btn.value = 'Confirming...';

          const serviceID = 'default_service';
          const templateID = 'template_cj8cs2k';

          emailjs.sendForm(serviceID, templateID, this)
            .then(() => {
              btn.value = 'Confirm deposit..';
              alert('Sent!');
            }, (err) => {
              btn.value = 'Send Email';
              alert(JSON.stringify(err));
            });
        });
    </script>


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
<?php
session_start();
include "../conn.php";
include "../config.php";

$msg = "";
if (isset($_SESSION['email'])) {

  $email = $link->real_escape_string($_SESSION['email']);

  $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($link, $sql1);
  if (mysqli_num_rows($result) > 0) {

    $row1 = mysqli_fetch_assoc($result);
    $ubalance = round($row1['balance'], 2);
    $username = $row1['username'];
    $udate = $row1['date'];
    $ufname = $row1['fname'];
    $ulast_login = $row1['last_login'];
    $btc = $row1['btc'];
    $usdtTRC20 = $row1['usdtTRC20'];
  } else {
    header("location: ../SignIn.php");
  }
} else {
  header('location: ../SignIn.php');
  die();
}



if (isset($_POST['save'])) {



  // Validate name

  if (empty(trim($_POST["fullname"]))) {
    $msg = "Please enter your full name, !!remove all spacing ";
  } else {
    $fname = $link->real_escape_string($_POST["fullname"]);
  }
  if (trim($_POST["password"]) != "") {
    $password = trim($_POST["password"]);

    if (empty(trim($_POST["password2"]))) {
      $msg = "Please confirm password.";
    } else {
      $cpassword = trim($_POST["password2"]);
      if (empty($msg) && ($password != $cpassword)) {
        $msg = "Password did not match.";
      }
    }
  }


  $btc = $_POST['btc'];
  $usdtTRC20 = $_POST['usdtTRC20'];


  // Check input errors before inserting in database
  if (empty($msg)) {
    // Prepare an insert statement
    if (trim($_POST["password"]) != "") {
      $sql1 = "UPDATE users SET fname = '$fname', password = '$password', btc='$btc', usdtTRC20 = '$usdtTRC20'WHERE email = '$email' ";
      if (mysqli_query($link, $sql1)) {
        echo "<script>
           window.location.href='profile.php?success';
           </script>";
      } else {
        $msg = "Something went wrong. Please try again later.";
      }
    } else {
      $sql1 = "UPDATE users SET fname = '$fname', btc='$btc', usdtTRC20 = '$usdtTRC20' WHERE email = '$email' ";
      if (mysqli_query($link, $sql1)) {
        echo "<script>
               window.location.href='profile.php?success';
               </script>";
      } else {
        $msg = "Something went wrong. Please try again later.";
      }
    }
  }
}


$title = "Account settings";

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
  <title>Profile | BinaWealth</title>
</head>

<body>
  <main id="main-wrapper" class="main-wrapper">
    <div class="header">
      <!-- navbar -->
      <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">
          <a class="navbar-brand d-block d-md-none" href="index.php">
            <img width="100px"  src="./logo.svg" alt="Image">
          </a>
          <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 ">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
              <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
            </svg>
          </a>

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
              <a class="btn btn-ghost btn-icon rounded-circle" href="#!" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            hello, welcome to BinaWealth, click on make
                            deposit to get started.
                          </p>
                        </a>
                      </li>
                      <!-- List group item -->
                      <li class="list-group-item bg-light">
                        <a class="text-muted">
                          <h5 class=" mb-1">Make Deposit</h5>
                          <p class="mb-0">
                            Click on the make deposit button to fund account and start
                            investing today
                          </p>
                        </a>
                      </li>
                      <!-- List group item -->
                      <li class="list-group-item">
                        <a class="text-muted">
                          <h5 class=" mb-1">View Trading plans</h5>
                          <p class="mb-0">
                            Check out our Trading plans and make a deposit to get
                            started.
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
                <ul class="list-unstyled">
                  <li>
                    <a class="dropdown-item" href="logout.php">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign
                      Out
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
            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-expanded="false" aria-controls="navDashboard">
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

            <div id="navecommerce" class="collapse   " data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">

                <li class="nav-item">
                  <a class="nav-link has-arrow  " href="deposit.php    ">

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
                  <a class="nav-link has-arrow " href="Withdrawal.php">
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
            <div id="navprofilePages" class="collapse show" data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="profile.php">
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
                  <a class="nav-link has-arrow " href="Transactions.php">

                    Transaction History
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <div class="card bg-light shadow-none text-center mx-4 my-8">
          <div class="card-body py-6">
            <img src="./assets/images/background/giftbox.png" alt="dash ui - admin dashboard template">
            <div class="mt-4">
              <h5>Unlimited Access</h5>
              <p class="fs-6 mb-4">
                Upgrade your plan to our vip trading group, to select vip Plan. Start Now
              </p>
              <a href="#" class="btn btn-secondary btn-sm">Join Telegram</a>
            </div>
          </div>
        </div>

      </div>
    </div>




    <!-- page content  -->
    <div id="app-content">

      <!-- Container fluid -->
      <div class="app-content-area">
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->

              <div class=" mb-5">
                <h3 class="mb-0 fw-bold">General</h3>

              </div>

            </div>
          </div>
          <div class="row mb-8">
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
              <div class="mb-4 mb-lg-0">
                <h4 class="mb-1">General Setting</h4>
                <p class="mb-0 fs-5 text-muted">Profile configuration settings </p>
              </div>

            </div>

            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
              <!-- card -->
              <div class="card">
                <!-- card body -->
                <div class="card-body">
                  <div class=" mb-6">
                    <h4 class="mb-1">General Settings</h4>
                  </div>
                  <div>
                    <!-- border -->
                    <div class="mb-6">
                      <h4 class="mb-1">Basic information</h4>

                    </div>
                    <script language=javascript>
                      function IsNumeric(sText) {
                        var ValidChars = "0123456789.";
                        var IsNumber = true;
                        var Char;
                        if (sText == '') return false;
                        for (i = 0; i < sText.length && IsNumber == true; i++) {
                          Char = sText.charAt(i);
                          if (ValidChars.indexOf(Char) == -1) {
                            IsNumber = false;
                          }
                        }
                        return IsNumber;
                      }

                      function checkform() {
                        if (document.editform.fullname.value == '') {
                          alert("Please type your full name!");
                          document.editform.fullname.focus();
                          return false;
                        }


                        if (document.editform.password.value != document.editform.password2.value) {
                          alert("Please check your password!");
                          document.editform.password.focus();
                          return false;
                        }





                        for (i in document.editform.elements) {
                          f = document.editform.elements[i];
                          if (f.id && f.id.match(/^pay_account/)) {
                            if (f.value == '') continue;
                            var notice = f.getAttribute('data-validate-notice');
                            var invalid = 0;
                            if (f.getAttribute('data-validate') == 'regexp') {
                              var re = new RegExp(f.getAttribute('data-validate-regexp'));
                              if (!f.value.match(re)) {
                                invalid = 1;
                              }
                            } else if (f.getAttribute('data-validate') == 'email') {
                              var re = /^[^\@]+\@[^\@]+\.\w{2,4}$/;
                              if (!f.value.match(re)) {
                                invalid = 1;
                              }
                            }
                            if (invalid) {
                              alert('Invalid account format. Expected ' + notice);
                              f.focus();
                              return false;
                            }
                          }
                        }

                        return true;
                      }
                    </script>
                    <form action="" method=post onsubmit="return checkform()" name=editform>
                      <?php if ($msg != "") echo "<div class='col-md-12 col-12' style='padding:20px;background-color:#dce8f7;color:black' class='btn btn-success'> $msg</div>" . "</br>";  ?>
                      <?php if (isset($_GET['success']) && $msg == "") echo "<div class='col-md-12 col-12' style='padding:20px;background-color:#dce8f7;color:black' class='btn btn-success'> Profile updated successfully </div>" . "</br>";  ?>

                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="fullName" class="col-sm-4 col-form-label
                                form-label">Account name</label>
                        <div class="col-sm-8 mb-3 mb-lg-0">
                          <input value="<?php echo $username; ?>" type="text" class="form-control" placeholder="Account name" id="fullName" disabled >
                        </div>
                      </div>

                      <!-- row -->
                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="fullName" class="col-sm-4 col-form-label
                                form-label">Registration Date</label>
                        <div class="col-sm-8 mb-3 mb-lg-0">
                          <input value="<?php echo date("F d Y; g:i A", strtotime($udate)); ?>" type="text" class="form-control" placeholder="Registration Date" id="fullName" disabled >
                        </div>
                      </div>

                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="fullName" class="col-sm-4 col-form-label
                                form-label">Full name</label>
                        <div class="col-md-8 col-12">
                          <input value="<?php echo $ufname; ?>" name="fullname" type="text" class="form-control" placeholder="Full name" id="fullName" >
                        </div>
                      </div>

                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="email" class="col-sm-4 col-form-label
                                form-label">Email</label>
                        <div class="col-md-8 col-12">
                          <input value="<?php echo $email; ?>" type="email" class="form-control" placeholder="Email" id="email" disabled >
                        </div>
                      </div>
                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="addressLineTwo" class="col-sm-4 col-form-label form-label">New Password</label>
                        <div class="col-md-8 col-12">
                          <input type=password name=password value="" size=30 class="form-control" placeholder="New Password" id="addressLineTwo" >
                        </div>
                      </div>
                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="addressLineTwo" class="col-sm-4 col-form-label form-label">Retype Password</label>
                        <div class="col-md-8 col-12">
                          <input type=password name=password2 value="" size=30 class="form-control" placeholder="Retype Password" id="addressLineTwo" >
                        </div>
                      </div>

                      <!-- wallet addresses -->

                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="addressLineTwo" class="col-sm-4
                                col-form-label form-label">Your Bitcoin address</label>
                        <div class="col-md-8 col-12">
                          <input type="text" size=30 name="btc" value="<?php echo $btc; ?>" class="form-control" placeholder="Bitcoin" id="addressLineTwo" >
                        </div>
                      </div>
                      <!-- row -->
                      <div class="mb-3 row">
                        <label for="addressLineTwo" class="col-sm-4
                                col-form-label form-label">Your UsdtTRC20 address</label>
                        <div class="col-md-8 col-12">
                          <input type="text" size=30 name="usdtTRC20" value="<?php echo $usdtTRC20; ?>" class="form-control" placeholder="UsdtTRC20" id="addressLineTwo" >
                        </div>
                      </div>
                      <button type=submit name="save" value="Update Account" class="btn btn-primary mb-2">Update Account</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
  <!-- Libs JS -->
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/libs/feather-icons/dist/feather.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.min.js"></script>




  <!-- Theme JS -->
  <script src="./assets/js/theme.min.js"></script>
  <!-- popper js -->
  <script src="./assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>
  <!-- tippy js -->
  <script src="./assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
  <script src="./assets/js/vendors/tooltip.js"></script>
  <script src="./assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="./assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="./assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./assets/js/vendors/datatable.js"></script>
</body>

</html>
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
        $ubalance = round($row1['balance'], 2);
        $username = $row1['username'];
        $udate = $row1['date'];
        $uip = $row1['ip'];
        $ulast_login = $row1['last_login'];
        $referred = $row1['referred'];
    } else {


        header("location: ../SignIn.php");
    }
} else {
    header('location: ../SignIn.php');
    die();
}

$sqld = "SELECT * FROM btc WHERE email='$email' AND status='pending' AND type='Deposit'";
$result = mysqli_query($link, $sqld);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
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

            function coinpayments_api_call($cmd, $txid, $pbkeyt, $prikeyt, $req = array())
            {
                // Fill these in from your API Keys page
                $public_key = $pbkeyt;
                $private_key = $prikeyt;

                //Set the API command and required fields
                $req['version'] = 1;
                $req['cmd'] = $cmd;
                $req['txid'] = $txid;
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
                        $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
                    } else {
                        $dec = json_decode($data, TRUE);
                    }
                    if ($dec !== NULL && count($dec)) {
                        return $dec;
                    } else {
                        // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
                        return array('error' => 'Unable to parse JSON result (' . json_last_error() . ')');
                    }
                } else {
                    return array('error' => 'cURL error: ' . curl_error($ch));
                }
            }

            //Get current coin exchange rates
            $result = coinpayments_api_call('get_tx_info', $tnx_id, $pbkey, $prikey);

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

                        $sql22 = "INSERT INTO Trading (email,pname,increase,bonus,duration,pdate,froms,activate,usd,payday)
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
        }
    }
}




$title = "Transactions";
// include 'header.php'; 
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
    <title>Transaction History | BinaWealth</title>
</head>

<body>
    <main id="main-wrapper" class="main-wrapper">
        <div class="header">
            <!-- navbar -->
            <div class="navbar-custom navbar navbar-expand-lg">
                <div class="container-fluid px-0">
                    <a class="navbar-brand d-block d-md-none" href="../index.php">
                        <img width="100px" src="./logo.svg" alt="Image">
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
                <a class="navbar-brand" href="../index.php">
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
                                    <a class="nav-link has-arrow  " href="deposit.php">

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
                        <div id="navprofilePages" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">
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

                        <div id="navblog" class="collapse show" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link has-arrow active" href="Transactions.php">

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

        <!-- page content -->
        <script language=javascript>
            function go(p) {
                document.opts.page.value = p;
                document.opts.submit();
            }
        </script>


        <div id="app-content">

            <div class="app-content-area">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h3 class="mb-0 ">Transaction History</h3>
                            </div>
                        </div>
                    </div>

                    <!-- transaction History -->
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="card h-100">

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table mb-0 text-nowrap table-centered">
                                            <thead class="table-light">
                                                <tr>

                                                    <th scope="col">Transaction Type</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Plan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ttl = 0;
                                                $sql = "SELECT * FROM btc WHERE email='$email' ORDER BY id DESC ";
                                                $result = mysqli_query($link, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {


                                                ?>
                                                        <tr>
                                                            <td>
                                                                <h5 class="mb-0"><a href="#!" class="text-inherit"><?php echo $row['type']; ?></a></h5>
                                                            </td>
                                                            <td><a href="#!">$<?php echo $row['usd']; ?></a></td>
                                                            <td><?php echo $row['date']; ?></td>
                                                            <td><?php echo $row['plan']; ?></td>
                                                            <td>
                                                                <!-- <span class="badge badge-success-soft">Confirmed</span> -->
                                                                <?php if ($row['status'] == "successful" || $row['status'] == "approved" || $row['status'] == "confirmed") { ?>
                                                                    <span class="badge badge-success-soft"><?php echo $row['status']; ?></span>
                                                                <?php } else { ?>
                                                                    <span class="badge badge-warning-soft"><?php echo $row['status']; ?></span>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip" data-template="trashFour">
                                                                    <i data-feather="trash-2" class="icon-xs"></i>
                                                                    <div id="trashFour" class="d-none">
                                                                        <span>Delete</span>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $ttl = $ttl + $row['usd']; ?>

                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan=5 align=center>No transactions found</td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <!-- apexchart js -->
    <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="./assets/js/vendors/chart.js"></script>
    <!-- popper js -->
    <script src="./assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>
    <!-- tippy js -->
    <script src="./assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
    <script src="./assets/js/vendors/tooltip.js"></script>



</body>

</html>
<?php
session_start();
include "../conn.php";
include "../config.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
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


    <link rel="manifest" href="public/manifest.json">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://connect.facebook.net/signals/config/364442274105321?v=2.9.45&amp;r=stable" async=""></script>
    <script src="https://connect.facebook.net/signals/plugins/identity.js?v=2.9.45" async=""></script>
    <script async="" src="https://connect.facebook.net/en_US/fbevents.js"></script>
    <script async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    <link href="https://psp.transactium.com/hps/Content/css/ezpay.css" rel="stylesheet">
    <script src="https://cdn.ravenjs.com/3.24.0/raven.min.js" crossorigin="anonymous"></script>
    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&amp;display=swap" rel="stylesheet"> -->
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=0.8,height=device-height">
    <title><?php echo $name; ?> PAYMENT</title>

    <link href="public/chunk.css" rel="stylesheet">
    <link href="public/mainchunk.css" rel="stylesheet">

    <script src="https://cdn.lr-ingest.io/logger-1.min.js" async=""></script>
    <style data-styled="active" data-styled-version="5.2.1"></style>
    <style data-jss="" data-meta="Component, Unthemed"></style>
    <style data-jss="" data-meta="makeStyles"></style>
    <script async="" src="https://static.hotjar.com/c/hotjar-1443218.js?sv=6"></script><iframe hidden=""></iframe>
    <script charset="utf-8" src="public/chunk.js"></script>
    <link rel="stylesheet" type="text/css" href="public/btcchunk.css">
    <script charset="utf-8" src="public/btcpage.chunk.js"></script>
    <script async="" src="https://script.hotjar.com/modules.32d4d6c361d45587f461.js" charset="utf-8"></script>
    <style type="text/css">
        iframe#_hjRemoteVarsFrame {
            display: none !important;
            width: 1px !important;
            height: 1px !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
    </style>


    <!-- Libs CSS -->
    <link href="./assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./assets/libs/bootstrap-icons/font/bootstrap-icons.css"> -->
    <link href="./assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="./assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">



    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets/css/theme.min.css">
    <title>Deposit Confirm | bitpulseTrade</title>

</head>


<body>

    <main id="main-wrapper" class="main-wrapper">
        <div class="header">
            <!-- navbar -->
            <div class="navbar-custom navbar navbar-expand-lg">
                <div class="container-fluid px-0">
                    <a class="navbar-brand d-block d-md-none" href="../index.php">
                        <!-- <img height="30px" src="./logo.png" alt="Image"> -->
                    </a>
                    <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
                            <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </a>


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
                                                        hello, welcome to bitpulseTrade, click on make
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
                    <img src="./logo.png" alt="logo">
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

                        <div id="navecommerce" class="collapse  show " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link has-arrow  active " href="deposit.php">

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
                        <div id="navprofilePages" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link " href="profile.php">
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
        <?php

        $sql1 = "SELECT * FROM settings";
        $result1 = mysqli_query($link, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            // var_dump($row); 
            // die;
            if (isset($row['bwallet'])) {
                $bw = $row['bwallet'];
            } else {
                $bw = "";
            }
        }

        if (isset($_POST["proceed"])) {
            $usd = $link->real_escape_string($_POST["amount"]);
            $pname = $link->real_escape_string($_POST["pname"]);

            // $uincrease = $link->real_escape_string($_POST["uduration"]);
            // $uduration = $link->real_escape_string($_POST["uduration"]);

            $type = $link->real_escape_string($_POST["type"]);
            $email = $link->real_escape_string($_POST["email"]);
            $referred = $link->real_escape_string($_POST["referred"]);

            if ($type == "Bitcoin") {
                $coin = "BTC";
                $img = "bitcoin.png";
                $bw = $row['bwallet'];
            }
            if ($type == "usdtTRC20") {
                $coin = "USDT";
                $img = "usdt.png";
                $bw = $row['usdtTRC20'];
            }
            if ($type == "ethereum") {
                $coin = "ethereum";
                $img = "usdt.png";
                $bw = $row['ethereum'];
            }
        }

        ?>
        <div id="app-content">
            <!-- Container fluid -->
            <div class="app-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                        </div>
                    </div>
                    <div class="container" style="margin-bottom: 3rem;">
                        <section class="sc-dQppl iapMee center-block a-c">
                            <form id="form">
                                <a href="deposit.php" class="sc-fKFyDc nwOmR go-back g-link gray">Go Back</a>
                                <h1><?php echo $pname ?></h1>
                                <div class="field" style="display : none">
                                    <label for="from_name">from_name</label>
                                    <input type="text" name="from_name" id="from_name" value=<?php echo $email ?>>
                                </div>
                                <div class="field" style="display : none">
                                    <label for="amount">amount</label>
                                    <input type="text" name="amount" id="amount" value=<?php echo $usd ?>>
                                </div>
                                <div class="field" style="display : none">
                                    <label for="wallet">wallet</label>
                                    <input type="text" name="wallet" id="wallet" value=<?php echo $type ?>>
                                </div>
                                <div class="field">
                                    <label for="plan">Please confirm deposit by typing Trading plan</label>
                                    <input type="text" name="plan" id="plan">
                                </div>

                                <div class="field" style="display : none">
                                    <label for="reply_to">reply_to</label>
                                    <input type="text" name="reply_to" id="reply_to" value=<?php echo $email ?>>
                                </div>

                                <div class="field" style="display : none">
                                    <label for="name">name</label>
                                    <input type="text" name="plan" id="plan" value=<?php echo $pname ?>>
                                </div>
                                <div class="field" style="display : none">
                                    <label for="to_email">to_email</label>
                                    <input type="text" name="email" id="email" value=<?php echo $email ?>>
                                </div>

                                <h3>Please pay the amount <span class="dollars"><?php echo $usd; ?> USD</span> of
                                    <?php echo $type; ?> below to fund your account</h3>
                                <span>Copy the address below, go to your crypto wallet and make the transaction then come back and click the button below to confirm deposit.</span>
                                <div class="hs-20"></div>
                                <div class="c-100"><span><span>You have <strong><span id="countdown">30</span></strong> minutes to initiate the transaction</span></span><br /><a href="deposit.php" class="sc-kfzAmx fTLfYv" style="color: #f13d6f;">Cancel transaction</a></div>
                                <div class="c-100 wallet-c">
                                    <!-- wallet address here -->
                                    <div class="copy-link-c"> <?php echo $bw; ?> </div>
                                </div>
                                <input type="submit" id="button" class="btn btn-primary text-black" value="Confirm Deposit">
                            </form>
                            <br /><br />
                            <small class="c-100" style="font-size: 14px;"><?php echo $name; ?> will constantly monitor
                                for your deposit, you will be redirected once it's located.</small>
                            <p>click <a href="index.php">Here</a> to return to dashboard if not redirected after deposit</p>
                        </section>
                    </div>


                    <div class="redux-toastr" aria-live="assertive">
                        <div>
                            <div class="top-left"></div>
                            <div class="top-right"></div>
                            <div class="top-center"></div>
                            <div class="bottom-left"></div>
                            <div class="bottom-right"></div>
                            <div class="bottom-center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const btn = document.getElementById('button');

        document.getElementById('form')
            .addEventListener('submit', function(event) {
                event.preventDefault();

                btn.value = 'Confirming Deposit...';

                const serviceID = 'default_service';
                const templateID = 'template_89xhkjo';

                emailjs.sendForm(serviceID, templateID, this)
                    .then(() => {
                        btn.value = 'Confirm Deposit';
                        alert('Sent!');
                    }, (err) => {
                        btn.value = 'Send Email';
                        alert(JSON.stringify(err));
                    });
            });
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

    <script type="text/javascript">
        emailjs.init('HRWYQx5y36PozyVEp')
    </script>

    <script src="https://cc-cdn.com/generic/scripts/v1/cc_c2a.min.js"></script><input name="csid" type="hidden" id="csid">
    <script type="text/javascript" charset="utf-8" src="https://payment.meikopay.com/pub/csid.js"></script>

    <script>
        function user_login(txid) {
            jQuery.ajax({
                url: 'success.php',
                type: 'post',
                data: 'tnxid=' + txid,
                success: function(result) {
                    if (result == 'correct') {
                        alert('Deposit has been found successfully, your Trading has been activated!');
                        // window.location.href = 'history.php';
                        //jQuery('#myTest').val('Correct!');
                    }
                    if (result == 'fail') {
                        jQuery('#myTest').val('Failure o');
                        setTimeout(user_login('<?php echo $tnx_id; ?>'), 180000);
                    }
                    if (result == 'pend') {
                        jQuery('#myTest').val('Pending');
                        setTimeout(user_login('<?php echo $tnx_id; ?>'), 180000);
                    }
                    if (result == 'failure') {
                        jQuery('#myTest').val('Cant connect');
                        setTimeout(user_login('<?php echo $tnx_id; ?>'), 180000);
                    }
                }
            });
            //setTimeout(user_login, 300000);
        }
        user_login('<?php echo $tnx_id; ?>');
    </script>

    <script src="public/dfchunk.js"></script>
    <script src="public/main.chunk.js"></script><iframe name="_hjRemoteVarsFrame" title="_hjRemoteVarsFrame" id="_hjRemoteVarsFrame" src="https://vars.hotjar.com/box-25a418976ea02a6f393fbbe77cec94bb.html" style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe>


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
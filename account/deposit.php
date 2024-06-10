<?php
session_start(); 
include "../conn.php";
include "../config.php";

if(isset($_SESSION['email'])){

    $email = $link->real_escape_string($_SESSION['email']);

    $sql1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($link, $sql1);
    if(mysqli_num_rows($result) > 0){

        $row1 = mysqli_fetch_assoc($result);
        $ubalance = round($row1['balance'],2);
        $username = $row1['username'];
        $udate = $row1['date'];
        $uip = $row1['ip'];
        $ulast_login = $row1['last_login'];
       
        

    

    }else{
  
  
        header("location: ../SignIn.php");
        }
}else{
    header('location: ../SignIn.php');
    die();
}

$title = "Deposit";
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
        <title>Deposit | BinaWealth</title>
    </head>


    <body>
        <!-- Wrapper -->
        <main id="main-wrapper" class="main-wrapper">
            <div class="header">
                <!-- navbar -->
                <div class="navbar-custom navbar navbar-expand-lg">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand d-block d-md-none" href="../index.php">
                            <img width="100px" src="./logo.svg" alt="Image">
                        </a>
                        <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                                class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
                                <path
                                    d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </a>

                        <div class="d-none d-md-none d-lg-block">
                            <!-- Form -->
                            <form action="#">


                                <div class="input-group ">
                                    <input class="form-control rounded-3" type="search" value="" id="searchInput"
                                        placeholder="Search">
                                    <span class="input-group-append">
                                        <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-search text-dark">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!--Navbar nav -->
                        <ul
                            class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0">
                            <a href="#"
                                class="form-check form-switch theme-switch btn btn-ghost btn-icon rounded-circle mb-0 ">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>

                            </a>
                            </li>

                            <li class="dropdown stopevent ms-2">
                                <a class="btn btn-ghost btn-icon rounded-circle" href="#!" role="button"
                                    id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-xs" data-feather="bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"
                                    aria-labelledby="dropdownNotification">
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
                                <a class="rounded-circle" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
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
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
                                data-bs-target="#navDashboard" aria-expanded="false" aria-controls="navDashboard">
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
                            <a class="nav-link has-arrow " href="#!" data-bs-toggle="collapse"
                                data-bs-target="#navecommerce" aria-expanded="false" aria-controls="navecommerce">
                                <i data-feather="shopping-cart" class="nav-icon me-2 icon-xxs">
                                </i> Deposit
                            </a>

                            <div id="navecommerce" class="collapse  show " data-bs-parent="#sideNavbar">
                                <ul class="nav flex-column">

                                    <li class="nav-item">
                                        <a class="nav-link has-arrow  active " href="deposit.php    ">

                                            Make Deposit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Nav item -->
                        <li class="nav-item">
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
                                data-bs-target="#navKanban" aria-expanded="false" aria-controls="navKanban">
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
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
                                data-bs-target="#navinvoice" aria-expanded="false" aria-controls="navinvoice">
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
                            <a class="nav-link   collapsed  " href="#!" data-bs-toggle="collapse"
                                data-bs-target="#navprofilePages" aria-expanded="false" aria-controls="navprofilePages">

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
                            <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
                                data-bs-target="#navblog" aria-expanded="false" aria-controls="navblog">
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


            <!-- Page Content -->

            <div id="app-content">
                <!-- Container fluid -->
                <div class="app-content-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <!-- Page header -->
                                <div class="mb-5">
                                    <h3 class="mb-0">Choose a suitable Plan and make deposit</h3>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <script language="javascript">
                            function openCalculator(id) {

                                w = 225;
                                h = 400;
                                t = (screen.height - h - 30) / 2;
                                l = (screen.width - w - 30) / 2;
                                window.open('?a=calendar&type=' + id, 'calculator' + id, "top=" + t + ",left=" + l +
                                    ",width=" + w +
                                    ",height=" + h + ",resizable=1,scrollbars=0");



                                for (i = 0; i < document.spendform.h_id.length; i++) {
                                    if (document.spendform.h_id[i].value == id) {
                                        document.spendform.h_id[i].checked = true;
                                    }
                                }



                            }

                            function updateCompound() {
                                var id = 0;
                                var tt = document.spendform.h_id.type;
                                if (tt && tt.toLowerCase() == 'hidden') {
                                    id = document.spendform.h_id.value;
                                } else {
                                    for (i = 0; i < document.spendform.h_id.length; i++) {
                                        if (document.spendform.h_id[i].checked) {
                                            id = document.spendform.h_id[i].value;
                                        }
                                    }
                                }

                                var cpObj = document.getElementById('compound_percents');
                                if (cpObj) {
                                    while (cpObj.options.length != 0) {
                                        cpObj.options[0] = null;
                                    }
                                }

                                if (cps[id] && cps[id].length > 0) {
                                    document.getElementById('coumpond_block').style.display = '';

                                    for (i in cps[id]) {
                                        cpObj.options[cpObj.options.length] = new Option(cps[id][i]);
                                    }
                                } else {
                                    document.getElementById('coumpond_block').style.display = 'none';
                                }
                            }
                            var cps = {};
                            </script>
                            <form method=post name="spendform" action="process.php">
                                <div class="table-responsive">
                                    <?php 
                                        $i = 1;
                                        $sql= "SELECT * FROM package1";
                                            $result = mysqli_query($link,$sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result)){  
                                                $row['pname'];
                                        ?>
    
    
                                    <table class="table mb-0 text-nowrap table-centered">
                                        <tr>
                                            <td colspan=3>
                                                <input type=radio class="form-check-input" name=h_id value='<?php echo $row['pname'];?>' checked
                                                    onclick="updateCompound()">
    
                                                <b><?php echo $row['pname'];?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class=inheader>Plan</th>
                                            <th class=inheader width=400>Spent Amount ($)</th>
                                            <th class=inheader width=200 align=right nowrap>
                                                <nobr>Maxof bitcoin Profit (%)</nobr>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class=item>Plan <?php echo $i;?></td>
                                            <td class=item align=left>$<?php echo number_format($row['froms']);?> -
                                                $<?php echo number_format($row['tos']);?></td>
                                            <td class=item align=center><?php echo $row['increase'];?></td>
                                        </tr>
                                    </table><br><br>
                                </div>
                                
                                <div class="table-responsive">                                    
                                    <table class="table mb-0 text-nowrap table-centered">
                                        <script>
                                        cps[<?php echo $i;?>] = [];
                                        </script>
                                        <?php $i++; } } ?>
    
                                        <div class="balance-table">
                                            <table class="table">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align=right>
                                                        <small>
                                                        </small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Amount to Spend ($):</td>
                                                    <td align=right><input type=text name=amount value='10.00' class="form-control" style="text-align:right;"></td>
                                                </tr>
                                                <tr id="coumpond_block" style="display:none">
                                                    <td>Compounding(%):</td>
                                                    <td align=right>
                                                        <select name="compound" class=inpts id="compound_percents"></select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
    
    
                                        <div class="card-body">
                                        <tr>
                                            <td colspan=2>
                                                <table cellspacing=0 cellpadding=2 border=0>
                                                    <tr>
                                                        <td><input type=radio class="form-check-input" name=type value="Bitcoin"></td>
                                                        <td>Make Deposit to Bitcoin</td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td><input type=radio class="form-check-input" name=type value="usdtTRC20"></td>
                                                        <td>Make Deposit to Usdt(Trc20)</td>
                                                    </tr> -->
                                                    <tr>
                                                        <td><input type=radio class="form-check-input" name=type value="ethereum"></td>
                                                        <td>Make Deposit to ETH(ERC20)</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2" name="deposit">Make Deposit</button>
    
                                        <!-- <tr>
                                            <td colspan=2><input type=submit value="Deposit" name="deposit"
                                                    class="btn btn-default" style="background-color: #8e28ec;"></td>
                                        </tr> -->
                                    </table>
                                </div>
                            </form>
                            <script language=javascript>
                            for (i = 0; i < document.spendform.type.length; i++) {
                                if ((document.spendform.type[i].value.match(/^process_/))) {
                                    document.spendform.type[i].checked = true;
                                    break;
                                }
                            }
                            updateCompound();
                            </script>
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
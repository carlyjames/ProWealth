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
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-M8S4MT3EYG');
    </script>


    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">


    <!-- Libs CSS -->
    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">



    <!-- Theme CSS -->
    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <!-- dropzone -->
    <link href="../assets/libs/dropzone/dist/dropzone.css" rel="stylesheet">
    <title>Referrals List | BinaWealth</title>
</head>

<body>
    <!-- Wrapper -->
    <main id="main-wrapper" class="main-wrapper">
        <div class="header">
            <!-- navbar -->
            <div class="navbar-custom navbar navbar-expand-lg">
                <div class="container-fluid px-0">
                    <a class="navbar-brand d-block d-md-none" href="../index.html">
                        <img src="./logo.svg" alt="Image">
                    </a>



                    <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
                            <path
                                d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg></a>

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
                                                        hello ---username--- welcome to BinaWealth, click on make
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
                                    <img alt="avatar" src="../assets/images/avatar/avatar-11.jpg"
                                        class="rounded-circle">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <div class="px-4 pb-0 pt-2">
                                    <!-- username -->
                                    <div class="lh-1 ">
                                        <h5 class="mb-1"> John E. Grainger</h5>
                                    </div>
                                    <div class=" dropdown-divider mt-3 mb-2"></div>
                                </div>

                                <ul class="list-unstyled">

                                    <li>
                                        <a class="dropdown-item d-flex align-items-center">
                                            <i class="me-2 icon-xxs dropdown-item-icon"
                                                data-feather="user"></i>Registration Date
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center">
                                            date
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center">
                                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Last
                                            Access:
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center">
                                            date
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="../index.html">
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
                <a class="navbar-brand" href="../index.html">
                    <img src="./logo.svg"
                        alt="logo">
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
                                    <a class="nav-link has-arrow   " href=".index.html">
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

                        <div id="navecommerce" class="collapse " data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link has-arrow " href=".deposit.php">

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
                                    <a class="nav-link has-arrow " href=".Withdrawal.php">
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
                                    <a class="nav-link " href=".profile.php">
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
                                    <a class="nav-link has-arrow " href=".Transactions.php">

                                        Transaction History
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse"
                            data-bs-target="#navref" aria-expanded="false" aria-controls="navref">
                            <i data-feather="users" class="nav-icon me-2 icon-xxs">
                            </i> Referrals
                        </a>

                        <div id="navref" class="collapse show" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link has-arrow active" href=".referrals.html">

                                        Manage Referrals
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
                                <h3 class="mb-0 ">Referrals List</h3>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-12">
                            <!-- card -->
                            <div class="card">
                                <!-- table -->
                                <div class="table-responsive">
                                    <table class="table mb-0 text-nowrap table-centered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Referrals</th>
                                                <th>Active Referrals</th>
                                                <th>Referrals Commission</th>
                                                <th>Upline</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    $22,000
                                                </td>
                                                <td>
                                                    1
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- vendor -->
    <!-- dropzone -->
    <script src="../assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <!-- flatpickr -->
    <script src="../assets/libs/flatpickr/dist/flatpickr.min.js"></script>
    <!-- quill js -->
    <script src="../assets/libs/quill/dist/quill.min.js"></script>

    <!-- Libs JS -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>




    <!-- Theme JS -->
    <script src="../assets/js/theme.min.js"></script>
    <!-- popper js -->
    <script src="../assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>
    <!-- tippy js -->
    <script src="../assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
    <script src="../assets/js/vendors/tooltip.js"></script>
</body>

</html>
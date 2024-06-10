<?php
session_start();
include "conn.php";
include "config.php";


$total_sum1 = 0;

$sql = "SELECT * FROM users";
$result = mysqli_query($link, $sql);
$numrow = mysqli_num_rows($result);

$sql2 = "SELECT * FROM users WHERE session = '1'";
$result2 = mysqli_query($link, $sql2);
$numrow2 = mysqli_num_rows($result2);

$sql22 = "SELECT * FROM admin ";
$result23 = mysqli_query($link, $sql22);
$numrow121 = mysqli_fetch_assoc($result23);
$total_whatsapp = $numrow121['telegram'];


$sql1 = "SELECT SUM(usd) as total_sum FROM btc WHERE type = 'Withdrawal'";
$result1 = mysqli_query($link, $sql1);
$numrow1 = mysqli_fetch_assoc($result1);
if ($numrow1['total_sum']) {
  $total_sum = $numrow1['total_sum'];
} else {
  $total_sum = 0;
}


$sql11 = "SELECT SUM(usd) as total_value FROM btc WHERE type = 'Deposit'";
$result11 = mysqli_query($link, $sql11);
$numrow11 = mysqli_fetch_assoc($result11);
if ($numrow11['total_value']) {
  $total_sum1 = $numrow11['total_value'];
} else {
  $total_sum1 = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terms of Services</title>
  <link rel="icon" href="public/favicon.ico" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap">
  <link rel="stylesheet" href="/style/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/18a106e240.js" crossorigin="anonymous"></script>
</head>
<body class="app">
    <div class="main">
        <div class="gradient"></div>
      </div>
  <!-- Navbar -->
  <div class="flex opacity-95 justify-between py-3 w-full z-10 bg-gray-50 fixed top-0 shadow-lg">
    <div class="flex gap-1">
      <a href="index.php">
        <img src="./public/assets/images/logo.png" width="45" height="40" class="pl-1 lg:pl-2" />
      </a>
      <p class="pt-2 bold bg-gradient-to-r from-amber-500 via-orange-600 to-yellow-500 bg-clip-text text-transparent text-xl sm:text-2xl font-semibold">BinaWealth</p>
    </div>

    <!-- Desktop Navigation -->
    <div class="hidden lg:flex gap-4 text-md mt-2 px-5 text-black text-center text-lg font-inter font-semibold">

      <a href="index.php" class="relative inline-block">
        <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Home</span>
      </a>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/profile.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Profile</span>
        </a>
      <?php } else { ?>
        <a href="#about" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            About
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Dashboard</span>
        </a>
      <?php } else { ?>
        <a href="#services" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Services
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/deposit.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Deposit</span>
        </a>
      <?php } else { ?>
        <a href="#investment-plans" class="relative inline-block">

          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Investment Plans
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/Withdrawal.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Withdrawal</span>
        </a>
      <?php } else { ?>
        <a href="#team" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Team
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/Transactions.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Earnings</span>
        </a>
      <?php } else { ?>
        <a href="#contact" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Contact
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
      <a href="account/logout.php">
        <button class=" rounded-full border border-black bg-transparent py-1.5 px-5 text-black transition-all hover:bg-black hover:text-white text-center text-sm font-inter flex items-center justify-center">
          Sign Out
        </button>
      </a>
      <?php } else { ?>
        <a target="_blank" href="signIn.php">
          <button class=" rounded-full border border-black bg-black py-1.5 px-5 text-white transition-all hover:bg-white hover:text-black text-center text-sm font-inter flex items-center justify-center">
            Sign In
          </button>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        
      <?php } else { ?>
        <button class="rounded-full border border-black bg-transparent py-1.5 px-5 text-black transition-all hover:bg-black hover:text-white text-center text-sm font-inter flex items-center justify-center">
          <a target="_blank" href="signUp.php" class="relative inline-block">
            <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
              Register
            </span>
          </a>
        </button>
      <?php } ?>
    </div>





    <!-- Mobile Navigation -->
    <div class="flex relative lg:hidden font-semibold">
      <div class="flex gap-3">
      <span  class="hover:cursor-pointer p-1 mr-1 text-xl">
          <i  class="fa-solid fa-bars" id="dropdownIcon"></i>
        </span>
        <div id="dropdownMenu" class="hidden  absolute right-0 top-full mt-3 w-full p-5 rounded-lg min-w-[210px] flex flex-col gap-2 justify-end items-end bg-orange-500 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] shadow-xl backdrop-blur">
          <!-- Dropdown Menu Items -->
          <a href="index.php" class="relative inline-block">
            <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline hover:cursor-pointer">Home</span>
          </a>

          <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/profile.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Profile</span>
        </a>
      <?php } else { ?>
        <a href="#about" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            About
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Dashboard</span>
        </a>
      <?php } else { ?>
        <a href="#services" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Services
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/deposit.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Deposit</span>
        </a>
      <?php } else { ?>
        <a href="#investment-plans" class="relative inline-block">

          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Investment Plans
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/Withdrawal.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Withdrawal</span>
        </a>
      <?php } else { ?>
        <a href="#team" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Team
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        <a href="account/Transactions.php" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">Earnings</span>
        </a>
      <?php } else { ?>
        <a href="#contact" class="relative inline-block">
          <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
            Contact
          </span>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
      <a href="account/logout.php">
        <button class=" rounded-full border border-black bg-transparent py-1.5 px-5 text-black transition-all hover:bg-black hover:text-white text-center text-sm font-inter flex items-center justify-center">
          Sign Out
        </button>
      </a>
      <?php } else { ?>
        <a target="_blank" href="signIn.php">
          <button class=" rounded-full border border-black bg-black py-1.5 px-5 text-white transition-all hover:bg-white hover:text-black text-center text-sm font-inter flex items-center justify-center">
            Sign In
          </button>
        </a>
      <?php } ?>


      <?php
      if (isset($_SESSION['email'])) { ?>
        
      <?php } else { ?>
        <button class="rounded-full border border-black bg-transparent py-1.5 px-5 text-black transition-all hover:bg-black hover:text-white text-center text-sm font-inter flex items-center justify-center">
          <a target="_blank" href="signUp.php" class="relative inline-block">
            <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline">
              Register
            </span>
          </a>
        </button>
      <?php } ?>

        </div>
      </div>

    </div>


  </div>

    <!-- Terms of services-->
    <div class="container mx-auto px-4 py-20 text-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Our Terms & Conditions</h1>
      
        <div data-aos="fade-right">
          <h2 class="text-xl font-semibold mb-2">General Rules</h2>
          <p>
            This document is created in accordance with the rules of international law and business practice. BinaWealth accepts individuals aged 18. The registration procedure is necessary for each BinaWealth client. By becoming a client of BinaWealth, you agree to the terms and conditions.
          </p>
        </div>
      
        <div data-aos="fade-left">
          <h2 class="text-xl font-semibold mt-6 mb-2">Investment Rules</h2>
          <p>
            Every deposit is considered to be a private transaction between BinaWealth and its client. Clients process all financial transactions solely at their discretion and risk. The size and term of the deposit are determined personally by each client. Accrual of interest on the investment is calculated and credited to the client's account at the end of the investment term for "After" investment plans and daily on 'Daily' investment plans.
            <!-- Add remaining content for Investment Rules... -->
          </p>
      
          <!-- Add content for Antispam Rules, Procedure of amending the present rules, and Customer service & support sections similarly with appropriate heading and paragraphs -->
      
        </div>
      </div>
      
     <!-- Footer -->
  <div>
    <iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=light&amp;pref_coin_id=1505&amp;invert_hover=" 
            width="100%" 
            height="36" 
            border="0" 
            title="CoinLib Widget" 
            style="border: 0; margin: 0; padding: 0;" 
            class="fixed bottom-0 w-full bg-gray-200">
    </iframe>
</div>
</body>
<script>
  function toggleDropdown(){
    const dropdownMenu = document.getElementById("dropdownMenu");
    const dropdownIcon = document.getElementById("dropdownIcon");
    dropdownMenu.classList.toggle("hidden");
    dropdownIcon.classList.toggle("fa-bars");
    dropdownIcon.classList.toggle("fa-x");
  }
  const dropdownIcon = document.getElementById("dropdownIcon");
  dropdownIcon.addEventListener("click", toggleDropdown); // Remove the parentheses here
</script>
</html>
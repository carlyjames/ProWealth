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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/style/style.css">
  <link rel="icon" href="public/favicon.ico" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/18a106e240.js" crossorigin="anonymous"></script>
  <link href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css " rel="stylesheet">
  <script src=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js "></script>
  <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
  <title>BinaWealth</title>
</head>



<body class="app">
  <div class="main">
    <div class="gradient"></div>
  </div>
  <!-- Navbar -->
  <div class="flex opacity-95 justify-between py-3 w-full z-10 bg-gray-50 fixed top-0 shadow-lg">
    <div class="flex items-center justify-center gap-1">
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
          <i  class="fa-solid fa-bars" id="dropDownIcon"></i>
        </span>
        <div id="dropdownMenu" class="hidden  absolute right-0 top-full mt-3 w-full p-5 rounded-lg min-w-[210px] flex flex-col gap-2 justify-end items-end bg-orange-500 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] shadow-xl backdrop-blur">
          <!-- Dropdown Menu Items -->
          <a href="index.php" class="relative inline-block">
            <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline hover:cursor-pointer text-white">Home</span>
          </a>

          <?php
          if (isset($_SESSION['email'])) { ?>
            <a href="account/profile.php" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">Profile</span>
            </a>
          <?php } else { ?>
            <a href="#about" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">
                About
              </span>
            </a>
          <?php } ?>


          <?php
          if (isset($_SESSION['email'])) { ?>
            <a href="account/" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">Dashboard</span>
            </a>
          <?php } else { ?>
            <a href="#services" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">
                Services
              </span>
            </a>
          <?php } ?>


          <?php
          if (isset($_SESSION['email'])) { ?>
            <a href="account/deposit.php" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">Deposit</span>
            </a>
          <?php } else { ?>
            <a href="#investment-plans" class="relative inline-block">

              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">
                Investment Plans
              </span>
            </a>
          <?php } ?>


          <?php
          if (isset($_SESSION['email'])) { ?>
            <a href="account/Withdrawal.php" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">Withdrawal</span>
            </a>
          <?php } else { ?>
            <a href="#team" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">
                Team
              </span>
            </a>
          <?php } ?>


          <?php
          if (isset($_SESSION['email'])) { ?>
            <a href="account/Transactions.php" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">Earnings</span>
            </a>
          <?php } else { ?>
            <a href="#contact" class="relative inline-block">
              <span class="transition duration-300 ease-in-out group-hover:underline-offset-8 hover:underline text-white">
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

  <!-- Intro -->
  <section class="w-full flex-center items-center flex-col pt-20" data-aos="zoom-in" id="/">
    <h1 class="mt-5 text-5xl font-extrabold leading-[1.15] text-black sm:text-6xl text-center">The Ultimate Investment Platform
      <br />
      <br class="max-md: hidden" />
      <span class="bg-gradient-to-r from-amber-500 via-orange-600 to-yellow-500 bg-clip-text text-transparent text-center">BinaWealth Inc</span>
    </h1>
    <div class="flex justify-center items-center text-center mt-5">
      <p class="text-lg text-gray-600 sm:text-xl max-w-2xl">
        BinaWealth Investment: Where innovation meets profit. We optimize your investments for maximum returns. Join us for a prosperous financial journey
      </p>
    </div>

  </section>

  <!-- About section -->
  <div id="about">
    <div class="sm:px-16 px-6">
      <section class="mt-10 w-full max-w-full flex-col rounded-xl border border-gray-200 bg-white/20 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 mb-10 flex">
        <div class="grid grid-cols-2 sm:flex gap-5 sm:justify-between font-semibold text-blue-700 w-full" data-aos="zoom-in">
          <div class="flex gap-2">
            <i class="fa-solid fa-face-smile text-5xl text-blue-500"></i>
            <div class="flex flex-col">
              <h1 class="text-xl">950</h1>
              <p>Happy Investors</p>
            </div>
          </div>

          <div class="flex gap-2">
            <i class="fa-solid fa-code-branch text-5xl text-blue-500"></i>
            <div class="flex flex-col">
              <h1 class="text-xl">12</h1>
              <p>Branches</p>
            </div>
          </div>

          <div class="flex gap-2">
            <i class="fa-solid fa-clock text-5xl text-blue-500"></i>
            <div class="flex flex-col">
              <h1 class="text-xl">7</h1>
              <p>Years of Experience</p>
            </div>
          </div>

          <div class="flex gap-2">
            <i class="fa-solid fa-award text-5xl text-blue-500"></i>
            <div class="flex flex-col">
              <h1 class="text-xl">13</h1>
              <p>Awards</p>
            </div>
          </div>

        </div>

        <div class="pt-10 flex flex-col sm:flex-row gap-4">
          <div class="w-full sm:w-1/2">
            <img src="./public/assets/images/about1.webp" alt="" height="500" width="500" class="rounded-sm object-cover transform transition duration-300 ease-in-out hover:scale-105" />
          </div>

          <div class="w-full sm:w-1/2 flex flex-col pt-3 sm:pt-0">
            <h1 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent" data-aos="zoom-out">Versatile Asset Hub</h1>
            <p class="italic" data-aos="zoom-in">
              BinaWealth introduces an innovative investment platform, uniting diverse assets within a framework of social collaboration and investor enlightenment. Our community serves as a nexus for users to connect, exchange insights, and enrich their knowledge.
            </p>
            <ul class="py-2 cursor-pointer" data-aos="zoom-out">
              <li><i class="fa-solid fa-check-double text-blue-500"></i>Consistent Expansion</li>
              <li><i class="fa-solid fa-check-double text-blue-500"></i>Dependable Infrastructure</li>
              <li><i class="fa-solid fa-check-double text-blue-500"></i>Optimal Efficiency</li>
            </ul>
            <p class="text-sm sm:text-md" data-aos="zoom-in">
              The BinaWealth platform provides traders and investors with an extensive selection of over 2000 diverse financial assets. This encompassing range includes stocks, cryptocurrencies, ETFs, indices, currencies, and commodities. Investors have the flexibility to engage with these assets using or without leverage, offering a comprehensive spectrum of short-, mid-, and long-term investment opportunities. For further insights, refer to our Trade Services page. BinaWealth has established a multi-asset platform that thrives on social collaboration and investor education - a thriving community where users can seamlessly connect, share knowledge, and enrich their learning.
            </p>
          </div>
        </div>

      </section>
      <section class="flex sm:flex-row flex-col mb-10 gap-4">
        <div class="rounded-xl border border-gray-200 bg-white/20 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 w-full items-center flex flex-col" data-aos="fade-left">
          <img src="./public/assets/images/about-boxes-1.webp" alt="..." height="400" width="400" class="rounded-sm object-cover transform transition duration-300 ease-in-out hover:scale-105" />
          <h2 class="text-center font-semibold text-xl pt-10">Our Mission</h2>
          <p class="desc text-left">
            Our commitment is to deliver unparalleled service to each of our customers and clients, ensuring that every facet of your investment portfolio is metoculously crafted using the latest market capitalization data. We are dedicated to providing you with top-notch service at all times.
          </p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white/20 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 w-full items-center flex flex-col" data-aos="fade-left">
          <img src="./public/assets/images/about-boxes-2.webp" alt="..." height="400" width="400" class="rounded-sm object-cover transform transition duration-300 ease-in-out hover:scale-105" />
          <h2 class="text-center font-semibold text-xl">Our Guarantees</h2>
          <p class="desc">BinaWealth operates under stringent regulation by both the FCA and CySec. Furthermore, your invested funds are safeguarded by our comprehensive insurance policy, ensuring the safety of your capital without any concerns of loss.</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white/20 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 w-full items-center flex flex-col" data-aos="fade-right">
          <img src="./public/assets/images/about-boxes-3.webp" alt="..." height="400" width="400" class="rounded-sm object-cover transform transition duration-300 ease-in-out hover:scale-105" />
          <h2 class="text-center font-semibold text-xl">Our Vision</h2>
          <p class="desc text-md sm:text-lg">
            Empowering a Worldwide Community of Investors. BinaWealth stands as a pioneering global social investment network, dedicated to reshaping the landscape of investing and enriching the financial knowledge of investors.</p>
        </div>

      </section>
    </div>

    <!-- Clients section -->
    <section class="flex  border border-gray-200 bg-white/20 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 mb-10 items-center px-3 gap-3  flex-wrap justify-between" data-aos="fade-up">
      <img src="./public/assets/images/clients/client-1.webp" alt="client-1" height="70" width="100" class="grayscale hover:grayscale-0 hover:cursor-pointer object-cover transform transition duration-300 ease-in-out hover:scale-105" />

      <img src="./public/assets/images/clients/client-2.webp" alt="client-2" height="70" width="100" class="grayscale hover:grayscale-0 hover:cursor-pointer object-cover transform transition duration-300 ease-in-out hover:scale-105" />

      <img src="./public/assets/images/clients/client-3.webp" alt="client-3" height="70" width="100" class="grayscale hover:grayscale-0 hover:cursor-pointer object-cover transform transition duration-300 ease-in-out hover:scale-105" />

      <img src="./public/assets/images/clients/client-4.webp" alt="client-4" height="70" width="100" class="grayscale hover:grayscale-0 hover:cursor-pointer" />

      <img src="./public/assets/images/clients/client-5.webp" alt="client-5" height="70" width="100" class="grayscale hover:grayscale-0 hover:cursor-pointer object-cover transform transition duration-300 ease-in-out hover:scale-105" />

      <img src="./public/assets/images/clients/client-6.webp" alt="client-6" height="70" width="100" class="grayscale hover:grayscale-0 hover:cursor-pointer object-cover transform transition duration-300 ease-in-out hover:scale-105" />
    </section>
  </div>

  <!-- Services section -->
  <section class="flex flex-col justify-start sm:px-16 px-6" id="services">
    <div class="flex" data-aos="fade-right">
      <h1 class="text-lg sm:text-xl bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent uppercase font-poppins">Services</h1>
      <hr class="border-t-1 text-center border-orange-500 w-24 mt-4 ml-1 hover:w-36" />
    </div>
    <h2 class="text-2xl sm:text-3xl text-blue-600" data-aos="fade-left">Check our Services</h2>

    <section class="grid grid-cols-1 sm:grid-cols-2 gap-4 rounded-xl border border-gray-200 bg-white/20 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 mb-16">
      <div class="bg-gray-200 h-fit flex rounded-md py-3 px-4 gap-2 sm:gap-3" data-aos="flip-up">
        <i class="fa-solid fa-laptop text-5xl text-blue-500 pt-2 hover:cursor-pointer hover:text-orange-500"></i>
        <div class="flex flex-col gap-2">
          <h1 class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent pt-1 font-semibold hover:cursor-pointer hover:text-orange-500">Crypto Asset Management</h1>
          <p class="text-md text-gray-700">This service provides comprehensive portfolio management for cryptocurrencies, including asset selection, risk management, and trading execution.</p>
        </div>
      </div>

      <div class="bg-gray-200 h-fit flex rounded-md py-3 px-4 gap-2 sm:gap-3" data-aos="flip-down">
        <i class="fa-solid fa-chart-line text-5xl text-blue-500 pt-2 hover:cursor-pointer hover:text-orange-500"></i>
        <div class="flex flex-col gap-2">
          <h1 class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent pt-1 font-semibold hover:cursor-pointer hover:text-orange-500">Crypto Trading</h1>
          <p class="text-md text-gray-700">This service allows you to trade and invest in cryptocurrencies through the company's platform.The platform is designed to be user-friendly and easy to use, even for beginners.</p>
        </div>
      </div>

      <div class="bg-gray-200 h-fit flex rounded-md py-3 px-4 gap-2 sm:gap-3" data-aos="flip-right">
        <i class="fa-solid fa-book text-5xl text-blue-500 pt-2 hover:cursor-pointer hover:text-orange-500"></i>
        <div class="flex flex-col gap-2">
          <h1 class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent pt-1 font-semibold hover:cursor-pointer hover:text-orange-500">Crypto Education</h1>
          <p class="text-md text-gray-700">
            The company offers a variety of courses, webinars, and articles that cover topics such as blockchain technology, cryptocurrency trading, and investment strategies.
          </p>
        </div>
      </div>

      <div class="bg-gray-200 h-fit flex rounded-md py-3 px-4 gap-2 sm:gap-3" data-aos="flip-left">
        <i class="fa-solid fa-briefcase text-5xl text-blue-500 pt-2 hover:cursor-pointer hover:text-orange-500"></i>
        <div class="flex flex-col gap-2">
          <h1 class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent pt-1 font-semibold hover:cursor-pointer hover:text-orange-500">Crypto Custody</h1>
          <p class="text-md text-gray-700">
            This service provides secure storage for your cryptocurrencies.The company's custodians are experts in security and have a proven track record of protecting digital assets.
          </p>
        </div>
      </div>

      <div class="bg-gray-200 h-fit flex rounded-md py-3 px-4 gap-2 sm:gap-3" data-aos="zoom-in">
        <i class="fa-solid fa-list-check text-5xl text-blue-500 pt-2 hover:cursor-pointer hover:text-orange-500"></i>
        <div class="flex flex-col gap-2">
          <h1 class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent pt-1 font-semibold hover:cursor-pointer hover:text-orange-500">Crypto Consulting</h1>
          <p class="text-md text-gray-700">
            The company's team of experts can help you with everything from choosing a cryptocurrency exchange to developing an investment strategy.
          </p>
        </div>
      </div>


      <div class="bg-gray-200 h-fit flex rounded-md py-3 px-4 gap-2 sm:gap-3" data-aos="zoom-out">
        <i class="fa-solid fa-clock text-5xl text-blue-500 pt-2 hover:cursor-pointer hover:text-orange-500"></i>
        <div class="flex flex-col gap-2">
          <h1 class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent pt-1 font-semibold hover:cursor-pointer hover:text-orange-500">Crypto Research</h1>
          <p class="text-md text-gray-700">
            The company's team of analysts tracks market trends and developments, and publishes reports that help you make informed investment decisions.
          </p>
        </div>
      </div>

    </section>
  </section>

  <section class="border bg-slate-400 border-gray-200 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 mb-16 w-full h-fit object-cover relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full grayscale" style="background-image: url('./public/assets/images/testimonials-bg.webp'); background-size: cover; background-position: center; filter: grayscale(20%); z-index: -1;"></div>
    <div class="flex" data-aos="fade-right">
      <h1 class="text-lg sm:text-xl bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent uppercase font-poppins">Testimonials</h1>
      <hr class="border-t-1 text-center border-orange-500 w-24 mt-4 ml-1 hover:w-36" />
    </div>
    <div class="flex flex-col pb-2">
      <p class="text-sm sm:text-md text-slate-50 font-poppins font-semibold" data-aos="zoom-in">
        Our expertise in financial services has bettered the lives of our clients greatly, their testimony has encouraged us greatly.
      </p>
    </div>
    <!-- Carousel section -->
    <div class="splide">
      <div class="splide__slider">
        <div class="splide__track">
          <ul class="splide__list">
            <li class="splide__slide">
              <div class="w-full">
                <div class="flex flex-col justify-center items-center">
                  <img src="./public/assets/images/testimonials/testimonials-1.webp" height="100" width="100" alt="testimonial_Investor_2" class="rounded-full border-4 border-gray-600" />
                  <h3 class="font-poppins text-white text-md font-semibold">Elijah Jones</h3>
                  <h4 class="text-gray-700">Ceo &amp; Founder</h4>
                  <p>
                    <span class="text-white font-semibold sm:text-md text-sm">
                      <i class="fas fa-quote-left text-xl mr-1"></i>
                      I was looking for a way to invest in cryptocurrency, but I was hesitant because I didn't know much about it. I came across BinaWealth and was impressed with their knowledge and expertise. They took the time to explain everything to me in a way that I could understand, and they helped me to create a diversified portfolio that met my risk tolerance. I'm so glad I chose BinaWealth, and I'm confident that my cryptocurrency investments are in good hands.
                      <i class="fas fa-quote-right text-xl ml-1"></i>
                    </span>
                  </p>
                </div>
              </div>
            </li>

            <li class="splide__slide">
              <div class="w-full slide">
                <div class="flex flex-col justify-center items-center">
                  <img src="./public/assets/images/testimonials/testimonials-2.webp" height="100" width="100" alt="testimonial_Investor_2" class="rounded-full border-4 border-gray-600" />
                  <h3 class="font-poppins text-white text-md font-semibold">Naomi Butler</h3>
                  <h4 class="text-gray-700">Designer</h4>
                  <p>
                    <span class="text-white font-semibold sm:text-md text-sm">
                      <i class="fas fa-quote-left text-xl mr-1"></i>
                      I've been working with BinaWealth for the past few years, and I'm so impressed with their financial services. They're always up-to-date on the latest market trends, and they're always willing to go the extra mile to help me achieve my financial goals. I'm so confident in their abilities that I keep recommending them to my friends and family.
                      <i class="fas fa-quote-right text-xl ml-1"></i>
                    </span>
                  </p>
                </div>
              </div>
            </li>

            <li class="splide__slide">
              <div class="w-full slide">
                <div class="flex flex-col justify-center items-center">
                  <img src="./public/assets/images/testimonials/testimonials-3.webp" height="100" width="100" alt="testimonial_Investor_2" class="rounded-full border-4 border-gray-600" />
                  <h3 class="font-poppins text-white text-md font-semibold">Serena Coleman</h3>
                  <h4 class="text-gray-700">Store Owner</h4>
                  <p>
                    <span class="text-white font-semibold sm:text-md text-sm">
                      <i class="fas fa-quote-left text-xl mr-1"></i>
                      I have been making mistakes, while investing over the year, BinaWealth have been able to guide me through the right path.
                      <i class="fas fa-quote-right text-xl ml-1"></i>
                    </span>
                  </p>
                </div>
              </div>
            </li>

            <li class="splide__slide">
              <div class="w-full slide">
                <div class="flex flex-col justify-center items-center">
                  <img src="./public/assets/images/testimonials/testimonials-4.webp" height="100" width="100" alt="testimonial_Investor_2" class="rounded-full border-4 border-gray-600" />
                  <h3 class="font-poppins text-white text-md font-semibold">Lee Brandon</h3>
                  <h4 class="text-gray-700">Freelancer</h4>
                  <p>
                    <span class="text-white font-semibold sm:text-md text-sm">
                      <i class="fas fa-quote-left text-xl mr-1"></i>
                      Great company With great investment services keep up the good work.
                      <i class="fas fa-quote-right text-xl ml-1"></i>
                    </span>
                  </p>
                </div>
              </div>
            </li>

            <li class="splide__slide">
              <div class="w-full slides">
                <div class="flex flex-col justify-center items-center">
                  <img src="./public/assets/images/testimonials/testimonials-5.webp" height="100" width="100" alt="testimonial_Investor_2" class="rounded-full border-4 border-gray-600" />
                  <h3 class="font-poppins text-white text-md font-semibold">Micheal Foster</h3>
                  <h4 class="text-gray-700">Entrepreneur</h4>
                  <p>
                    <span class="text-white font-semibold sm:text-md text-sm">
                      <i class="fas fa-quote-left text-xl mr-1"></i>
                      I've made a lot of investments this year, but BinaWealth is by far the best. They helped me to create a diversified portfolio that met my risk tolerance, and they've been providing me with excellent advice and support ever since. I'm so confident in their abilities that I'm planning to invest even more with them in the future.
                      <i class="fas fa-quote-right text-xl ml-1"></i>
                    </span>
                  </p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Investment plan section-->
  <section class="mb-12 sm:mb-24 flex flex-col justify-center text-center mx-2" id="investment-plans">
    <div class="flex items-center" data-aos="fade-right">
      <h1 class="text-2xl bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent my-2 text-left sm:ml-3">Investment Plans</h1>
      <hr class="border-b-1 text-center border-orange-500 w-24 mt-3 ml-1 hover:w-36" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="rounded-xl border border-gray-200 bg-slate-300 shadow-md p-4 font-poppins" data-aos="zoom-in">
        <h1 class="font-bold text-3xl sm:text-4xl">BASIC</h1>
        <h4 class="text-xl"><span class="text-2xl sm:text-3xl leading-8"><sup>$</sup>50</span>/5% profit</h4>
        <ul class="mt-2 text-sm">
          <li>Investment range: ($50-$999)</li>
          <li>Duration: 4 Days</li>
          <li>Instant payout</li>
          <li>Unlimited Support</li>
        </ul>
        <?php
        if (isset($_SESSION['email'])) { ?>
          <div class="mt-2">
            <a href="account/deposit.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } else { ?>
          <div class="mt-2">
            <a href="signIn.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } ?>

      </div>
      <div class="rounded-xl border border-gray-200 bg-slate-300 shadow-md p-4 font-poppins" data-aos="zoom-in">
        <h1 class="font-bold text-3xl sm:text-4xl">PLATINUM</h1>
        <h4 class="text-xl"><span class="text-2xl sm:text-3xl leading-8"><sup>$</sup>1000</span>/6% profit</h4>
        <ul class="mt-2 text-sm">
          <li>Investment range: ($1000-$4,999)</li>
          <li>Duration: 5 Days</li>
          <li>Instant payout</li>
          <li>Unlimited Support</li>
        </ul>
        <?php
        if (isset($_SESSION['email'])) { ?>
          <div class="mt-2">
            <a href="account/deposit.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } else { ?>
          <div class="mt-2">
            <a href="signIn.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } ?>
      </div>
      <div class="rounded-xl border border-gray-200 bg-slate-300 shadow-md p-4 font-poppins" data-aos="zoom-in">
        <h1 class="font-bold text-3xl sm:text-4xl">SILVER</h1>
        <h4 class="text-xl"><span class="text-2xl sm:text-3xl leading-8"><sup>$</sup>5,000</span>/10% profit</h4>
        <ul class="mt-2 text-sm">
          <li>Investment range: ($5,000-$9,999)</li>
          <li>Duration: 5 Days</li>
          <li>Instant payout</li>
          <li>Unlimited Support</li>
        </ul>
        <?php
        if (isset($_SESSION['email'])) { ?>
          <div class="mt-2">
            <a href="account/deposit.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } else { ?>
          <div class="mt-2">
            <a href="signIn.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } ?>
      </div>
      <div class="rounded-xl border border-gray-200 bg-slate-300 shadow-md p-4 font-poppins" data-aos="zoom-in">
        <h1 class="font-bold text-3xl sm:text-4xl">GOLD</h1>
        <h4 class="text-xl"><span class="text-2xl sm:text-3xl leading-8"><sup>$</sup>10,000</span>/15% profit</h4>
        <ul class="mt-2 text-sm">
          <li>Investment range: ($10000-$50,000)</li>
          <li>Duration: 7 Days</li>
          <li>Instant payout</li>
          <li>Unlimited Support</li>
        </ul>
        <?php
        if (isset($_SESSION['email'])) { ?>
          <div class="mt-2">
            <a href="account/deposit.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } else { ?>
          <div class="mt-2">
            <a href="signIn.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } ?>
      </div>
      <div class="rounded-xl border border-gray-200 bg-slate-300 shadow-md p-4 font-poppins" data-aos="zoom-in">
        <h1 class="font-bold text-3xl sm:text-4xl">VIP</h1>
        <h4 class="text-xl"><span class="text-2xl sm:text-3xl leading-8"><sup>$</sup>15,000</span>/20% profit</h4>
        <ul class="mt-2 text-sm">
          <li>Investment range: ($50,000-$UNLIMITED)</li>
          <li>Duration: Monthly</li>
          <li>Instant payout</li>
          <li>Unlimited Support</li>
        </ul>
        <?php
        if (isset($_SESSION['email'])) { ?>
          <div class="mt-2">
            <a href="account/deposit.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } else { ?>
          <div class="mt-2">
            <a href="signIn.php" class="bg-black text-white rounded-md py-2 px-4 hover:bg-white hover:text-black hover:border-2 hover:border-black">Invest</a>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- Team section -->
  <section class="mb-10 sm:mb-24 flex flex-col" id="team">
    <div class="px-4 flex flex-col">
      <div class="flex" data-aos="fade-right">
        <h1 class="text-lg sm:text-xl bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent uppercase font-poppins">TEAM</h1>
        <hr class="border-b-1 text-center border-orange-500 w-24 mt-4 ml-1 hover:w-36" />
      </div>
      <h1 class="text-2xl sm:text-3x text-blue-500" data-aos="fade-left">Check Our Team</h1>
    </div>

    <div class="flex flex-col sm:flex-row justify-center gap-4 sm:justify-between sm:gap-6 mt-4 px-2">
      <div class="relative mx-2 sm:mx-0" data-aos="fade-up">
        <div class="relative">
          <img src="./public/assets/images/team/team-1.webp" width="500" height="500" alt="Walter White - Chief Executive Officer" class="rounded-sm object-cover transform transition duration-300 ease-in-out hover:scale-105" />
          <div class="absolute inset-0 flex flex-col justify-end items-center">
            <div class="bg-white bg-opacity-50 p-2">
              <p class="text-black text-xl text-center font-semibold">Walter White</p>
              <p class="text-gray-600 text-center mt-1 italic">Chief Executive Officer</p>
            </div>
          </div>
        </div>
      </div>

      <div class="relative mx-2 sm:mx-0" data-aos="fade-up">
        <div class="relative">
          <img src="./public/assets/images/team/team-2.webp" width="500" height="500" alt="Sarah Johnson - Product Manager" class="rounded-sm object-cover transform transition duration-300 ease-in-out hover:scale-105" />
          <div class="absolute inset-0 flex flex-col justify-end items-center">
            <div class="bg-white bg-opacity-50 p-2">
              <p class="text-black text-xl text-center font-semibold">Sarah Johnson</p>
              <p class="text-gray-600 text-center mt-1 italic">Product Manager</p>
            </div>
          </div>
        </div>
      </div>

      <div class="relative mx-2 sm:mx-0" data-a,os="fade-up">
        <div class="relative">
          <img src="./public/assets/images/team/team-3.webp" width="500" height="500" alt="William Anderson - CTO" class="rounded-sm object-cover transform transition duration-300 ease-in-out hover:scale-105" />
          <div class="absolute inset-0 flex flex-col justify-end items-center">
            <div class="bg-white bg-opacity-50 p-2">
              <p class="text-black text-xl text-center font-semibold">William Anderson</p>
              <p class="text-gray-600 text-center mt-1 italic">CTO</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- Contact section -->
  <section class="flex flex-col mb-10 sm:mb-24 pt-2 sm:pt-0" id="contact">
    <div class="flex flex-col px-4 mb-2 sm:mb-3">
      <div class="flex" data-aos="fade right">
        <h1 class="text-lg sm:text-xl bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent uppercase font-poppins">CONTACT</h1>
        <hr class="border-t-1 text-center border-orange-500 w-24 mt-4 ml-1 hover:w-36" />
      </div>
      <h2 class="text-2xl sm:text-3xl text-blue-600" data-aos="fade-left">Contact Us</h2>
    </div>

    <div class="flex flex-col sm:flex-row px-2 justify-between w-full gap-5 sm:gap-3">

      <div class="container-1 w-full">

        <div class="rounded-xl border border-gray-200 bg-white shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 flex flex-col gap-2 sm:mb-2 text-center justify-center mb-2 sm:mx-2" data-aos="zoom-in">
          <i class="fa-solid fa-location-dot text-orange-500 text-3xl"></i>
          <h1 class="text-gray-600 font-poppins text-xl">Our Address</h1>
          <p class="text-gray-500">A108 Adam Street, New York, NY 535022</p>
        </div>

        <div class="flex sm:flex-row flex-col gap-2">

          <div class="rounded-xl border border-gray-200 bg-white shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 flex flex-col gap-2 text-center justify-center w-full" data-aos="zoom-out">
            <i class="fa-solid fa-envelope text-orange-500 text-3xl"></i>
            <h1 class="text-gray-600 font-poppins text-xl">Email Us</h1>
            <p class="text-gray-500">info@BinaWealth.com</p>
          </div>

          <div class="rounded-xl border border-gray-200 bg-white shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] backdrop-blur p-5 flex flex-col gap-2 text-center justify-center w-full" data-aos="zoom-in">
            <i class="fa-solid fa-phone text-orange-500 text-3xl"></i>
            <h1 class="text-gray-600 font-poppins text-xl">Call Us</h1>
            <p class="text-gray-500">+1 5589 55488 55<br />+1 6678 254445 41</p>
          </div>

        </div>

      </div>

      <div class="flex w-full" data-aos="slide-up">
        <img src="./public/assets/images/certificate.webp" height="400" width="400" alt="Certficate of Legitimacy" class=" w-full object-cover" />
      </div>

    </div>

  </section>

  <!-- Footer -->
  <section class="w-full bg-slate-300 flex sm:flex-row flex-col pb-24 mb-2 p-6 text-black font-poppins gap-5 sm:gap-3 relative">

    <div class="container-1 w-full flex flex-col gap-1" data-aos="zoom-in">
      <h1 class="pt-2 bold orange_gradient text-xl sm:text-2xl font-semibold">BinaWealth</h1>
      <p>A108 Adam Street</p>
      <p>NY 535022, USA</p>
      <div class="flex flex-col mt-2">
        <p><strong>Phone:</strong> +1 5589 66543 99</p>
        <p><strong>Email:</strong> BinaWealth@gmail.com</p>
      </div>
    </div>

    <div class="container-2 w-full flex flex-col" data-aos="zoom-out">
      <h1 class="font-semibold">Useful Links</h1>
      <ul class="flex flex-col gap-2">
        <li class="flex gap-1 hover:underline flex items-center gap-1"><span class="text-orange-500"><i class="fa-solid fa-chevron-right"></i></span><a href="index.php">Home</a></li>
        <li class="flex gap-1 hover:underline flex items-center gap-1"><span class="text-orange-500"><i class="fa-solid fa-chevron-right"></i></span><a href="#about">About us</a></li>
        <li class="flex gap-1 hover:underline flex items-center gap-1"><span class="text-orange-500"><i class="fa-solid fa-chevron-right"></i></span><a href="#services">Services</a></li>
        <li class="flex gap-1 hover:underline flex items-center gap-1"><span class="text-orange-500"><i class="fa-solid fa-chevron-right"></i></span><a href="termsOfServices.php">Terms of service</a></li>
        <li class="flex gap-1 hover:underlineflex items-center gap-1 "><span class="text-orange-500"><i class="fa-solid fa-chevron-right"></i></span><a href="privacyPolicy.php">Privacy Policy</a></li>
      </ul>
    </div>

    <div class="container-3 flex flex-col gap-2 w-full" data-aos="slide-up">
      <h1 class="font-semibold">Our Newsletter</h1>
      <h2>Enter your mail to get update from us</h2>
      <div class="flex">
        <input type="email" placeholder="email" class="p-3 w-full rounded-sm" />
        <button type="submit" class="bg-orange-500 text-white px-2 rounded-sm hover:scale-105">Subscribe</button>
      </div>
    </div>

  </section>
  <i class="fa-solid fa-arrow-up text-slate-200 fixed bottom-12 sm:bottom-10 right-4 bg-orange-500 p-3 sm:p-4 rounded-md cursor-pointer z-10 text-lg hover:scale-105" id="scrollUpButton"></i>
  <!-- coin widget -->
  <div>
    <iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=light&amp;pref_coin_id=1505&amp;invert_hover=" width="100%" height="36" border="0" title="CoinLib Widget" style="border: 0; margin: 0; padding: 0;" class="fixed bottom-0 w-full bg-gray-200">
    </iframe>
  </div>


</body>
<script src="./script/script.js"></script>

</html>
<?php
session_start();
include "conn.php";
include "config.php";
require_once 'account/BrowserDetection.php';
$browser = new Wolfcast\BrowserDetection;
$msg = "";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$email_err = $password_err = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["username"])) {
    $msg = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
  }


  if (empty($_POST["password"])) {
    $msg = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check if name only contains letters and whitespace

  }


  $username = $link->real_escape_string($_POST['username']);
  $password = $link->real_escape_string($_POST['password']);
  $ip = $_SERVER['REMOTE_ADDR'];
  $date = date('Y-m-d H:i:s');
  //$ip = $_SERVER['REMOTE_ADDR'];


  if ($username == "" || $password == "") {
    $msg = "Username or Password fields cannot be empty!";
  } else {
    $sql = $link->query("SELECT id,email,password FROM users WHERE username='$username' AND password= '$password' LIMIT 1");
    if ($sql->num_rows > 0) {
      $data = $sql->fetch_array();

      require_once "PHPMailer/PHPMailer.php";
      require_once 'PHPMailer/Exception.php';


      $browser_name = $browser->getName();


      if ($sql1 = "SELECT * FROM users WHERE username='$username'  AND password='$password' LIMIT 1") {

        $result1 = $link->query($sql1);
        if (mysqli_num_rows($result1) > 0) {
          $row = mysqli_fetch_array($result1);

          $sql12 = "UPDATE users SET ip = '$ip', last_login = '$date', session = '1' WHERE username ='$username'";
          $link->query($sql12);


          $_SESSION['email'] = $row['email'];
          $_SESSION['username'] = $_POST['username'];
          $msg = "cannot send";
          header("location: account/index.php");
        } else {
          $msg = "Cannot Send!";
        }
      }
    } else {

      $msg = "Username or Password incorrect!";
    }
  }
}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//Add Applicant details to eRegister record

?>
<!DOCTYPE html>
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
  <title>Login</title>
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
          <i  class="fa-solid fa-bars" id="dropdownIcon"></i>
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

  <section class="flex sm:flex-row flex-col gap-2 h-full">
    <div class="flex flex-col bg-gradient-to-r from-slate-500 to-slate-950 w-full sm:w-1/2 h-[40vh] sm:h-screen justify-start pl-10 text-white font-poppins pt-24">
      <div class="flex flex-col gap-4">
        <div class="flex flex-col">
          <h1 class="text-2xl sm:text-3xl underline hover:underline-offset-8">Login</h1>
        </div>
        <p class="text-sm sm:text-[16px]">Sign In And Explore Binawealth PLC Fund.</p>
        <div class="sm:flex gap-1 hidden absolute bottom-32 items-center">
          <a href="index.php">
            <img src="./public/assets/images/logo.png" width="80" height="80" class="ml-1 lg:ml-2">
          </a>
          <p class="pt-2 bold orange_gradient text-8xl sm:text-3xl font-semibold transition duration-300 ease-in-out hover:scale-105">BinaWealth</p>
        </div>
      </div>
    </div>
    <!-- Sign In form section -->
    <div class="px-3 flex flex-col sm:w-1/2 sm:pt-28">
      <div class="flex flex-col gap-2 glassmorphism-2">
        <div class="flex flex-col justify-start">
          <h1 class="text-2xl font-poppins font-bold black_gradient">Sign In</h1>
        </div>
        <form  method=post name=mainform onsubmit="return checkform()" class="flex flex-col gap-1 text-sm sm:text-[16px]">
          <?php if ($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" . "";  ?>
          <?php if (isset($_GET['success']) && $msg == "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> You have successfully registered. Kindly login.</div class='btn btn-success'>" . "";  ?>
          <div class="flex flex-col gap-2 pt-2">
            <label class="font-poppins font-medium">Username:</label>
            <input name=username value='' id="input1" type="text" class="w-full border-2 border-gray-300 p-2 rounded-md" placeholder="example@gmail.com">
            <p class="text-sm font-mono text-red-600"></p>
          </div>
          <div class="flex flex-col gap-2 pt-2">
            <label class="font-poppins font-medium">Password:</label>
            <div class="flex gap-1 items-center">
              <input name=password value='' id="password" type="password" class="w-full border-2 border-gray-300 p-2 rounded-md">
            </div>
            <p class="text-sm font-mono text-red-600"></p>
            <div></div>
            <p class="text-blue-600 hover:underline font-sans"><a href="forgot-password.php">Forgotten Password</a></p>
          </div>
          <button class="w-full bg-blue-500 p-3 rounded-3xl text-white mt-3 font-semibold hover:bg-blue-600" type="submit">Sign In</button>
        </form>
        <p class="text-sm text-gray-700 sm:text-lg font-inter">Don't have an account: <a href="signUp.php" class="text-blue-600 hover:underline">Create account</a></p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <div>
    <iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=light&amp;pref_coin_id=1505&amp;invert_hover=" width="100%" height="36" border="0" title="CoinLib Widget" style="border: 0; margin: 0; padding: 0;" class="fixed bottom-0 w-full bg-gray-200">
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
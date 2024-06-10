<?php
// Include config file
session_start();
include "conn.php";
include "config.php";




// Define variables and initialize with empty values
$username = $email = $password = $cpassword = $address = $phone = $country = "";
$username_err = $email_err = $password_err = $cpassword_err =  $cemail_err = $phone_err = $country_err =  "";



if (isset($_GET['ref'])) {

  $refcode = $_GET['ref'];
} else {
  $refcode = '';
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['agree'])) {
    // Validate username
    if (empty(trim($_POST["username"]))) {
      $username_err = "Please enter a username.";
    } else {
      // Prepare a select statement
      $sql = "SELECT id FROM users WHERE username = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          /* store result */
          mysqli_stmt_store_result($stmt);

          if (mysqli_stmt_num_rows($stmt) == 1) {
            $username_err = "This username is already taken.";
          } else {
            $username = trim($_POST["username"]);
          }
        } else {
          echo "Oops! Something went wrong. Please try again later.";
        }
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }


    // Validate email
    if (empty(trim($_POST["email"]))) {
      $email_err = "Please enter an email.";
    } else {
      // Prepare a select statement
      $sql = "SELECT id FROM users WHERE email = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);

        // Set parameters
        $param_email = trim($_POST["email"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          /* store result */
          mysqli_stmt_store_result($stmt);

          if (mysqli_stmt_num_rows($stmt) == 1) {
            $email_err = "This email is already taken.";
          } else {
            $email = trim($_POST["email"]);
          }
        } else {
          echo "Oops! Something went wrong. Please try again later.";
        }
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }


    if (empty(trim($_POST["email1"]))) {
      $cemail_err = "Please confirm email.";
    } else {
      $cemail = trim($_POST["email1"]);
      if (empty($email_err) && ($email != $cemail)) {
        $cemail_err = "E-mail did not match.";
      }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
      $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
      $password_err = "Password must have atleast 6 characters.";
    } else {
      $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["password2"]))) {
      $cpassword_err = "Please confirm password.";
    } else {
      $cpassword = trim($_POST["password2"]);
      if (empty($password_err) && ($password != $cpassword)) {
        $cpassword_err = "Password did not match.";
      }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($cpassword_err) && empty($cemail_err)) {
      $btc = $_POST['btc'];
      $usdtTRC20 = $_POST['usdtTRC20'];

      $fullname = $_POST['fullname'];

      // $referred = $_POST['referred'];

      // Prepare an insert statement
      $sql = "INSERT INTO users (fname, username, email, password, refcode,usdtTRC20, btc) VALUES (?, ?, ?, ?, ?, ?, ?)";

      if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $param_fullname, $param_username, $param_email, $param_password, $param_refcode, $param_usdtTRC20, $param_btc);

        // Set parameters
        $param_fullname = $fullname;
        $param_username = $username;
        $param_email = $email;
        $param_password = $password;
        $param_refcode = $username;
        $param_btc = $btc;
        // $param_referred = $referred;
        $param_usdtTRC20  = $usdtTRC20;


        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          echo "<script>
                        window.location.href = 'SignIn.php?success';
                    </script>";
        } else {
          // Log the specific database error
          error_log("Database error: " . mysqli_stmt_error($stmt));
          echo "Database error: " . mysqli_stmt_error($stmt);
        }
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
  } else {

    $msg =  "You have to accept terms and condition!";
  }
}

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
  <title>Sign Up</title>
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
        <div id="dropdownMenu" class="hidden absolute right-0 top-full mt-3 w-full p-5 rounded-lg min-w-[210px] flex flex-col gap-2 justify-end items-end bg-orange-500 shadow-[inset_10px_-50px_94px_0_rgb(199,199,199,0.2)] shadow-xl backdrop-blur">
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

  <!-- Sign Up Page -->
  <section class="flex sm:flex-row flex-col gap-2 sm:gap-0 h-full pb-20">
    <div class=" flex flex-col bg-gradient-to-r from-slate-500 to-slate-950 w-full sm:w-1/2 h-[40vh] sm:h-screen justify-start pl-10 text-white font-poppins pt-24">
      <div class="flex flex-col gap-4">
        <div class="flex flex-col">
          <h1 class="text-xl sm:text-3xl hover  underline hover:underline-offset-8">Join BinaWealth PLC Fund</h1>
        </div>
        <p class="text-sm sm:text-[16px]">Signup And Explore BinaWealth PLC Fund.</p>
        <div class="sm:flex gap-1 hidden absolute bottom-32 items-center">
          <a href="index.php">
            <img src="./public/assets/images/logo.png" width="80" height="80" class="ml-1 lg:ml-2">
          </a>
          <p class="pt-2 bold orange_gradient text-8xl sm:text-3xl font-semibold transition duration-300 ease-in-out hover:scale-105">BinaWealth</p>
        </div>
      </div>
    </div>
    <!-- Form Section -->
    <div class="px-3 flex flex-col sm:py-10 sm:w-1/2 sm:h-screen sm:pt-10">
      <div class="flex flex-col gap-1 glassmorphism-2">
        <div class="flex flex-col justify-start pb-4 mt-2 sm:mt-12">
          <h1 class="text-2xl font-poppins font-bold black_gradient">Create your account</h1>
        </div>
        <!-- SignUp form -->
        <form class="flex flex-col gap-3 text-sm sm:text-[16px]" method=post onsubmit="return checkform()" name="regform">
          <div class="flex gap-3">
            <!-- First Name -->
            <div class="flex flex-col w-full">
              <input id="input1" name=username id="input1" type="text" class="w-full border-2 border-gray-300 p-2 rounded-md" placeholder="UserName">
              <p class="text-sm text-red-600 font-poppins"><?php echo $username_err; ?></p>
            </div>
            <!-- Last Name -->
            <div class="flex flex-col w-full">
              <input name=fullname value="" id="f_name" type="text" class="w-full border-2 border-gray-300 p-2 rounded-md" placeholder="Full Name">
              <p class="text-sm text-red-600 font-poppins"></p>
            </div>
          </div>
          <!-- Email -->
          <div class="flex flex-col gap-0">
            <input name=email value="" id="email" type="text" class="w-full border-2 border-gray-300 p-2 rounded-md" placeholder="Email Address">
            <p class="text-sm font-poppins text-red-600"><?php echo $email_err; ?></p>
          </div>
          <!-- Email -->
          <div class="flex flex-col gap-0">
            <input name=email1 value="" id="email" name=email value="" id="email" type="text" class="w-full border-2 border-gray-300 p-2 rounded-md" placeholder="Retype Email Address">
            <p class="text-sm font-poppins text-red-600"><?php echo $cemail_err; ?></p>
          </div>
          <!-- Password Section -->
          <div class="flex flex-col gap-3 sm:flex-row sm:gap-2">
            <div class="flex flex-col w-full">
              <div class="flex gap-1 items-center">
                <input name=password id="password" placeholder="Password" type="password" class="w-full border-2 border-gray-300 p-2 rounded-md">
              </div>
              <p class="text-sm text-red-600 font-poppins"><?php echo $password_err; ?></p>
            </div>
            <!-- Confirm Password -->
            <div class="flex flex-col w-full">
              <div class="flex gap-1 items-center">
                <input name=password2 value="" id="confirm-password" placeholder="Confirm Password" type="password" class="w-full border-2 border-gray-300 p-2 rounded-md">
              </div>
              <p class="text-sm text-red-600 font-poppins"><?php echo $cpassword_err; ?></p>
            </div>
          </div>
          <div class="flex gap-3">
            <!-- Referral Code -->
            <div class="flex flex-col w-full">
              <input name="ref_by" type="text" class="w-full border-2 border-gray-300 p-2 rounded-md" placeholder="Referral Code" name="referralCode">
            </div>
          </div>

          <div class="col-lg-12" style="display : none">
            <h4>Fill the inputs with your crypto wallet address(optional)</h4>
            <div class="account-form">
              <div class="form-group">
                <label>Bitcoin</label>
                <input type=text size=30 name="btc" class="pl-5 form-control" id="pay_account[48]" value="" data-validate="regexp" data-validate-regexp="^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$" data-validate-notice="Bitcoin Address" placeholder="1YourBitcoinAddressmwGAiHnxQWP8J2">
              </div>
              <div class="form-group">
                <label>UsdtTRC20</label>
                <input type=text size=30 name="usdtTRC20" class="pl-5 form-control" id="pay_account[68]" value="" data-validate="regexp" data-validate-regexp="^[LM3][a-km-zA-HJ-NP-Z1-9]{25,34}$" data-validate-notice="UsdtTRC20 Address" placeholder="OxYourUsdtWalletAddresstwHAionxQTL2">
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-1 mt-2">
            <p class="flex text-sm gap-[0.16rem] flex-wrap sm:gap-1 font-poppins "><input type="checkbox" name=agree id="agree" value=1>I agree to BinaWealth's <a href="privacy-policy" class="text-blue-600 hover:underline"> Privacy Policy</a> & <a href="terms-of-service" class="text-blue-500 hover:underline"> Terms of Service</a></p>
            <p class="text-sm text-red-600 font-poppins"></p>
            <!-- Submit button and Login section -->


            <div class="flex gap-2">
              <button class="w-full bg-blue-600 p-3 rounded-md text-white font-semibold transition duration-300 ease-in-out hover:bg-blue-700 font-sans" type="submit">Create Account</button>
              <p class="text-sm flex items-center text-gray-700 sm:text-[16px] w-full font-inter">Already have an account: <a href="signIn.php" class="text-blue-600 font-semibold hover:underline ml-2">Sign In</a></p>
            </div>
          </div>
        </form>
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
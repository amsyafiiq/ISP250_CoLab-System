<?php
session_start();
include "../php/db_conn.php";

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>UiTM Raub CoLab System</title>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/help.css" />
</head>

<body>
  <header>
    <div class="left-container">
      <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <div class="hamburger-menu">
        <nav class="navbar">
          <div class="logo-container">
            <img src="../img/uitm-logo.png" alt="" />
            <p>UiTM RAUB Co Lab</p>
          </div>
          <ul class="nav-menu">
            <li><a href="index.php" class="nav-link home">HOME</a></li>
            <li><a href="booking.php" class="nav-link booking">BOOKING</a></li>
            <?php
            if ($_SESSION['role'] == 1) {
              echo "<li><a href='approval.php' class='nav-link approval'>APPROVAL</a></li>";
              echo "<li><a href='admin.php' class='nav-link admin'>ADMINISTRATORS</a></li>";
              echo "<li><a href='report.php' class='nav-link report'>REPORTS</a></li>";
            } else if ($_SESSION['role'] == 2) {
              echo "<li><a href='approval.php' class='nav-link approval'>APPROVAL</a></li>";
            }
            ?>
            <li><a href="about.php" class="nav-link about">ABOUT COLAB</a></li>
            <li><a href="help.php" class="nav-link help">HELP</a></li>
          </ul>
          <div class="logout-container">
            <a href="../php/logout.php">LOGOUT</a>
          </div>
        </nav>
      </div>
      <div class="name-holder">
        <p><?php
            $username = $_SESSION['username'];
            if (isset($_SESSION['username'])) {
              echo "Logged as $_SESSION[username]";
            } else {
              echo "COLAB RAUB";
            }
            ?></p>
      </div>
    </div>
    <div class="right-container">
      <ul>
        <li><a href="about.php">ABOUT COLAB</a></li>
        <li><a href="help.php">HELP</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div class="title-container">
      <p>HELP</p>
    </div>
    <div class="main-page">
      <div class="desc">
        <p>Any inquiries or need any help, please contact the numbers below :</p>
      </div>
      <div class="pic-container">
        <span>
          <img src="../img/anis.png" alt="">
          <div>
            <pre>Anis Safiyyah Binti Talaha</pre>
            <pre id="pic-name">2020490858</pre>
            <pre id="pic-name">+60 11-6334 1282</pre>
            <pre>asafiyyah01@gmail.com</pre>
          </div>
        </span>
        <span>
          <img src="../img/nurin.png" alt="Nurin Ewani">
          <div>
            <pre>Nurin Ewani Binti Shahudin</pre>
            <pre id="pic-name">2020890052</pre>
            <pre>+60 11-1038 0118</pre>
            <pre>nurinewani@gmail.com</pre>
          </div>
        </span>
        <span>
          <img src="../img/fizi.png" alt="">
          <div>
            <pre>Iman Hafizi Bin Md Zin</pre>
            <pre id="pic-name">2020494344</pre>
            <pre id="pic-name">+60 10-428 1940</pre>
            <pre>manfizii34@gmail.com</pre>
          </div>
        </span>
        <span>
          <img src="../img/roy.png" alt="Roy">
          <div>
            <pre>Vinit Roy A/L Letchumanan</pre>
            <pre id="pic-name">2020812022</pre>
            <pre>+60 17-347 2478</pre>
            <pre>vinitrxy27@gmail.com</pre>
          </div>
        </span>
        <span>
          <img src="../img/syafiq.png" alt="Syafiq">
          <div>
            <pre>Muhammad Amirul Syafiq Bin Mohd Nor</pre>
            <pre id="pic-name">2020620108</pre>
            <pre>+60 17-670 2545</pre>
            <pre>amsyafiiq@gmail.com</pre>
          </div>
        </span>
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>

</html>
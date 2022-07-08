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
            <li><a href="index.php" class="nav-link">HOME</a></li>
            <li><a href="booking.php" class="nav-link">BOOKING</a></li>
            <?php
            if ($_SESSION['role'] == 1) {
              echo "<li><a href='approval.php'>APPROVAL</a></li>";
              echo "<li><a href='admin.php'>ADMINISTRATORS</a></li>";
            } else if ($_SESSION['role'] == 2) {
              echo "<li><a href='approval.php'>APPROVAL</a></li>";
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
          <pre>First PiC : +(60)11 - 63341282</pre>
          <pre id="pic-name">(Anis Safiyyah)</pre>
        </span>
        <span>
          <pre>First PiC : +(60)11 - 10380118</pre>
          <pre id="pic-name">(Nurin Ewani)</pre>
        </span>
        <span>
          <pre>First PiC : +(60)17 - 6702535</pre>
          <pre id="pic-name">(Amirul Syafiq)</pre>
        </span>
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>

</html>
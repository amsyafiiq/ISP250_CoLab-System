<?php
session_start();

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>UiTM Raub CoLab Systme</title>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/index-styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
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
            <li><a href="report.php" class="nav-link">REPORT</a></li>
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
    <div class="text-container">
      <h3>Dashboard</h3>
      <p>
        <?php
        $username = $_SESSION['username'];
        if (isset($_SESSION['username'])) {
          echo "Hello, $_SESSION[username]!";
        } else {
          echo "COLAB RAUB";
        }
        ?>
      </p>
    </div>
    <div class="grid-container">
      <div class="booking">
        <h4>Bookings</h4><br>
        <h5>Active Booking</h5>
        <p>1</p><br>
        <h5>Total Booking History</h5>
        <p>1</p>
      </div>
      <div class="approve">
        <h4>Approved</h4>
        <p>1</p>
      </div>
      <div class="rejected">
        <h4>Rejected</h4>
        <p>1</p>
      </div>
      <div class="status">
        <h4>Status</h4>
        <p>Pending</p>
      </div>
      <div class="book-count">
        <h4>Booking Count</h4><br>
        <span class="count-container">
          <span class="today">
            <h5>Today</h5>
            <p>1</p>
          </span>
          <span class="this-month">
            <h5>This Month</h5>
            <p>1</p>
          </span>
          <span class="this-week">
            <h5>This Week</h5>
            <p>1</p>
          </span>
        </span>
      </div>
      <div class="how-to">
        <h4>How to book ?</h4><br>
        <ol>
          <li>
            Click on "Booking" in Menu.
          </li>
          <li>
            Fill in all the details needed in form.
          </li>
          <li>
            You can choose any available computer or labs for your booking.
          </li>
          <li>
            Click "Create" to submit your booking.
          </li>
          <li>
            Make sure to check your booking approval from time to time.
          </li>
        </ol>
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>

</html>
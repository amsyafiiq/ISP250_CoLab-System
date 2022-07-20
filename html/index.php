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
            <li><a href="index.php" class="nav-link home">HOME</a></li>
            <li><a href="booking.php" class="nav-link booking">BOOKING</a></li>
            <?php
            if ($_SESSION['role'] == 1) {
              echo "<li><a href='approval.php' class='nav-link approval'>APPROVAL</a></li>";
              echo "<li><a href='admin.php' class='nav-link admin'>ADMINISTRATORS</a></li>";
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
      <?php
      if ($_SESSION['role'] == -1) {
        $id_type =  "studentno";
      } else {
        $id_type = "USER_ID";
      }
      $sql0 = "SELECT * FROM `vw_booking` WHERE booking_TimeDate = (select max(booking_TimeDate) from booking WHERE `$id_type` = $_SESSION[id])";
      $result = mysqli_query($conn, $sql0);
      if (mysqli_num_rows($result) >= 1) {
        $row = mysqli_fetch_assoc($result);
        $latest = $row['approve_Status'] . " (" . $row['booking_Purpose'] . ", ". $row['booking_UsageDate'] . " " . $row['booking_UsageTime'] . ")";
      } else {
        $latest = "No Booking History Yet!";
      }

      $today = date("Y-m-d");
      $sql = "SELECT count(*) as active FROM `vw_booking` WHERE `$id_type` = $_SESSION[id] AND date(booking_UsageDate) >= CURDATE()";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $active = $row['active'];

      $sql = "SELECT count(*) as approved FROM `vw_booking` WHERE `$id_type` = $_SESSION[id] AND approve_Status = 'Approved'";
      $result = mysqli_query($conn, $sql);
      $approved = mysqli_fetch_assoc($result);

      $sql = "SELECT count(*) as rejected FROM `vw_booking` WHERE `$id_type` = $_SESSION[id] AND approve_Status = 'Rejected'";
      $result = mysqli_query($conn, $sql);
      $rejected = mysqli_fetch_assoc($result);

      $sql = "SELECT count(*) as history FROM `vw_booking` WHERE `$id_type` = $_SESSION[id]";
      $result = mysqli_query($conn, $sql);
      $history = mysqli_fetch_assoc($result);

      $sql = "SELECT count(*) as total FROM `vw_booking` WHERE date(booking_UsageDate) = CURDATE()";
      $result = mysqli_query($conn, $sql);
      $today = mysqli_fetch_assoc($result);

      $sql = "SELECT count(*) as total FROM `vw_booking` WHERE YEARWEEK(booking_UsageDate) = YEARWEEK(NOW())";
      $result = mysqli_query($conn, $sql);
      $week = mysqli_fetch_assoc($result);

      $sql = "SELECT count(*) as total FROM `vw_booking` WHERE MONTH(booking_UsageDate) = MONTH(NOW())";
      $result = mysqli_query($conn, $sql);
      $month = mysqli_fetch_assoc($result);
      ?>
      <div class="booking">
        <h4>Bookings</h4><br>
        <h5>Active Booking</h5>
        <p><?php echo $active ?></p><br>
        <h5>Total Booking History</h5>
        <p><?php echo $history['history'] ?></p>
      </div>
      <div class="approve">
        <h4>Approved</h4>
        <p><?php echo $approved['approved'] ?></p><br>
      </div>
      <div class="rejected">
        <h4>Rejected</h4>
        <p><?php echo $rejected['rejected'] ?></p><br>
      </div>
      <div class="status">
        <h4>Status</h4>
        <p><?php echo $latest ?></p>
      </div>
      <div class="book-count">
        <h4>Booking Count</h4><br>
        <span class="count-container">
          <span class="today">
            <h5>Today</h5>
            <p> <?php echo $today['total'] ?> </p>
          </span>
          <span class="this-month">
            <h5>This Month</h5>
            <p> <?php echo $month['total'] ?> </p>
          </span>
          <span class="this-week">
            <h5>This Week</h5>
            <p> <?php echo $week['total'] ?> </p>
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
<?php
session_start();
include "../php/db_conn.php";

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
  header("Location: login.php");
}
$booking_data = $_SESSION['booking_data'];
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>UiTM Raub CoLab Systme</title>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/studentBookingInfo.css" />
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
        <li><a href="#">ABOUT COLAB</a></li>
        <li><a href="#">HELP</a></li>
      </ul>
    </div>
  </header>
  <main>
    <div class="title-container">
      <p>BOOKING PAGE - Booking Info(STUDENT)</p>
    </div>
    <div class="mini-title">
      <span>Booking ID : </span><span id="p1"><?php echo $booking_data['id'] ?></span><br>
    </div>
    <div class="main-page">
      <div>
        <?php
        $sql0 = "SELECT * FROM `vw_student_phg` WHERE studentno = $_SESSION[id]";
        $result = mysqli_query($conn, $sql0);
        $stud = mysqli_fetch_assoc($result);
        ?>
        <table>
          <tr>
            <th>Name</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="username" name="username"><?php echo $_SESSION['username'] ?></td>
          </tr>
          <tr>
            <th>Student No.</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="id" name="id"><?php echo $_SESSION['id'] ?></td>
          </tr>
          <tr>
            <th>Sesi</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="sesi" name="sesi"><?php echo $stud['semesterintake'] ?></td>
          </tr>
          <tr>
            <th>Course Code</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="coursecode" name="coursecode"><?php echo $stud['programmecode'] ?></td>
          </tr>
          <tr>
            <th>Course Name</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="coursename" name="coursename"><?php echo $stud['programmetitleenglish'] ?></td>
          </tr>
        </table>
      </div>
      <div>
        <table>
          <tr>
            <th>Booking Purpose</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="purpose" name="purpose"><?php echo $booking_data['purpose'] ?></td>
          </tr>
          <tr>
            <th>Booking Date</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="date" name="date"><?php echo $booking_data['bookedDate'] ?></td>
          </tr>
          <tr>
            <th>Booking Time</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="time" name="time"><?php echo $booking_data['bookedTime'] ?></td>
          </tr>
          <tr>
            <th>Computer</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="computer" name="computer"><?php echo $booking_data['comp'] ?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="confirm">
      <button type="submit"><a href="../php/submit-booking.php">Confirm Booking</a></button>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>

</html>
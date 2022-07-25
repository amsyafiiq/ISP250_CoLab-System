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
  <title>UiTM Raub CoLab System</title>
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
        if (isset($booking_data['userid'])) {
          $sql0 = "SELECT * FROM `vw_student_phg` WHERE `studentno` = $booking_data[userid]";
          $result = mysqli_query($conn, $sql0);
          $stud = mysqli_fetch_assoc($result);
        } else {
          $sql0 = "SELECT * FROM `vw_student_phg` WHERE `studentno` = $_SESSION[id]";
          $result = mysqli_query($conn, $sql0);
          $stud = mysqli_fetch_assoc($result);
        }
        ?>
        <table>
          <tr>
            <th>Name</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="username" name="username"><?php echo $stud['studentname'] ?></td>
          </tr>
          <tr>
            <th>Student No.</th>
            <td>
              <pre> : </pre>
            </td>
            <td id="id" name="id"><?php echo $stud['studentno'] ?></td>
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
      <?php
      echo "<button type=\"submit\"><a href=\"../php/submit-booking.php?id=$booking_data[id]\">Submit Booking</a></button>"
      ?>
    </div>
    <div class="delete">
      <?php
      echo "<button type=\"submit\"><a href=\"../php/delete-booking.php?id=$booking_data[id]\" onclick='confirmDelete()'>Cancel Booking</a></button>"
      ?>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>
<script>
function confirmDelete() {
  if (confirm("Do you want to cancel this booking?") == true) {

  } else {
    event.preventDefault();
  }
}
</script>
<script>
const data =
  <?php
    if (isset($_GET['data'])) {
      echo "\"$_GET[data]\"";
    }
    ?>

if (data == 1) {
  document.querySelector(".delete").style.visibility = "visible";
  document.querySelector(".confirm").style.visibility = "hidden";
}
if (data == 2) {
  document.querySelector(".delete").style.visibility = "hidden";
  document.querySelector(".confirm").style.visibility = "visible";
}
</script>

</html>
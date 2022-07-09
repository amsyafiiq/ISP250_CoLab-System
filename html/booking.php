<?php
session_start();
include "../php/db_conn.php";

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
  header("Location: login.php");
}

if (!$_SESSION['role'] == -1) {
  $_SESSION['role'] = 1;
}


$sql0 = "SELECT * FROM `vw_booking` WHERE `studentno` = $_SESSION[id]";
$result = mysqli_query($conn, $sql0);
$table = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>UiTM Raub CoLab Systme</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/booking.css" />

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
      <div class="message">
        <i class="fa fa-close" id="close" onclick="closeMessage()"></i>
        <p>
          <?php
          if (isset($_GET['message'])) {
            echo $_GET['message'];
          }
          ?>
        </p>
      </div>
    </div>
  </header>
  <main>
    <div class="title-container">
      <p>BOOKINGS</p>
    </div>
    <div class="main-page">
      <div class="table-container">
        <table id="table" class="table hover">
          <thead>
            <tr>
              <th>Purpose</th>
              <th>Booked Date</th>
              <th>Booked Time</th>
              <th>Lab</th>
              <th>Computer</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($_SESSION['role'] == -1) {
              $sql0 = "SELECT * FROM `vw_booking` WHERE `studentno` = $_SESSION[id]";
              $result = mysqli_query($conn, $sql0);

              while ($row = mysqli_fetch_array($result)) {
                $i = 0;
                echo "<tr>";
                echo "<td>$row[booking_Purpose]</td>";
                echo "<td>$row[booking_UsageDate]</td>";
                echo "<td>$row[booking_UsageTime]</td>";
                echo "<td>$row[lab_Name]</td>";
                echo "<td>$row[comp_ID]</td>";
                echo "<td>$row[approve_Status]</td>";
                echo "<td>
                        <a id='button' href='../php/view-booking.php?id=$row[booking_ID]'>View</a>
                      </td>";
                $i++;
              }
            } else {
              $sql0 = "SELECT * FROM `vw_booking` WHERE `USER_ID` = $_SESSION[id]";
              $result = mysqli_query($conn, $sql0);

              while ($row = mysqli_fetch_array($result)) {
                $i = 0;
                echo "<tr>";
                echo "<td>$row[booking_Purpose]</td>";
                echo "<td>$row[booking_UsageDate]</td>";
                echo "<td>$row[booking_UsageTime]</td>";
                echo "<td>$row[lab_Name]</td>";
                echo "<td>$row[comp_ID]</td>";
                echo "<td>$row[approve_Status]</td>";
                echo "<td>
                        <a id='button' href='../php/view-booking.php?id=$row[booking_ID]'>View</a>
                      </td>";
                $i++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div>
        <div class="button-container">
          <a href="#" id="new-booking">New Booking</a>
        </div>
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>
<script>
  var role = "<?php echo $_SESSION['role'] ?>";
  if (role == -1) {
    document.querySelector("#new-booking").href = "new-stud-book.php";
  } else {
    document.querySelector("#new-booking").href = "new-staff-book.php";
  }
</script>
<script>
  $(document).ready(function() {
    $('#table.table').DataTable({
      "pagingType": "simple",
      "pageLength": 7,
      "lengthChange": false,
    });
  });
</script>
<script>
  if (typeof window.history.pushState == 'function') {
    window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF']; ?>');
  }
</script>
<script>
  message = document.querySelector(".message");

  function closeMessage() {
    message.style.visibility = 'hidden';
  }
</script>
<script>
  var messages =
    <?php
    if (isset($_GET['message'])) {
      echo "\"$_GET[message]\"";
    } else {
      echo -1;
    }
    ?>;
  const messageBox = document.querySelector(".message");
  if (messages == -1) {
    messageBox.style.visibility = "hidden";
  } else {
    messageBox.style.visibility = "visible";
  }
</script>

</html>
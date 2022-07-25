<?php
session_start();
include "../php/db_conn.php";

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] == false) {
  header("Location: login.php");
}

if (!$_SESSION['role'] == -1) {
  $_SESSION['role'] = 1;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>UiTM Raub CoLab System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/report.css" />

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
      <p>REPORTS</p>
    </div>
    <div class="main-page">
      <div class="grid-container">
        <div class="report-section monthly">
          <h3>MONTHLY REPORT</h3>
          <div class="report-container">
            <div class="lab-container lab1">
              <?php
              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Approved' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 1'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $approved = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Pending Approval' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 1'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $pending = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Rejected' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 1'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $rejected = $row['total'];
              ?>
              <h4>Lab 1</h4>
              <h5>Approved</h5>
              <p><?php echo $approved; ?></p>
              <h5>Pending</h5>
              <p><?php echo $pending; ?></p>
              <h5>Rejected</h5>
              <p><?php echo $rejected; ?></p>
            </div>
            <div class="lab-container lab2">
              <?php
              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Approved' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 2'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $approved = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Pending Approval' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 2'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $pending = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Rejected' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 2'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $rejected = $row['total'];
              ?>
              <h4>Lab 2</h4>
              <h5>Approved</h5>
              <p><?php echo $approved; ?></p>
              <h5>Pending</h5>
              <p><?php echo $pending; ?></p>
              <h5>Rejected</h5>
              <p><?php echo $rejected; ?></p>
            </div>
            <div class="lab-container lab3">
              <?php
              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Approved' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 3'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $approved = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Pending Approval' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 3'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $pending = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Rejected' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 3'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $rejected = $row['total'];
              ?>
              <h4>Lab 3</h4>
              <h5>Approved</h5>
              <p><?php echo $approved; ?></p>
              <h5>Pending</h5>
              <p><?php echo $pending; ?></p>
              <h5>Rejected</h5>
              <p><?php echo $rejected; ?></p>
            </div>
            <div class="lab-container lab4">
              <?php
              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Approved' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 4'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $approved = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Pending Approval' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 4'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $pending = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Rejected' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 4'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $rejected = $row['total'];
              ?>
              <h4>Lab 4</h4>
              <h5>Approved</h5>
              <p><?php echo $approved; ?></p>
              <h5>Pending</h5>
              <p><?php echo $pending; ?></p>
              <h5>Rejected</h5>
              <p><?php echo $rejected; ?></p>
            </div>
            <div class="lab-container lab5">
              <?php
              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Approved' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 5'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $approved = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Pending Approval' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 5'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $pending = $row['total'];

              $sql = "SELECT count(*) as total FROM `vw_booking` WHERE approve_Status = 'Rejected' AND MONTH(booking_UsageDate) = MONTH(NOW()) AND lab_Name = 'Lab 5'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              $rejected = $row['total'];
              ?>
              <h4>Lab 5</h4>
              <h5>Approved</h5>
              <p><?php echo $approved; ?></p>
              <h5>Pending</h5>
              <p><?php echo $pending; ?></p>
              <h5>Rejected</h5>
              <p><?php echo $rejected; ?></p>
            </div>
          </div>
        </div>
        <div class="report-section yearly">
          <h3>YEARLY REPORT</h3>
          <div class="lab-container">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src=" ../js/main.js"></script>
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

<?php

$sql =
  "SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 1 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 2 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 3 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 4 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 5 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 6 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 7 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 8 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 9 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 10 AND lab_Name = 'Lab 1'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 11 AND lab_Name = 'Lab 1'
union all
SELECT count(*) FROM `vw_booking` WHERE month(booking_UsageDate) = 12 AND lab_Name = 'Lab 1'";
$lab1 = mysqli_query($conn, $sql);

$sql =
  "SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 1 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 2 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 3 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 4 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 5 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 6 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 7 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 8 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 9 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 10 AND lab_Name = 'Lab 2'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 11 AND lab_Name = 'Lab 2'
union all
SELECT count(*) FROM `vw_booking` WHERE month(booking_UsageDate) = 12 AND lab_Name = 'Lab 2'";
$lab2 = mysqli_query($conn, $sql);

$sql =
  "SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 1 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 2 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 3 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 4 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 5 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 6 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 7 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 8 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 9 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 10 AND lab_Name = 'Lab 3'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 11 AND lab_Name = 'Lab 3'
union all
SELECT count(*) FROM `vw_booking` WHERE month(booking_UsageDate) = 12 AND lab_Name = 'Lab 3'";
$lab3 = mysqli_query($conn, $sql);

$sql =
  "SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 1 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 2 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 3 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 4 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 5 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 6 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 7 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 8 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 9 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 10 AND lab_Name = 'Lab 4'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 11 AND lab_Name = 'Lab 4'
union all
SELECT count(*) FROM `vw_booking` WHERE month(booking_UsageDate) = 12 AND lab_Name = 'Lab 4'";
$lab4 = mysqli_query($conn, $sql);

$sql =
  "SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 1 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 2 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 3 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 4 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 5 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 6 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 7 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 8 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 9 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 10 AND lab_Name = 'Lab 5'
union all
SELECT count(*) as 'total' FROM `vw_booking` WHERE month(booking_UsageDate) = 11 AND lab_Name = 'Lab 5'
union all
SELECT count(*) FROM `vw_booking` WHERE month(booking_UsageDate) = 12 AND lab_Name = 'Lab 5'";
$lab5 = mysqli_query($conn, $sql);
?>



<script>
  var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var lab1 = [];
  var lab2 = [];
  var lab3 = [];
  var lab4 = [];
  var lab5 = [];
  <?php
  $i = 0;
  while ($row = mysqli_fetch_array($lab1, MYSQLI_ASSOC)) {
    echo "lab1[$i] = " . $row['total'] . ";";
    $i++;
  }
  $i = 0;
  while ($row = mysqli_fetch_array($lab2, MYSQLI_ASSOC)) {
    echo "lab2[$i] = " . $row['total'] . ";";
    $i++;
  }
  $i = 0;
  while ($row = mysqli_fetch_array($lab3, MYSQLI_ASSOC)) {
    echo "lab3[$i] = " . $row['total'] . ";";
    $i++;
  }
  $i = 0;
  while ($row = mysqli_fetch_array($lab4, MYSQLI_ASSOC)) {
    echo "lab4[$i] = " . $row['total'] . ";";
    $i++;
  }
  $i = 0;
  while ($row = mysqli_fetch_array($lab5, MYSQLI_ASSOC)) {
    echo "lab5[$i] = " . $row['total'] . ";";
    $i++;
  }

  ?>

  new Chart("myChart", {
    type: "line",
    data: {
      labels: xValues,
      datasets: [{
          label: "Lab 1",
          data: lab1,
          borderColor: "lightgreen",
          fill: false
        },
        {
          label: "Lab 2",
          data: lab2,
          borderColor: "teal",
          fill: false
        },
        {
          label: "Lab 3",
          data: lab3,
          borderColor: "cyan",
          fill: false
        },
        {
          label: "Lab 4",
          data: lab4,
          borderColor: "pink",
          fill: false
        },
        {
          label: "Lab 5",
          data: lab5,
          borderColor: "orange",
          fill: false
        }
      ]
    }
  });
</script>

</html>
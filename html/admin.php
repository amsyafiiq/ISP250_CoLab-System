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
  <title>UiTM Raub CoLab System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/booking.css" />
  <link rel="stylesheet" href="../css/admin.css" />

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
      <p>ADMINISTRATORS</p>
    </div>
    <div class="main-page">
      <div class="table-container">
        <table id="table" class="table hover">
          <thead>
            <tr>
              <th>Staff ID</th>
              <th>Staff Name</th>
              <th>Staff Email</th>
              <th>Jabatan</th>
              <th>Role</th>
              <th>Update Role</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql1 = "SELECT * FROM `vw_staff_phg`";
            $result = mysqli_query($conn, $sql1);

            while ($row = mysqli_fetch_array($result)) {
              echo "<tr>";

              echo "<td>$row[USER_ID]</td>";
              echo "<td>$row[USER_NAME]</td>";
              echo "<td>$row[USER_EMAIL]</td>";
              echo "<td>$row[JABATAN]</td>";

              if ($row['Role_Type'] == "") {
                echo "<td>User</td>";
              } else {
                echo "<td>$row[Role_Type]</td>";
              }
            ?>
            <td id="action">
              <?php echo "<a href=\"../php/setAdmin.php?role=1&id=$row[USER_ID]\">Admin</a>" ?>
              <?php echo "<a href=\"../php/setAdmin.php?role=2&id=$row[USER_ID]\">Approver</a>" ?>
              <?php echo "<a href=\"../php/setAdmin.php?role=3&id=$row[USER_ID]\">Remove Role</a>" ?>
            </td>
            <?php
            }
            ?>
          </tbody>
        </table>
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
    "pageLength": 10,
    "lengthChange": false,
    "order": [1, "asc"],
    'columnDefs': [{
      "targets": 5,
      "className": "approve_status"
    }],
    dom: '<"ddl-container">frtip'
  });
  $('div.ddl-container').html(
    "<select id='ddl-filter' class='form-control'><option value='All'>All</option><option value='Admin'>Admin</option><option value='Approver'>Approver</option><option value='User'>User</option></select>"
  );
  $('#ddl-filter').on('change', function() {
    var filterValue = this.value;
    if (filterValue == 'All') {
      $('#table.table').DataTable().column(4).search('').draw();
    } else {
      $('#table.table').DataTable().column(4).search(filterValue).draw();
    }
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
<script>
if (document.querySelector(".approve_status").innerHTML != null) {
  approveStatus = document.querySelector(".approve_status").innerText;
  console.log(approveStatus);
}


function approveClick() {
  if (confirm("Confirm approval?")) {

  } else {
    event.preventDefault();
  }
}

function rejectClick() {
  if (confirm("Confirm rejecting?")) {

  } else {
    event.preventDefault();
  }
}
</script>

</html>
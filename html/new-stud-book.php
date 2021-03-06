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
  <link rel="stylesheet" href="../css/new-stud-book.css" />

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
      <p>BOOKING PAGE - New Book (Student)</p>
    </div>
    <div class="main-page">
      <div>
        <form action="../php/create-booking.php" method="post">
          <label for="purpose">BOOKING PURPOSE</label><br />
          <input type="text" placeholder="" id="purpose" name="purpose" /><br />
          <label for="booking-date" id="date">BOOKING DATE</label>
          <label for="booking-time" id="time">TIME</label><br />
          <input type="date" id="booking-date" name="booking-date" />
          <input type="time" id="booking-time" name="booking-time" /><br />
          <label for="lab">LAB</label><br>
          <select name="lab" id="lab" class="lab">
            <option value="-1">Select Lab</option>
            <?php
            $sql = "SELECT * from `LAB`";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) == 0) {
              echo "ERROR";
            } else {
              while ($row = mysqli_fetch_assoc($query)) {
                echo "<option value=" . $row['lab_ID'] . ">$row[lab_Name]</option>";
              }
            }
            ?>
          </select><br>
          <label for="computers">COMPUTER</label><br />
          <select name="computer" id="computers">
            <option value="-1">Select Computer</option>
          </select>
          <button type="submit" id="submit" name="submit" value="1" action>NEXT</button>
        </form>
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
  $("select.lab").change(function() {
    var selectedLab = $(".lab option:selected").val();
    $.ajax({
      type: "POST",
      url: "process-request.php",
      data: {
        lab: selectedLab
      }
    }).done(function(data) {
      $("#computers").html(data);
    });
  });
});
</script>

</html>
<?php
session_start();

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
  <title>UiTM Raub CoLab Systme</title>
  <link rel="stylesheet" href="../fonts/stylesheet.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/booking.css" />
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
    <div class="title-container">
      <p>BOOKING PAGE</p>
    </div>
    <div class="main-page">
      <div class="title">
        <h1>Want to use the lab?</h1>
      </div>
      <div class="new-booking">
        <a href="#" id="new-booking"> New Book </a>
      </div>
      <div class="search-booking">
        <a href="#"> Search Booking </a>
      </div>
    </div>
  </main>
  <footer></footer>
</body>
<script src="../js/main.js"></script>
<script>
  var role = "<?php echo $_SESSION['role'] ?>";
  console.log(role);

  if (role == -1) {
    document.querySelector("#new-booking").href = "new-stud-book.php";
  } else {
    document.querySelector("#new-booking").href = "new-staff-book.php";
  }
</script>

</html>
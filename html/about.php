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
    <link rel="stylesheet" href="/css/about.css" />
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
              <li><a href="#" class="nav-link">HOME</a></li>
              <li><a href="#" class="nav-link">BOOKING</a></li>
              <li><a href="#" class="nav-link">REPORT</a></li>
              <li><a href="#" class="nav-link about">ABOUT COLAB</a></li>
              <li><a href="#" class="nav-link help">HELP</a></li>
            </ul>
            <div class="logout-container">
              <a href="#">LOGOUT</a>
            </div>
          </nav>
        </div>
        <div class="name-holder"><a href="index.html"></a>
          <p>COLAB RAUB</p>
        </div>
      </div>
      <div class="right-container">
        <ul>
          <li><a href="about.html">ABOUT COLAB</a></li>
          <li><a href="#">HELP</a></li>
        </ul>
      </div>
    </header>
    <main>
      <div class="title-container">
        <p>ABOUT</p>
      </div>
      <div class="main-page">
        <div>
            <p class="abt-h1">COLAB RAUB System</p>
            <br>
            <p class="abt-h2">Computer Lab System (COLAB System) for UiTM Raub was built since 2022 by a group of CS110 students for their ISP250 Final Project.
                <br>This project aims to give an aid for all UiTM Raub user especially in this infostructure section to give the the best services of computer lab
                <br>that this campus have ever had. However, this system is still in progress and needs more observations from time to time to keep it updated as soon as possible
                <br>so that all user will be able to experience the most mesmerizing way in booking a computer or a lab in UiTM Raub.
            </p>
        </div>
      </div>
      
    </main>
    <footer></footer>
  </body>
  <script src="../js/main.js"></script>
</html>

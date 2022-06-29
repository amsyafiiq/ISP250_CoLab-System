<?php
session_start();
include "db_conn.php";
include "../html/login.php";

$id = $_POST['id'];
$password = $_POST['password'];
$radio = $_POST['user'];

$sql;
$result;

if ($radio == 1) {
  $sql = "SELECT * FROM `vw_staff_phg` WHERE `USER_ID`='$id' AND `USER_PASSWORD`='$password' ";
  $result = mysqli_query($conn, $sql);
} else if ($radio == 2) {
  $sql = "SELECT * FROM `vw_student_phg` WHERE `studentno`='$id' AND `studenticno`='$password' ";
  $result = mysqli_query($conn, $sql);
} else {
  header("Location: ../html/login.php?error=PLEASE SELECT STAFF OR STUDENT");
  exit();
}

if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);

  if ($radio == 1) {
    if ($row['USER_ID'] === $id && $row['USER_PASSWORD'] === $password) {
      echo "Logged";
      $_SESSION['id'] = $row['USER_ID'];
      $_SESSION['username'] = $row['USER_NAME'];
      $_SESSION['password'] = $row['USER_PASSWORD'];
      $_SESSION['role'] = $row['Role_ID'];
      $_SESSION['logged-in'] = true; 
      header("Location: ../html/index.php");
      exit();
    }
    header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORD");
    exit();
  } else if ($radio == 2) {
    if ($row['studentno'] === $id && $row['studenticno'] === $password) {
      echo "Logged";
      $_SESSION['id'] = $row['studentno'];
      $_SESSION['username'] = $row['studentname'];
      $_SESSION['password'] = $row['studenticno'];
      $_SESSION['logged-in'] = true;
      $_SESSION['role'] = -1;
      header("Location: ../html/index.php");
      exit();
    }
    header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORD");
    exit();
  }
} else {
  header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORD");
  exit();
}
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
  $sql = "SELECT * FROM `user` WHERE `USER_ID`='$id' AND `USER_PASSWORD`='$password' ";
  $result = mysqli_query($conn, $sql);
} else if ($radio == 2) {
  $sql = "SELECT * FROM `students` WHERE `studentno`='$id' AND `studenticno`='$password' ";
  $result = mysqli_query($conn, $sql);
} else {
  header("Location: ../html/login.php?error=Please Select Staff or Student");
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
      header("Location: ../html/inde.php");
      exit();
    }
    header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORDs");
    exit();
  } else if ($radio == 2) {
    if ($row['studentno'] === $id && $row['studenticno'] === $password) {
      echo "Logged";
      $_SESSION['id'] = $row['studentno'];
      $_SESSION['username'] = $row['studentname'];
      $_SESSION['password'] = $row['studenticno'];
      header("Location: ../html/inde.php");
      exit();
    }
    header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORDs");
    exit();
  }
} else {
  header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORD");
  exit();
}

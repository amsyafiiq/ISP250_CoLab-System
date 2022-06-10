<?php
session_start();
include "db_conn.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM student WHERE username='$username' AND password='$password' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  if($row['username'] === $username && $row['password'] === $password) {
    echo "Logged";
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    header("Location: ../html/index.html");
    exit;
  } else {
    
    header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORD");
    exit();
  }
} else {
  header("Location: ../html/login.php?error=INVALID USERNAME OR PASSWORD");
  exit();
}
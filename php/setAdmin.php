<?php
include "db_conn.php";
$newRole = $_GET['role'];

$sql0 = "SELECT * FROM user_role WHERE `USER_ID` = '$_GET[id]'";
$result = mysqli_query($conn, $sql0);

if (mysqli_num_rows($result) === 1) {
  $sql = "UPDATE user_role SET Role_ID = $newRole WHERE `USER_ID` = $_GET[id]";
  echo $sql;

  if (mysqli_query($conn, $sql)) {
    header("Location: ../html/admin.php?message=USER ROLE SUCCESSFULLY UPDATED");
  } else {
    echo mysqli_error($conn);
  }
} else {
  $sql = "INSERT INTO user_role VALUES ($_GET[id], $newRole)";

  echo $sql;

  if (mysqli_query($conn, $sql)) {
    header("Location: ../html/admin.php?message=USER ROLE SUCCESSFULLY UPDATED");
  } else {
    echo mysqli_error($conn);
  }
}



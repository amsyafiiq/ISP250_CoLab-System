<?php

include "db_conn.php";

$sql = "SELECT * FROM `approval` WHERE `approve_ID` = '$_GET[id]'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
  $sql0 = "UPDATE `approval` SET `approve_Status` = 'Approved' WHERE `approve_ID` = '$_GET[id]'";
  if (mysqli_query($conn, $sql0)) {
    header("Location: ../html/approval.php?message=BOOKING STATUS UPDATED");
  } else {
    echo mysqli_error($conn);
  }
} else {
  echo mysqli_error($conn);
}
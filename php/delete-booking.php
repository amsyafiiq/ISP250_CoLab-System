<?php
include "db_conn.php";

if (isset($_GET['id'])) {
  echo $_GET['id'];

  $sql0 = "UPDATE `approval` SET approve_Status = 'Canceled' WHERE approve_ID = '$_GET[id]'";

  if (mysqli_query($conn, $sql0)) {
      header("Location: ../html/booking.php?message=BOOKING SUCCESSFULLY CANCELED");
  } else {
    mysqli_error($conn);
  }
}
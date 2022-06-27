<?php
include "db_conn.php";

if (isset($_GET['id'])) {
  echo $_GET['id'];

  $sql = "DELETE FROM `booking` WHERE booking_ID = '$_GET[id]'";
  $sql0 = "DELETE FROM `approval` WHERE approve_ID = '$_GET[id]'";

  if (mysqli_query($conn, $sql0)) {
    if (mysqli_query($conn, $sql)) {
      header("Location: ../html/booking.php?message=Booking Succesfully Deleted");
    } else {
      mysqli_error($conn);
    }
  } else {
    mysqli_error($conn);
  }
}
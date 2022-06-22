<?php
session_start();
include "../php/db_conn.php";
$booking_data = $_SESSION['booking_data'];

if ($booking_data['comp'] === -1) {
  $sql = "INSERT INTO `booking` (booking_ID, booking_Purpose, booking_TimeDate, booking_UsageDate, booking_UsageTime, `USER_ID`, lab_Id)" .
    "VALUES ('$booking_data[id]', '$booking_data[purpose]', '$booking_data[currDateTime]', '$booking_data[bookedDate]', '$booking_data[bookedTime]', '$_SESSION[id]', $booking_data[lab])";
} else {
  if ($booking_data['id-type'] === "staff") {
    $sql = "INSERT INTO `booking` (booking_ID, booking_Purpose, booking_TimeDate, booking_UsageDate, booking_UsageTime, comp_ID, `USER_ID`, lab_Id)" .
      "VALUES ('$booking_data[id]', '$booking_data[purpose]', '$booking_data[currDateTime]', '$booking_data[bookedDate]', '$booking_data[bookedTime]', '$booking_data[comp]', '$_SESSION[id]', $booking_data[lab])";
  } else {
    $sql =
      "INSERT INTO `booking` (booking_ID, booking_Purpose, booking_TimeDate, booking_UsageDate, booking_UsageTime, comp_ID, `studentno`, lab_Id)" .
      "VALUES ('$booking_data[id]', '$booking_data[purpose]', '$booking_data[currDateTime]', '$booking_data[bookedDate]', '$booking_data[bookedTime]', '$booking_data[comp]', '$_SESSION[id]', $booking_data[lab])";
    echo $sql;
  }
}


if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Data saved. Please check from time to time for the approval')</script>";
  $sql0 = "INSERT INTO `approval` (approve_ID, approve_Status, booking_ID)" .
  "VALUES ('$booking_data[id]', 'Pending Approval', '$booking_data[id]')";

  if(mysqli_query($conn, $sql0)) {
    header("Location: ../html/booking.php?Booking Success. Please check from time to time for the approval");
  }
  // header("Location: ../html/booking.php");
} else {
  echo mysqli_error($conn);
}

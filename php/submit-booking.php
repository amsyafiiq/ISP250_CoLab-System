<?php
session_start();
include "../php/db_conn.php";
$booking_data = $_SESSION['booking_data'];
$sql = "INSERT INTO `booking` (booking_ID, booking_Purpose, booking_TimeDate, booking_UsageDate, booking_UsageTime, comp_ID, studentno)" .
"VALUES ('$booking_data[id]', '$booking_data[purpose]', '$booking_data[currDateTime]', '$booking_data[bookedDate]', '$booking_data[bookedTime]', '$booking_data[comp]', '$_SESSION[id]')";
echo $sql;

if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Data saved. Please check from time to time for the approval')</script>";
  header("Location: ../html/booking.php");
} else {
  echo mysqli_error($conn);
}
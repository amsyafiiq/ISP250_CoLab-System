<?php 
session_start();
include "db_conn.php";
date_default_timezone_set("Asia/Kuala_Lumpur");

function createID($conn) {
  $sql = "SELECT * from `booking` t1 WHERE (SELECT MAX(booking_TimeDate) as max_date from `booking`) = booking_TimeDate";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $max_date = strtotime($row['booking_TimeDate']);
  } else {
    echo mysqli_error($conn);
  }

  $lastid = $row['booking_ID'];
  (int)$num = substr($lastid, 6);
  $num++;
  $id = date("ymd", $max_date) . sprintf("00%d", $num);
  return $id;
}

if (isset($_POST['submit'])) {
  $booking_data = array(
    "id" => createID($conn),
    "purpose" => $_POST['purpose'],
    "currDateTime" => date("Y-m-d H:i:s"),
    "bookedDate" => $_POST['booking-date'],
    "bookedTime" => $_POST['booking-time']
  );

  if ($_POST['submit'] == 1) {
    $booking_data += array("comp" => $_POST['computer']);
    
    echo $sql;
    $_SESSION['booking_data'] = $booking_data;
    header("Location: ../html/studentBookinginfo.php");
  } else {

  }
}

?>
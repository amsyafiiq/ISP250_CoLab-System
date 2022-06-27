<?php
session_start();
include "db_conn.php";

if(isset($_GET['id'])) {
  $sql0 = "SELECT * FROM `vw_booking` WHERE `booking_ID` = '$_GET[id]'";
  echo $sql0;

  if ($result = mysqli_query($conn, $sql0)) {
    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      $booking_data = array(
        "id" => $row['booking_ID'],
        "purpose" => $row['booking_Purpose'],
        "bookedDate" => $row['booking_UsageDate'],
        "bookedTime" => $row['booking_UsageTime'],
        "lab" => $row['lab_Name'],
        "comp" => $row['comp_ID']
      );

      if ($row['USER_ID'] !== null) {
        $booking_data += array("userid" => $row['USER_ID']);
        $booking_data += array("id-type" => "staff");
        $_SESSION['booking_data'] = $booking_data;
        header("Location: ../html/staffBookingInfo.php?data=1");
      } else {
        $booking_data += array("userid" => $row['studentno']);
        $_SESSION['booking_data'] = $booking_data;
        $booking_data += array("id-type" => "stud");
        header("Location: ../html/studentBookingInfo.php?data=1");
      }
    }
  } else {
    echo mysqli_error($conn);
  }
}


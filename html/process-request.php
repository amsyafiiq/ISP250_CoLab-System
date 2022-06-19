<?php
include "../php/db_conn.php";
if (isset($_POST['lab'])) {
  $lab = $_POST['lab'];

  if ($lab !== "-1") {
    $sql = "SELECT * FROM `COMPUTER` WHERE lab_ID = '$lab'";
    $query = mysqli_query($conn, $sql);

    echo "<option value='-1'>Select Computer</option>";
    if (mysqli_num_rows($query) == 0) {
      echo "ERROR";
    } else {
      while ($row = mysqli_fetch_assoc($query)) {
        echo "<option value=" . $row['comp_ID'] . ">$row[comp_ID]</option>";
      }
    }
  } else {
    echo "<option value='-1'>Select Computer</option>";
  }
}

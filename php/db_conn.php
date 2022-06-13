<?php

$name = "localhost";
$username = "root";
$password = "";
$db_name = "isp250_v2";

$conn = mysqli_connect($name, $username, $password, $db_name);

if (!$conn) {
  echo "Connection Failed";
}

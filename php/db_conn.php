<?php

$name = "localhost";
$username = "root";
$password = "";
$db_name = "db_test";

$conn = mysqli_connect($name, $username, $password, $db_name);

if (!$conn) {
  echo "Connection Failed";
}

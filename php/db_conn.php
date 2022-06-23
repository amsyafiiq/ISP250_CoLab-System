<?php

$name = "localhost";
$username = "root";
$password = "";
$db_name = "uitm_colab_system";

$conn = mysqli_connect($name, $username, $password, $db_name);

if (!$conn) {
  echo "Connection Failed";
}
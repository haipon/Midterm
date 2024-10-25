<?php
$hostName = "localhost";
$dbUser = "u260447614_cd";
$dbPassword = "Midterm711";
$dbName = "u260447614_ab";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

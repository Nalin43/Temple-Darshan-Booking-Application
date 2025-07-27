<?php
$host = "localhost";
$user = "root";
$pass = ""; // or your MySQL password
$dbname = "temple"; // your database name

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

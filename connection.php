<?php
$host = "localhost";
$user = "root"; // default for XAMPP
$password = "";
$database = "temple"; // make sure this matches your actual DB name

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

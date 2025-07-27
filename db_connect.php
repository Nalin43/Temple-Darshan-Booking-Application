<?php
$conn = mysqli_connect("localhost", "root", "", "temple");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

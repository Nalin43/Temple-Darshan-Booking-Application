<?php
session_start();
include "db.php";

$email = $_POST["email"];
$password = $_POST["password"];

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row["password"])) {
        $_SESSION["email"] = $row["email"];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Incorrect password'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('User not found'); window.location.href='index.php';</script>";
}
?>

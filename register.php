<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db.php"; // your DB connection file

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('User already exists'); window.location.href='register.php';</script>";
        exit();
    }

    $query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    if (mysqli_query($conn, $query)) {
        $_SESSION["email"] = $email;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Registration failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('temple_bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .register-box {
            margin: auto;
            margin-top: 5%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px #28a745;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-5 register-box">
        <h2 class="text-center text-success">Register</h2>
        <form method="POST">
            <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <input type="text" name="phone" class="form-control mb-3" placeholder="Phone" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
            <button class="btn btn-success w-100">Register</button>
        </form>
    </div>
</div>
</body>
</html>

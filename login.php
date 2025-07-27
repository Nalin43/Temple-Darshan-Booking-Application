<?php
session_start();
$conn = new mysqli("localhost", "root", "", "temple");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Invalid email or password!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Devotee Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('shivan_.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background-color: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
<div class="card">
    <h3 class="text-center text-primary mb-4">Devotee Login</h3>
    <form method="POST">
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Enter Password" required>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
        <?php if (isset($error)) echo "<div class='text-danger mt-2 text-center'>$error</div>"; ?>
    </form>
</div>
</body>
</html>

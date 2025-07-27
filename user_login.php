<?php
session_start();
$conn = new mysqli("localhost", "root", "", "temple");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: user_dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        body { font-family: Arial; background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 350px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px; width: 100%; background: #2e3cbf; color: white; border: none; }
        .error { color: red; }
    </style>
</head>
<body>

<form method="post">
    <h2>User Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email ID" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <p>Don't have an account? <a href="user_register.php">Register here</a></p>
</form>

</body>
</html>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin123") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    <style>
        /* Reset and base */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg,rgb(218, 161, 253), #c2e9fb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.97);
            padding: 40px 35px;
            border-radius: 18px;
            box-shadow:
                0 8px 32px rgba(11, 162, 157, 0.15),
                0 4px 15px rgba(11, 162, 157, 0.1);
            width: 350px;
            text-align: center;
            position: relative;
            transition: transform 0.3s ease;
        }
        .login-box:hover {
            transform: translateY(-6px);
            box-shadow:
                0 12px 40px rgba(11, 162, 157, 0.25),
                0 6px 25px rgba(11, 162, 157, 0.15);
        }
        .title {
            font-size: 28px;
            font-weight: 700;
            color: #0a2540;
            margin-bottom: 12px;
            user-select: none;
        }
        h2 {
            font-weight: 600;
            margin-bottom: 28px;
            color: #1e3c72;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            margin: 14px 0;
            border: 2px solidrgb(199, 137, 246);
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #36d1dc;
            box-shadow: 0 0 10px #36d1dc;
        }
        button {
            background: linear-gradient(90deg,rgb(167, 127, 236), #5b86e5);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 14px rgba(54, 209, 220, 0.6);
            transition: background 0.3s ease, transform 0.2s ease;
            user-select: none;
        }
        button:hover {
            background: linear-gradient(90deg, #5b86e5, #36d1dc);
            transform: scale(1.05);
        }
        button:active {
            transform: scale(0.98);
        }
        .error {
            color: #d94e4e;
            font-weight: 600;
            margin-top: 14px;
            background: #ffe1e1;
            padding: 8px 12px;
            border-radius: 10px;
            box-shadow: inset 0 0 8px #d94e4e70;
            user-select: none;
            animation: shake 0.3s ease 0s 2;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            50% { transform: translateX(6px); }
            75% { transform: translateX(-6px); }
        }

        /* Responsive */
        @media (max-width: 400px) {
            .login-box {
                width: 90vw;
                padding: 35px 25px;
            }
            .title {
                font-size: 24px;
            }
            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

    <main class="login-box" role="main" aria-labelledby="login-title">
        <div class="title" id="login-title" aria-live="polite" aria-atomic="true" aria-relevant="additions">🛕 Admin Panel</div>
        <h2>Login</h2>
        <?php if (!empty($error)) echo "<div class='error' role='alert'>$error</div>"; ?>
        <form method="post" autocomplete="off" aria-describedby="login-error">
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required aria-required="true" autofocus>

            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required aria-required="true">

            <button type="submit" aria-label="Login to admin panel">Login</button>
        </form>
    </main>

    <style>
        /* Screen reader only text */
        .sr-only {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0,0,0,0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
    </style>

</body>
</html>

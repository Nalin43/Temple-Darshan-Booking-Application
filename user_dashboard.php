<?php
session_start();

// Dummy session check — replace this with real login check
if (!isset($_SESSION['user_name'])) {
    $_SESSION['user_name'] = 'Devotee'; // Remove this line after integrating real login
    // header("Location: login.php");
    // exit;
}

$userName = $_SESSION['user_name'];
date_default_timezone_set("Asia/Kolkata");
$time = date("h:i:s A");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            position: fixed;
            width: 220px;
            height: 100%;
            background: #2e3cbf;
            color: white;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #1f2aad;
        }

        .main {
            margin-left: 220px;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 5px;
        }

        .welcome {
            font-size: 20px;
        }

        .time {
            color: red;
            font-weight: bold;
        }

        .cards {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            flex: 1 1 calc(33.33% - 20px);
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card h3 {
            margin: 0 0 10px;
            color: #444;
        }

        .card p {
            color: #888;
        }

        .blue { background-color: #1e90ff; color: white; }
        .green { background-color: #28a745; color: white; }
        .red { background-color: #dc3545; color: white; }
        .pink { background-color: #ff69b4; color: white; }
        .orange { background-color: #fd7e14; color: white; }
        .purple { background-color: #6f42c1; color: white; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Devotee Panel</h2>
    <a href="#">New Booking</a>
    <a href="#">Booking Details</a>
    <a href="#">Donation</a>
    <a href="#">Festivals</a>
    <a href="#">Payment Slip</a>
    <a href="#">Logout</a>
</div>

<div class="main">
    <div class="header">
        <div class="welcome">Welcome back, <?php echo htmlspecialchars($userName); ?></div>
        <div class="time">Time: <?php echo $time; ?></div>
    </div>

    <div class="cards">
        <div class="card blue">
            <h3>New Booking</h3>
            <p>View or Make Darshan Bookings</p>
        </div>
        <div class="card green">
            <h3>Booking Details</h3>
            <p>Your past and present bookings</p>
        </div>
        <div class="card red">
            <h3>Donation</h3>
            <p>Track your donations</p>
        </div>
        <div class="card pink">
            <h3>Festivals</h3>
            <p>Festival events at the temple</p>
        </div>
        <div class="card orange">
            <h3>Payment Slip</h3>
            <p>Download slips and invoices</p>
        </div>
        <div class="card purple">
            <h3>Profile / Logout</h3>
            <p>Manage account or sign out</p>
        </div>
    </div>
</div>

</body>
</html>

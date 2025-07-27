<?php
session_start();

// ✅ Check if the devotee is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

include("../includes/db.php");

$name = $_SESSION['name'];
$uid = $_SESSION['user_id'];

// ✅ Fetch user data securely
$stmt = mysqli_prepare($conn, "SELECT name, email, phone FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $db_name, $email, $phone);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Devotee Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f7f9fb;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #6a1b9a;
            color: white;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            padding: 15px;
            font-size: 18px;
            margin: 10px 0;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            display: block;
        }

        .sidebar a:hover {
            background-color: #8e24aa;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            background-color: #6a1b9a;
            padding: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            background-color: #e74c3c;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .centered-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 50px;
            justify-items: center;
        }

        .centered-buttons button {
            padding: 20px 40px;
            font-size: 24px;
            width: 80%;
            background-color: #8e24aa;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .centered-buttons button:hover {
            background-color: #6a1b9a;
        }

        .content-section {
            display: none;
            padding: 30px;
        }

        table {
            width: 70%;
            margin: auto;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 14px;
            text-align: center;
        }

        th {
            background-color: #8e24aa;
            color: white;
        }

        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #16a085;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #1abc9c;
        }
    </style>

    <script>
        function showSection(sectionId) {
            document.querySelector('.centered-buttons').style.display = 'none';
            document.querySelectorAll('.content-section').forEach(sec => {
                sec.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        function goBack() {
            document.querySelector('.centered-buttons').style.display = 'grid';
            document.querySelectorAll('.content-section').forEach(sec => {
                sec.style.display = 'none';
            });
        }
    </script>
</head>
<body>

<div class="sidebar">
    <h2>Devotee Panel</h2>
    <a href="javascript:void(0)" onclick="showSection('profile')">Profile</a>
    <a href="new_booking.php">Book Darshan</a>
    <a href="booking_details.php">Booking History</a>
    <a href="payment_slip.php">Payment Slip</a>
</div>

<div class="main-content">
    <div class="header">
        <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="centered-buttons">
        <button onclick="showSection('profile')">Profile</button>
        <button onclick="window.location.href='new_booking.php'">Book Darshan</button>
        <button onclick="window.location.href='booking_details.php'">Booking History</button>
        <button onclick="window.location.href='payment_slip.php'">Payment Slip</button>
    </div>

    <div id="profile" class="content-section">
        <h2>Your Profile</h2>
        <table>
            <tr><th>Name</th><td><?php echo htmlspecialchars($db_name); ?></td></tr>
            <tr><th>Email</th><td><?php echo htmlspecialchars($email); ?></td></tr>
            <tr><th>Phone</th><td><?php echo htmlspecialchars($phone); ?></td></tr>
        </table>
        <button class="back-btn" onclick="goBack()">Back</button>
    </div>
</div>

</body>
</html>

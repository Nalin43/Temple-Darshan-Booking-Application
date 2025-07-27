<?php
$host = 'localhost';
$db = 'temple';
$user = 'root';
$pass = ''; // Set your DB password

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Fetch all devotees (regardless of status)
$sql = "SELECT * FROM bookings ORDER BY booking_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Devotees - Palamalai Temple</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2fb;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            background-color: #2e3cb6;
            width: 220px;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            color: white;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            background-color: #1e2c85;
        }
        .main {
            margin-left: 240px;
            padding: 20px;
        }
        .main h1 {
            color: #2e3cb6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2e3cb6;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .accepted {
            color: green;
            font-weight: bold;
        }
        .rejected {
            color: red;
            font-weight: bold;
        }
        .temple-info {
            background-color: #fff3cd;
            padding: 15px;
            margin-top: 20px;
            border-left: 6px solid #ffc107;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Palamalai Temple</h2>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="temple_list.php">🏯 Temple</a>
    <a href="festivals.php">🎉 Festivals</a>
    <a href="donations.php">💰 Donations</a>
    <a href="devotees.php">🧎 Devotees</a>
    <a href="reports.php">📊 Reports</a>
    <a href="logout.php">🔐 Logout</a>
</div>

<div class="main">
    <h1>Total Registered Devotees</h1>

    <div class="temple-info">
        <strong>About Palamalai Murugan Temple:</strong><br>
        Nestled in the scenic hills of Coimbatore, Palamalai Murugan Temple is a divine abode dedicated to Lord Muruga. With breathtaking views, traditional rituals, and vibrant festivals, it draws devotees from all over Tamil Nadu. The temple offers serene spiritual experiences and regular darshan services for all devotees.
    </div>

    <table>
        <tr>
            <th>Devotee Name</th>
            <th>Temple Name</th>
            <th>Booking Date</th>
            <th>Timing</th>
            <th>Vehicle Parking</th>
            <th>Archanai Token</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $statusClass = $row['status'] == 'Accepted' ? 'accepted' : ($row['status'] == 'Rejected' ? 'rejected' : '');
                echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['temple_name']}</td>
                    <td>{$row['booking_date']}</td>
                    <td>{$row['temple_time']}</td>
                    <td>{$row['vehicle_parking']}</td>
                    <td>{$row['archanai_token']}</td>
                    <td class='$statusClass'>{$row['status']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No registered devotees found.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

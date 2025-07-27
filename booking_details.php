<?php
session_start();
include("connection.php");

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "Please log in first.";
    exit;
}

$user_email = $_SESSION['email'];

// Get bookings for this user
$sql = "SELECT * FROM payment_process WHERE email = ? ORDER BY paid_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Total collection for this user
$total_collection = 0;
$rows = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total_collection += (int)$row['total_amount'];
        $rows[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
    echo "<pre>"; print_r($rows); echo "</pre>";

<head>
    <title>Your Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        /* same styling as before */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #4a148c;
            margin-bottom: 10px;
        }

        .summary {
            text-align: center;
            font-size: 18px;
            color: green;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        th {
            background: #7e57c2;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f3e5f5;
        }

        tr:hover {
            background-color: #ede7f6;
        }
    </style>
</head>
<body>
<h2>🙏 Welcome, <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Devotee' ?>!</h2>

<p class="summary">You have donated/paid ₹<?= number_format($total_collection) ?> in total</p>

<?php if (!empty($rows)): ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Temple</th>
            <th>Darshan Type</th>
            <th>Date</th>
            <th>Time Slot</th>
            <th>No. of Persons</th>
            <th>Amount Paid (₹)</th>
            <th>Payment ID</th>
            <th>Paid At</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($rows as $row): ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['temple']) ?></td>
            <td><?= htmlspecialchars($row['darshan_type']) ?></td>
            <td><?= htmlspecialchars($row['date_of_darshan']) ?></td>
            <td><?= htmlspecialchars($row['time_slot']) ?></td>
            <td><?= htmlspecialchars($row['persons']) ?></td>
            <td>₹<?= htmlspecialchars($row['total_amount']) ?></td>
            <td><?= htmlspecialchars($row['payment_id']) ?></td>
            <td><?= htmlspecialchars($row['paid_at']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p style="text-align:center; color:gray;">No bookings found.</p>
<?php endif; ?>

</body>
</html>

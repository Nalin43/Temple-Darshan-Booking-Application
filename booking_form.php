<?php
session_start();
if (!isset($_SESSION["slip_data"])) {
    header("Location: booking_form.php");
    exit();
}
$data = $_SESSION["slip_data"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Darshan Payment Slip</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            padding: 60px;
            text-align: center;
        }
        .slip {
            background: #fff;
            padding: 30px;
            max-width: 500px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
        }
        .details p {
            margin: 8px 0;
            font-size: 16px;
        }
        .amount {
            color: green;
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
        }
        button {
            margin-top: 25px;
            padding: 12px 25px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="slip">
    <h2>🧾 Darshan Payment Slip</h2>
    <div class="details">
        <p><strong>Name:</strong> <?= htmlspecialchars($data["name"]) ?></p>
        <p><strong>Temple:</strong> <?= htmlspecialchars($data["temple"]) ?></p>
        <p><strong>Darshan Type:</strong> <?= htmlspecialchars($data["darshan_type"]) ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($data["time"]) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($data["date"]) ?></p>
        <p><strong>Persons:</strong> <?= htmlspecialchars($data["persons"]) ?></p>
        <p class="amount">Total Paid: ₹<?= htmlspecialchars($data["total"]) ?></p>
    </div>
    <button onclick="window.print()">🖨️ Print / Download Receipt</button>
</div>

</body>
</html>

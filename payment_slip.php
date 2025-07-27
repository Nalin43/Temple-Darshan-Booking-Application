<?php
session_start();
$data = $_SESSION['last_payment'] ?? null;
if (!$data) {
    echo "No payment found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Slip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            padding: 40px;
        }
        .slip-box {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        h3 {
            text-align: center;
            color: #4a148c;
            margin-bottom: 20px;
        }
        table td {
            padding: 8px 10px;
        }
    </style>
</head>
<body>

<div class="slip-box">
    <h3>🧾 Temple Darshan Booking Slip</h3>
    <table class="table table-bordered">
        <tr><td><strong>Name</strong></td><td><?= htmlspecialchars($data['name']) ?></td></tr>
        <tr><td><strong>Temple</strong></td><td><?= htmlspecialchars($data['temple']) ?></td></tr>
        <tr><td><strong>Darshan Type</strong></td><td><?= htmlspecialchars($data['darshan_type']) ?></td></tr>
        <tr><td><strong>Date</strong></td><td><?= htmlspecialchars($data['date']) ?></td></tr>
        <tr><td><strong>Time Slot</strong></td><td><?= htmlspecialchars($data['time']) ?></td></tr>
        <tr><td><strong>No. of Persons</strong></td><td><?= htmlspecialchars($data['persons']) ?></td></tr>
        <tr><td><strong>Total Amount Paid</strong></td><td>₹<?= htmlspecialchars($data['total']) ?></td></tr>
        <tr><td><strong>Payment ID</strong></td><td><?= htmlspecialchars($data['payment_id']) ?></td></tr>
        <tr><td><strong>Paid At</strong></td><td><?= htmlspecialchars($data['paid_at']) ?></td></tr>
    </table>
    <div class="text-center mt-3">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Print Slip</button>
    </div>
</div>

</body>
</html>

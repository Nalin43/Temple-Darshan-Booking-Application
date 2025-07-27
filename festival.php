<?php
include("connection.php");

// Handle status update from admin
if (isset($_GET['mark_paid'])) {
    $id = $_GET['mark_paid'];
    $conn->query("UPDATE festival_bookings SET payment_status = 'Paid' WHERE id = $id");
    header("Location: festival.php");
    exit();
}

if (isset($_GET['mark_pending'])) {
    $id = $_GET['mark_pending'];
    $conn->query("UPDATE festival_bookings SET payment_status = 'Pending' WHERE id = $id");
    header("Location: festival.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Festival Payment Status</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #f8f9fa, #e0f7fa);
      padding: 40px;
    }

    h2 {
      text-align: center;
      color: #4a148c;
    }

    .btn-back {
      display: inline-block;
      margin-bottom: 20px;
      background-color: #6a1b9a;
      color: white;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 8px;
      font-size: 16px;
      transition: 0.3s;
    }

    .btn-back:hover {
      background-color: #4a148c;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
      margin-top: 20px;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 14px;
      text-align: center;
      border: 1px solid #ddd;
      font-size: 15px;
    }

    th {
      background-color: #6a1b9a;
      color: white;
    }

    .paid {
      background-color: #4caf50;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
    }

    .pending {
      background-color: #f44336;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
    }

    .receipt-button {
      background-color: #2196f3;
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    .receipt-button:hover {
      background-color: #1976d2;
    }

    .mark-button {
      background-color: #ff9800;
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    .mark-button:hover {
      background-color: #e65100;
    }
  </style>
</head>
<body>

<a href="admin_dashboard.php" class="btn-back"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>

<h2>🎉 Festival Payment Status – All Devotees</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Devotee Name</th>
    <th>Phone</th>
    <th>Festival</th>
    <th>Date</th>
    <th>Temple</th>
    <th>Amount (₹)</th>
    <th>Transaction ID</th>
    <th>Booked At</th>
    <th>Payment Status</th>
    <th>Receipt</th>
    <th>Action</th>
  </tr>

  <?php
  $result = $conn->query("SELECT * FROM festival_bookings ORDER BY booked_at DESC");
  while ($row = $result->fetch_assoc()) {
    $statusClass = ($row['payment_status'] == 'Paid') ? 'paid' : 'pending';
    $statusLabel = ucfirst($row['payment_status']);
    $transactionId = $row['transaction_id'] ? $row['transaction_id'] : 'N/A';

    echo "<tr>
      <td>{$row['id']}</td>
      <td>{$row['user_name']}</td>
      <td>{$row['phone_number']}</td>
      <td>{$row['festival_name']}</td>
      <td>{$row['festival_date']}</td>
      <td>{$row['temple']}</td>
      <td>₹{$row['amount']}</td>
      <td>$transactionId</td>
      <td>{$row['booked_at']}</td>
      <td><span class='$statusClass'>$statusLabel</span></td>";

    // Receipt Download
    if ($row['payment_status'] === 'Paid') {
      echo "<td><a href='generate_pdf.php?id={$row['id']}' target='_blank'><button class='receipt-button'><i class='fa fa-download'></i> Download</button></a></td>";
    } else {
      echo "<td style='color: gray;'>-</td>";
    }

    // Admin Action
    if ($row['payment_status'] === 'Pending') {
      echo "<td><a href='?mark_paid={$row['id']}'><button class='mark-button'>Mark as Paid</button></a></td>";
    } else {
      echo "<td><a href='?mark_pending={$row['id']}'><button class='mark-button'>Mark as Pending</button></a></td>";
    }

    echo "</tr>";
  }
  ?>
</table>

</body>
</html>

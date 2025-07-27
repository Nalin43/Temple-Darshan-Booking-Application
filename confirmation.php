<?php
$connection = new mysqli("localhost", "root", "", "temple");

$id = $_GET['id'];
$result = $connection->query("SELECT * FROM festival_bookings WHERE id = $id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Festival Booking Confirmation</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #fddde6, #fff0f5);
      padding: 30px;
      text-align: center;
    }
    .container {
      background: #ffffff;
      border-radius: 20px;
      padding: 35px;
      max-width: 650px;
      margin: auto;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    h2 {
      color: #c2185b;
      font-size: 28px;
    }
    .info {
      margin: 15px 0;
      font-size: 20px;
      color: #444;
    }
    .amount {
      font-size: 24px;
      color: #2e7d32;
      font-weight: bold;
      margin: 20px 0;
    }
    .qr {
      margin: 25px 0;
    }
    .qr img {
      border: 4px solid #d81b60;
      border-radius: 15px;
      padding: 5px;
    }
    .pay-btn {
      background: linear-gradient(to right, #ff4081, #ec407a);
      color: white;
      border: none;
      padding: 14px 28px;
      font-size: 18px;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 20px;
      transition: background 0.3s ease;
    }
    .pay-btn:hover {
      background: linear-gradient(to right, #f50057, #c51162);
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🎉 For Booking Confirmation!</h2>
  <div class="info">Name: <strong><?php echo $row['user_name']; ?></strong></div>
  <div class="info">Festival: <strong><?php echo $row['festival_name']; ?></strong></div>
  <div class="info">Date: <strong><?php echo date('F d, Y', strtotime($row['festival_date'])); ?></strong></div>
  <div class="amount">Total Amount: ₹<?php echo $row['amount']; ?></div>

  <div class="qr">
    <img src="nalin_qr.png" width="220" alt="Scan to Pay">
    <p style="font-size: 16px; color: #555;">Scan the QR to complete the payment</p>
  </div>

  <form action="festival_payment_done.php" method="post">
    <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
    <button type="submit" class="pay-btn">✅ Payment Done</button>
  </form>
</div>

</body>
</html>

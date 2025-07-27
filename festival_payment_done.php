<?php
$connection = new mysqli("localhost", "root", "", "temple");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['booking_id']);
    
    // Generate a fake transaction ID (you can replace with actual payment gateway logic)
    $transaction_id = 'TXN' . strtoupper(uniqid());

    // Update the payment status and save transaction ID
    $connection->query("UPDATE festival_bookings SET payment_status='Paid', transaction_id='$transaction_id' WHERE id=$id");
    
    // Fetch updated data
    $result = $connection->query("SELECT * FROM festival_bookings WHERE id = $id");
    $row = $result->fetch_assoc();
} else {
    echo "Invalid access.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Successful</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e1f5fe, #fff3e0);
      padding: 40px;
      text-align: center;
    }
    .container {
      background: #ffffff;
      border-radius: 18px;
      padding: 40px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }
    h2 {
      color: #2e7d32;
      font-size: 30px;
      margin-bottom: 20px;
    }
    .info {
      font-size: 20px;
      margin: 12px 0;
      color: #444;
    }
    .highlight {
      color: #d84315;
      font-weight: bold;
    }
    .buttons {
      margin-top: 30px;
    }
    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 17px;
      cursor: pointer;
      margin: 0 10px;
      transition: background 0.3s;
    }
    .download {
      background-color: #8e24aa;
      color: white;
    }
    .download:hover {
      background-color: #6a1b9a;
    }
    .dashboard {
      background-color: #009688;
      color: white;
    }
    .dashboard:hover {
      background-color: #00796b;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>✅ Payment Successful!</h2>
  <div class="info">Name: <strong><?php echo $row['user_name']; ?></strong></div>
  <div class="info">Festival: <strong><?php echo $row['festival_name']; ?></strong></div>
  <div class="info">Date: <strong><?php echo date('F d, Y', strtotime($row['festival_date'])); ?></strong></div>
  <div class="info">Temple: <strong><?php echo $row['temple']; ?></strong></div>
  <div class="info">Amount Paid: <span class="highlight">₹<?php echo $row['amount']; ?></span></div>
  <div class="info">📄 Transaction ID: <span class="highlight"><?php echo $row['transaction_id']; ?></span></div>

  <div class="buttons">
    <form action="generate_pdf.php" method="post" target="_blank" style="display: inline;">
      <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
      <button type="submit" class="btn download">📥 Download Receipt</button>
    </form>

    <a href="dashboard.php">
      <button class="btn dashboard">🏠 Back to Dashboard</button>
    </a>
  </div>
</div>

</body>
</html>

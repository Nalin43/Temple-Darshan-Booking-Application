<?php
session_start();
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Devotee';
$festival = $_GET['festival_name'] ?? 'Unknown Festival';
$date = $_GET['festival_date'] ?? 'Unknown Date';
$amount = 200;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Festival Payment</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ffe0e0, #e1bee7);
      padding: 50px 20px;
      text-align: center;
    }

    .payment-box {
      background: white;
      max-width: 500px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .payment-box h2 {
      color: #6a1b9a;
      margin-bottom: 15px;
    }

    .payment-box p {
      margin: 10px 0;
      font-size: 16px;
    }

    .payment-box input {
      padding: 10px;
      width: 90%;
      margin: 10px 0 20px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .payment-box button {
      background: #8e24aa;
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
    }

    .payment-box button:hover {
      background: #6a1b9a;
    }
  </style>
</head>
<body>

<div class="payment-box">
  <h2>🎉 Festival Booking</h2>
  <p><strong>Festival:</strong> <?php echo htmlspecialchars($festival); ?></p>
  <p><strong>Date:</strong> <?php echo htmlspecialchars($date); ?></p>
  <p><strong>Amount to Pay:</strong> ₹<?php echo $amount; ?></p>

  <form action="festival_confirm.php" method="POST">
    <input type="hidden" name="festival_name" value="<?php echo htmlspecialchars($festival); ?>">
    <input type="hidden" name="festival_date" value="<?php echo htmlspecialchars($date); ?>">
    <input type="hidden" name="amount" value="<?php echo $amount; ?>">

    <input type="text" name="user_name" placeholder="Enter Your Name" required>
    <button type="submit">Proceed to Confirm</button>
  </form>
</div>

</body>
</html>

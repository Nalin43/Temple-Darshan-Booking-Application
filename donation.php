<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Temple Donation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            background: linear-gradient(to right, #ece9e6, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .donation-form {
            background: #fff;
            padding: 30px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        .donation-form h2 {
            text-align: center;
            color: #3c3b6e;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 500;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .qr-img {
            display: block;
            margin: 25px auto;
            width: 200px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .qr-img:hover {
            transform: scale(1.05);
        }

        button {
            margin-top: 20px;
            background: #3c3b6e;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: #2a295a;
        }

        .hidden {
            display: none;
        }

        .success-msg {
            text-align: center;
            background: #e6ffe6;
            border: 1px solid #88cc88;
            color: #3c763d;
            padding: 10px;
            margin-top: 20px;
            border-radius: 8px;
        }
    </style>
    <script>
        function toggleAdoptDateField(value) {
            const dateField = document.getElementById("adopt-date");
            value === "Adopt a Day" ? dateField.classList.remove("hidden") : dateField.classList.add("hidden");
        }
    </script>
</head>
<body>

<div class="container">
    <div class="donation-form">
        <h2>Temple Donation</h2>
        <form method="POST" action="">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="amount">Donation Amount (₹):</label>
            <input type="number" name="amount" id="amount" required min="1">

            <label for="donation_type">Donation Type:</label>
            <select name="donation_type" id="donation_type" onchange="toggleAdoptDateField(this.value)" required>
                <option value="" disabled selected>-- Select Donation Type --</option>
                <option value="Regular">Regular Donation</option>
                <option value="Adopt a Day">Adopt a Day</option>
            </select>

            <div id="adopt-date" class="hidden">
                <label for="adopt_date">Select Date for Adoption:</label>
                <input type="date" name="adopt_date" id="adopt_date">
            </div>

            <label>Scan this QR Code to Pay:</label>
            <img src="nalin_qr.png" class="qr-img" alt="Scan to Pay via UPI">

            <button type="submit" name="donate">🙏 Confirm Donation</button>
        </form>

        <?php
        if (isset($_POST['donate'])) {
            $name = $_POST['name'];
            $amount = $_POST['amount'];
            $type = $_POST['donation_type'];
            $adopt_date = isset($_POST['adopt_date']) ? $_POST['adopt_date'] : null;

            $insert = mysqli_query($conn, "INSERT INTO donations (name, amount, type, adopt_date, donated_at) 
                VALUES ('$name', '$amount', '$type', '$adopt_date', NOW())");

            if ($insert) {
                echo "<div class='success-msg'>🎉 Thank you, <strong>$name</strong>! Your ₹$amount donation has been received.</div>";
            } else {
                echo "<div class='success-msg' style='background:#ffe6e6; color:#a94442; border-color:#e6a1a1;'>❌ Error submitting your donation. Please try again.</div>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>

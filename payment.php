<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $temple = $_POST["temple"];
    $time = $_POST["time"];
    $type = $_POST["darshan_type"];
    $persons = $_POST["persons"];
    $date = $_POST["date"];
    $total = $_POST["total"];
} else {
    header("Location: booking_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:rgb(127, 128, 129);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .payment-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            width: 500px;
        }
        .amount {
            font-size: 20px;
            font-weight: bold;
            color: green;
            margin-top: 10px;
        }
        .confirmation {
            display: block;
            margin: 20px 0 10px 0;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            user-select: none;
        }
        .confirmation input {
            margin-right: 10px;
            cursor: pointer;
        }
        button {
            margin-top: 10px;
            padding: 12px 30px;
            font-size: 16px;
            background:rgb(46, 107, 204);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:disabled {
            background:rgb(165, 171, 169);
            cursor: not-allowed;
        }
    </style>
</head>
<body>
<div class="payment-box">
    <h2>Confirm and Pay</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
    <p><strong>Temple:</strong> <?= htmlspecialchars($temple) ?></p>
    <p><strong>Time:</strong> <?= htmlspecialchars($time) ?></p>
    <p><strong>Darshan Type:</strong> <?= htmlspecialchars($type) ?></p>
    <p><strong>Persons:</strong> <?= htmlspecialchars($persons) ?></p>
    <p><strong>Date:</strong> <?= htmlspecialchars($date) ?></p>
    <p class="amount">Total: ₹<?= htmlspecialchars($total) ?></p>

    <form action="process_payment.php" method="POST" id="paymentForm">
        <?php foreach ($_POST as $key => $value): ?>
            <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
        <?php endforeach; ?>

        <label class="confirmation" for="confirmDetails">
            <input type="checkbox" id="confirmDetails" name="confirmDetails" />
            I have verified all the above details are correct
        </label>

        <button type="submit" id="submitBtn" disabled> Proceed to payment</button>
    </form>
</div>

<script>
    const checkbox = document.getElementById('confirmDetails');
    const submitBtn = document.getElementById('submitBtn');

    checkbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });
</script>
</body>
</html>

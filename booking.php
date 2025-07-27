<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temple_id = $_POST['temple'];
    $darshan_date = $_POST['darshan_date'];
    $time_slot = $_POST['time_slot'];

    $sql = "SELECT darshan_fee FROM temples WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $temple_id);
    $stmt->execute();
    $stmt->bind_result($darshan_fee);
    $stmt->fetch();
    $stmt->close();

    $sql = "INSERT INTO bookings (user_id, temple_id, darshan_date, time_slot, total_amount, payment_status) 
            VALUES (?, ?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissd", $user_id, $temple_id, $darshan_date, $time_slot, $darshan_fee);

    if ($stmt->execute()) {
        $_SESSION['booking_id'] = $conn->insert_id;
        header("Location: payment.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

$result = $conn->query("SELECT id, name FROM temples");
?>

<form method="POST">
    <label>Select Temple:</label>
    <select name="temple" required>
        <?php while ($row = $result->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
        <?php endwhile; ?>
    </select>
    
    <label>Select Date:</label>
    <input type="date" name="darshan_date" required>

    <label>Select Time Slot:</label>
    <select name="time_slot">
        <option value="6 AM - 8 AM">6 AM - 8 AM</option>
        <option value="8 AM - 10 AM">8 AM - 10 AM</option>
        <option value="10 AM - 12 PM">10 AM - 12 PM</option>
        <option value="4 PM - 6 PM">4 PM - 6 PM</option>
        <option value="6 PM - 8 PM">6 PM - 8 PM</option>
    </select>
    
    <button type="submit">Proceed to Payment</button>
</form>

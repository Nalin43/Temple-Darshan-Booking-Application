<?php
session_start();
include("connection.php"); // Make sure this contains your $conn = new mysqli(...) connection

// Check if user clicked "I Have Paid"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirmed"])) {

    // Get logged-in user's email
    if (!isset($_SESSION["email"])) {
        die("User not logged in.");
    }

    $email    = $_SESSION["email"];
    $name     = $_POST["name"];
    $temple   = $_POST["temple"];
    $type     = $_POST["darshan_type"];
    $time     = $_POST["time"];
    $date     = $_POST["date"];
    $persons  = $_POST["persons"];
    $total    = $_POST["total"];
    $payment_id = uniqid("TXN");

    // Insert payment record into the payment_slips table
    $stmt = $conn->prepare("INSERT INTO payment_slips 
        (email, name, temple, darshan_type, time_slot, date_of_darshan, persons, total_amount, payment_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssiis", 
        $email, $name, $temple, $type, $time, $date, $persons, $total, $payment_id);

    if ($stmt->execute()) {
        // Store slip ID in session
        $_SESSION["last_slip_id"] = $conn->insert_id;

        // Redirect to payment slip
        header("Location: payment_slip.php");
        exit();
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
else {
    // If someone accesses the file directly, redirect them
    header("Location: payment.php");
    exit();
}
?>

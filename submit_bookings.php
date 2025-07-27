<?php
$conn = new mysqli("localhost", "root", "", "temple");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$temple_id = $_POST['temple_id'] ?? '';
$name = $_POST['name'] ?? '';
$temple_time = $_POST['temple_time'] ?? '';
$vehicle_parking = $_POST['vehicle_parking'] ?? '';
$archanai_token = $_POST['archanai_token'] ?? '';
$darshan_date = $_POST['darshan_date'] ?? '';

$sql = "INSERT INTO bookings (temple_id, name, temple_time, vehicle_parking, archanai_token, darshan_date)
        VALUES ('$temple_id', '$name', '$temple_time', '$vehicle_parking', '$archanai_token', '$darshan_date')";

if ($conn->query($sql) === TRUE) {
    echo "✅ Booking requested successfully! <a href='index.php'>Go Back</a>";
} else {
    echo "❌ Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

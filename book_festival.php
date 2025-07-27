<?php
$connection = new mysqli("localhost", "root", "", "temple");

$festivalName = $_POST['festival_name'];
$festivalDate = date('Y-m-d', strtotime($_POST['festival_date']));
$userName = $_POST['user_name'];
$phone = $_POST['phone_number'];
$temple = $_POST['temple'];

// Check booking limit
$stmt = $connection->prepare("SELECT COUNT(*) FROM festival_bookings WHERE festival_name = ? AND festival_date = ?");
$stmt->bind_param("ss", $festivalName, $festivalDate);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count >= 10) {
  echo "<script>alert('Sorry, booking limit reached for this festival.'); window.location.href='festivals.php';</script>";
  exit();
}

// Save booking
$stmt = $connection->prepare("INSERT INTO festival_bookings (festival_name, festival_date, user_name, phone_number, temple) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $festivalName, $festivalDate, $userName, $phone, $temple);
$stmt->execute();
$booking_id = $stmt->insert_id;
$stmt->close();

// Redirect to confirmation
header("Location: confirmation.php?id=" . $booking_id);
exit();
?>

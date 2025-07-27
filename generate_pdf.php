<?php
// Get data from query parameters
$name = $_GET["name"] ?? 'Devotee';
$temple = $_GET["temple"] ?? 'Temple';
$type = $_GET["type"] ?? 'General';
$time = $_GET["time"] ?? 'Morning';
$date = $_GET["date"] ?? date("Y-m-d");
$persons = $_GET["persons"] ?? '1';
$total = $_GET["total"] ?? '0';

// Set filename
$filename = "Darshan_Receipt_" . date("Ymd_His") . ".txt";

// Create content
$content = "
🛕 Temple Darshan Booking Receipt

Devotee Name : $name
Temple       : $temple
Darshan Type : $type
Time Slot    : $time
Date         : $date
No. of Persons: $persons
Total Paid   : ₹$total

🙏 Thank you for booking. Have a blessed darshan! 🙏
";

// Send headers to download
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
echo $content;
exit;

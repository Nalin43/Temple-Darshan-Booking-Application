<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['booking_id'];
    $action = $_POST['action'];
    if (in_array($action, ['Accepted', 'Rejected'])) {
        $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE booking_id = ?");
        $stmt->bind_param("si", $action, $id);
        $stmt->execute();
    }
}

$result = $conn->query("SELECT b.*, u.name AS user_name, t.name AS temple_name FROM bookings b
                        JOIN user u ON b.user_id = u.user_id
                        JOIN temple t ON b.temple_id = t.temple_id
                        ORDER BY b.requested_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h3 class="text-center">All Darshan Booking Requests</h3>
    <table class="table table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>User</th>
                <th>Temple</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['user_name']; ?></td>
                    <td><?= $row['temple_name']; ?></td>
                    <td><?= $row['darshan_date']; ?></td>
                    <td><?= $row['temple_time']; ?></td>
                    <td><strong><?= $row['status']; ?></strong></td>
                    <td>
                        <?php if ($row['status'] == 'Pending') { ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="booking_id" value="<?= $row['booking_id']; ?>">
                            <button name="action" value="Accepted" class="btn btn-sm btn-success">Accept</button>
                            <button name="action" value="Rejected" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                        <?php } else {
                            echo "No action needed";
                        } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

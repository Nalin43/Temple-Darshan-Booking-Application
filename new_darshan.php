<?php
// Database connection info
$servername = "localhost";  // update if needed
$username = "root";         // update if needed
$password = "";             // update if needed
$dbname = "temple";         // your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all bookings
$sql = "SELECT id, name, temple, time, darshan_type, persons, date, total FROM bookings ORDER BY date DESC, time ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>New Darshan Bookings</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #2c3e50;
            margin: 0;
            padding: 40px 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #0ba29d;
            font-weight: 700;
            font-size: 2.8rem;
            letter-spacing: 1.2px;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgb(11 162 157 / 0.2);
        }
        table.dataTable thead th {
            background-color: #0ba29d !important;
            color: white !important;
            font-weight: 700;
        }
        table.dataTable tbody tr:hover {
            background-color: #d1f0eb !important;
            cursor: pointer;
        }
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }
            .container {
                padding: 20px 15px;
            }
            h1 {
                font-size: 2rem;
                margin-bottom: 30px;
            }
        }
    </style>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>

    <div class="container" role="main">
        <h1>All Darshan Bookings</h1>

        <?php if ($result && $result->num_rows > 0): ?>
            <table id="bookingsTable" class="display" style="width:100%" aria-label="List of all darshan bookings">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Temple</th>
                        <th>Time</th>
                        <th>Darshan Type</th>
                        <th>Persons</th>
                        <th>Date</th>
                        <th>Total Paid (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['temple']) ?></td>
                            <td><?= htmlspecialchars($row['time']) ?></td>
                            <td><?= htmlspecialchars($row['darshan_type']) ?></td>
                            <td><?= htmlspecialchars($row['persons']) ?></td>
                            <td><?= htmlspecialchars($row['date']) ?></td>
                            <td><?= htmlspecialchars($row['total']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align:center; font-size:1.1rem; color:#555;">No darshan bookings found.</p>
        <?php endif; ?>

    </div>

    <script>
        $(document).ready(function() {
            $('#bookingsTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50],
                "order": [[ 6, "desc" ]], // default sort by date descending
                "language": {
                    "search": "Filter records:",
                    "lengthMenu": "Show _MENU_ bookings per page",
                    "zeroRecords": "No matching records found",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No bookings available",
                    "infoFiltered": "(filtered from _MAX_ total bookings)"
                },
                "columnDefs": [
                    { "orderable": false, "targets": [] } // all columns sortable
                ]
            });
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>

<?php
include("connection.php");
session_start();
date_default_timezone_set("Asia/Kolkata");
$current_month = date('Y-m');
$previous_month = date('Y-m', strtotime('-1 month'));

// Fetch total donations for current and previous months
$total_query = mysqli_query($conn, "SELECT SUM(amount) AS total FROM donations WHERE DATE_FORMAT(donated_at, '%Y-%m') = '$current_month'");
$total_data = mysqli_fetch_assoc($total_query);
$total_amount = $total_data['total'] ?? 0;

$prev_total_query = mysqli_query($conn, "SELECT SUM(amount) AS total FROM donations WHERE DATE_FORMAT(donated_at, '%Y-%m') = '$previous_month'");
$prev_total_data = mysqli_fetch_assoc($prev_total_query);
$prev_total_amount = $prev_total_data['total'] ?? 0;

// Fetch top 3 donors for the current month
$top_donors_query = mysqli_query($conn, "SELECT name, SUM(amount) as total FROM donations WHERE DATE_FORMAT(donated_at, '%Y-%m') = '$current_month' GROUP BY name ORDER BY total DESC LIMIT 3");
$top_donors = mysqli_fetch_all($top_donors_query, MYSQLI_ASSOC);

// Fetch total donors
$total_donors_query = mysqli_query($conn, "SELECT COUNT(DISTINCT name) AS donors FROM donations");
$total_donors_data = mysqli_fetch_assoc($total_donors_query);
$total_donors = $total_donors_data['donors'] ?? 0;

// Fetch Adopt-a-Day donations
$adopt_day_query = mysqli_query($conn, "SELECT SUM(amount) AS total FROM donations WHERE type = 'Adopt a Day'");
$adopt_day_data = mysqli_fetch_assoc($adopt_day_query);
$adopt_day_total = $adopt_day_data['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Temple Donations Report</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #4a148c;
        }
        .filters {
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .summary-box {
            background: #ede7f6;
            padding: 10px;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .top-donors {
            margin-bottom: 20px;
            text-align: center;
        }
        .top-donors ul {
            list-style: none;
            padding: 0;
            margin: 0 auto;
            max-width: 300px;
        }
        .top-donors li {
            margin: 5px 0;
            font-weight: 600;
            font-size: 1.1em;
        }
        .back-btn {
            margin-top: 20px;
            background: #6a1b9a;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
            max-width: 150px;
            text-align: center;
        }
        .back-btn:hover {
            background: #4a148c;
        }
    </style>
</head>
<body>

<h2>Temple Donations Report</h2>

<div class="summary-box">
    <p>Total Donations in <?= date('F Y'); ?>: ₹<?= number_format($total_amount, 2); ?></p>
    <p>Total Donors: <?= $total_donors; ?></p>
    <p>Adopt-a-Day Donations: ₹<?= number_format($adopt_day_total, 2); ?></p>
</div>

<div class="top-donors">
    <h3>Top 3 Donors of <?= date('F Y'); ?></h3>
    <ul>
        <?php foreach ($top_donors as $donor): ?>
            <li>👑 <?= htmlspecialchars($donor['name']); ?> (₹<?= number_format($donor['total'], 2); ?>)</li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="filters">
    <label>Filter by Type:
        <select id="typeFilter">
            <option value="">All</option>
            <option value="Regular">Regular</option>
            <option value="Adopt a Day">Adopt a Day</option>
        </select>
    </label>

    <label>From: <input type="date" id="minDate"></label>
    <label>To: <input type="date" id="maxDate"></label>

    <label>Search by Name: <input type="text" id="nameSearch" placeholder="Enter donor name"></label>

    <label>Compare Month:
        <select id="monthCompare">
            <option value="<?= $current_month; ?>"><?= date('F Y'); ?></option>
            <option value="<?= $previous_month; ?>"><?= date('F Y', strtotime('-1 month')); ?></option>
        </select>
    </label>
</div>

<table id="donations" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Amount (₹)</th>
            <th>Type</th>
            <th>Occasion</th>
            <th>Adopt Date</th>
            <th>Donated At</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM donations ORDER BY donated_at DESC");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>{$row['amount']}</td>
                <td>{$row['type']}</td>
                <td>" . htmlspecialchars($row['occasion']) . "</td>";

            if ($row['type'] === 'Adopt a Day' && $row['adopt_date'] != '0000-00-00') {
                echo "<td>{$row['adopt_date']}</td>";
            } else {
                echo "<td>-</td>";
            }

            echo "<td>{$row['donated_at']}</td>";

            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<button class="back-btn" onclick="window.location.href='admin_dashboard.php'">← Back to Dashboard</button>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<script>
$(document).ready(function () {
    var table = $('#donations').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    rows: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    rows: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    rows: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    rows: ':visible'
                }
            }
        ],
        scrollX: true
    });

    // Type filter
    $('#typeFilter').on('change', function () {
        table.column(3).search(this.value).draw();
    });

    // Name search
    $('#nameSearch').on('keyup', function () {
        table.column(1).search(this.value).draw();
    });

    // Date range filter
    $.fn.dataTable.ext.search.push(function (settings, data) {
        let min = $('#minDate').val();
        let max = $('#maxDate').val();
        let donatedAt = data[6] || "";

        if (
            (!min || donatedAt >= min) &&
            (!max || donatedAt <= max)
        ) {
            return true;
        }
        return false;
    });

    $('#minDate, #maxDate').on('change', function () {
        table.draw();
    });

    // Month Compare filter
    $('#monthCompare').on('change', function () {
        let selectedMonth = this.value;
        table.column(6).search('^' + selectedMonth, true, false).draw();
    });

    // Initialize with current month filter by default
    table.column(6).search('^<?= $current_month; ?>', true, false).draw();
});
</script>

</body>
</html>

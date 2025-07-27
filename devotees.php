<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM users"); // or your devotee table
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registered Devotees</title>
  <style>
    table {
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
    }
    th {
      background-color: #1a237e;
      color: white;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;">List of Registered Devotees</h2>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['phone']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>

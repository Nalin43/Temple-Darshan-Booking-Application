<?php
date_default_timezone_set("Asia/Kolkata");
$current_time = date("h:i:s A");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard – Darshan360</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('temple2.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    body.dark-mode {
      background-color: #121212;
      color: #f1f1f1;
    }

    /* Sidebar styles */
    .sidebar {
      position: fixed;
      width: 240px;
      height: 100vh;
      background: rgba(0,0,0,0.8);
      color: #fff;
      padding-top: 25px;
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 25px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 15px 30px;
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      transition: background 0.2s;
      flex: 1;
    }

    .sidebar a:hover {
      background: rgba(255,255,255,0.1);
    }

    /* Main content styles */
    .main {
      margin-left: 240px;
      padding: 30px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(255,255,255,0.9);
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .header.dark-mode {
      background: rgba(30,30,30,0.9);
    }

    .welcome {
      font-size: 22px;
      font-weight: 600;
    }

    .time {
      font-size: 16px;
      color: #d6336c;
    }

    .toggle-mode {
      cursor: pointer;
      padding: 6px 14px;
      border-radius: 20px;
      background: #4e54c8;
      color: #fff;
      font-size: 14px;
      border: none;
      margin-left: 10px;
    }

    /* Cards container */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
      grid-auto-rows: 1fr;
      gap: 20px;
    }

    /* Individual card styles */
    .card {
      background: rgba(255,255,255,0.95);
      padding: 25px;
      border-radius: 15px;
      text-decoration: none;
      color: #333;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: transform 0.2s ease;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card.dark-mode {
      background: rgba(40,40,40,0.9);
      color: #f1f1f1;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card h3 {
      font-size: 20px;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 14px;
    }

    .card i {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 24px;
      color: #4e54c8;
    }

    /* Responsive adjustments */
    @media screen and (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        flex-direction: row;
        flex-wrap: wrap;
      }

      .sidebar a {
        flex: 1 1 50%;
        text-align: center;
      }

      .main {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h2><i class="fa-solid fa-user-shield"></i> Admin</h2>
  <a href="admin_dashboard.php"><i class="fa fa-chart-line"></i> Dashboard</a>
  <a href="festival.php"><i class="fa fa-fire"></i> Festivals</a>
  <a href="new_darshan.php"><i class="fa fa-calendar-check"></i> Darshan Bookings</a>
  <a href="special_darshan.php"><i class="fa fa-star"></i> Special Darshan</a>
  <a href="general_darshan.php"><i class="fa fa-users"></i> General Darshan</a>
  <a href="donations.php"><i class="fa fa-hand-holding-heart"></i> Donations</a>
  <a href="devotees.php"><i class="fa fa-users"></i> Devotees</a>
  <a href="reports.php"><i class="fa fa-chart-pie"></i> Reports</a>
  <a href="login_choice.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main">
  <div class="header" id="header">
    <div class="welcome">🛕 Welcome, Admin</div>
    <div>
      <span class="time">⏰ <?= $current_time ?></span>
      <button class="toggle-mode" onclick="toggleMode()">🌗 Toggle Mode</button>
    </div>
  </div>

  <div class="cards">
    <a href="new_darshan.php" class="card" id="card1">
      <i class="fa fa-calendar-check"></i>
      <h3>New Darshan Bookings</h3>
      <p>Review user requests</p>
    </a>
    <a href="festival.php" class="card" id="card2">
      <i class="fa fa-fire"></i>
      <h3>Festival Bookings</h3>
      <p>Manage event entries</p>
    </a>
    <a href="special_darshan.php" class="card" id="card3">
      <i class="fa fa-star"></i>
      <h3>Special Darshan</h3>
      <p>Manage special bookings</p>
    </a>
    <a href="general_darshan.php" class="card" id="card4">
      <i class="fa fa-users"></i>
      <h3>General Darshan</h3>
      <p>Manage general bookings</p>
    </a>
    <a href="donations.php" class="card" id="card5">
      <i class="fa fa-donate"></i>
      <h3>Total Donations</h3>
      <p>Monitor offerings</p>
    </a>
    <a href="devotees.php" class="card" id="card6">
      <i class="fa fa-users"></i>
      <h3>Registered Devotees</h3>
      <p>Devotee records</p>
    </a>
    <a href="reports.php" class="card" id="card7">
      <i class="fa fa-chart-pie"></i>
      <h3>Reports</h3>
      <p>Generate insights</p>
    </a>
  </div>
</div>

<script>
  function toggleMode() {
    document.body.classList.toggle("dark-mode");
    document.getElementById("header").classList.toggle("dark-mode");
    const cards = document.querySelectorAll(".card");
    cards.forEach(card => card.classList.toggle("dark-mode"));
  }
</script>

</body>
</html>

 <?php
session_start();
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Devotee';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Temple Festival Booking</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 20px;
      background: linear-gradient(to right, #ffecd2, #fcb69f);
    }

    h2 {
      text-align: center;
      color: #6a1b9a;
      margin-bottom: 40px;
    }

    .festival-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 10px;
    }

    .card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      padding: 20px;
      position: relative;
      transition: 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      color: #8e24aa;
      margin: 0 0 10px;
    }

    .card p {
      font-size: 14px;
      color: #444;
    }

    .card .date {
      font-weight: bold;
      margin-top: 10px;
      color: #d32f2f;
    }

    .card button {
      margin-top: 15px;
      background: #8e24aa;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.2s;
    }

    .card button:hover {
      background: #6a1b9a;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background: white;
      padding: 25px;
      border-radius: 10px;
      width: 90%;
      max-width: 400px;
    }

    .modal-content h4 {
      margin-top: 0;
      color: #6a1b9a;
    }

    .modal-content input, .modal-content select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .modal-content button {
      width: 100%;
      padding: 10px;
      background: #8e24aa;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .close-btn {
      float: right;
      font-size: 18px;
      cursor: pointer;
      color: #d32f2f;
    }
  </style>
</head>
<body>

<h2>🌺 Book Your Festival Participation 🌺</h2>

<div class="festival-grid">
  <?php
  $festivals = [
    ["Maha Shivaratri", "March 8, 2025", "Night-long worship & Shiva-Parvati union"],
    ["Pradosham", "May 20, 2025", "Seek Lord Shiva's forgiveness"],
    ["Ardra Darshan", "January 6, 2025", "Celebrate Nataraja's cosmic dance"],
    ["Karthigai Deepam", "December 4, 2025", "Lighting of sacred lamps"],
    ["Aani Thirumanjanam", "July 15, 2025", "Holy bath for Nataraja"],
    ["Panguni Uthiram", "April 6, 2025", "Divine wedding of Shiva-Parvati"]
  ];

  foreach ($festivals as $fest) {
    echo "
      <div class='card'>
        <h3>{$fest[0]}</h3>
        <p>{$fest[2]}</p>
        <div class='date'>📅 {$fest[1]}</div>
        <button onclick=\"openModal('{$fest[0]}', '{$fest[1]}')\">Book Now</button>
      </div>
    ";
  }
  ?>
</div>

<!-- Modal -->
<div class="modal" id="bookingModal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">×</span>
    <h4>📿 Book Festival Participation</h4>
    <form action="book_festival.php" method="POST">
      <input type="hidden" name="festival_name" id="festivalName">
      <input type="hidden" name="festival_date" id="festivalDate">
      <label>Your Name:</label>
      <input type="text" name="user_name" placeholder="Enter Your Name" required>
      <label>Phone Number:</label><br>
      <input type="text" name="phone_number" required><br>
      <label>Select Temple:</label>
      <select name="temple">
        <option value="Shivan Temple">Shivan Temple
      </select>
      <button type="submit">Confirm Booking</button>
    </form>
  </div>
</div>

<script>
  function openModal(festival, date) {
    document.getElementById("festivalName").value = festival;
    document.getElementById("festivalDate").value = date;
    document.getElementById("bookingModal").style.display = "flex";
  }

  function closeModal() {
    document.getElementById("bookingModal").style.display = "none";
  }

  // Optional: Close on outside click
  window.onclick = function(e) {
    if (e.target == document.getElementById("bookingModal")) {
      closeModal();
    }
  }
</script>

</body>
</html> 
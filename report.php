<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Temple360 – Shivan Temple Report</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Kalam&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #f3f4f6;
      color: #333;
      padding: 30px;
    }

    h1 {
      text-align: center;
      font-family: 'Kalam', cursive;
      color: #6a1b9a;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .card {
      background: white;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      transition: 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h3 {
      color: #512da8;
      font-size: 18px;
      margin-bottom: 5px;
    }

    .chart-section, .map-section, .quote-section {
      margin-top: 40px;
      background: white;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.07);
    }

    .chart-section canvas {
      max-width: 100%;
      height: 280px;
    }

    .map-section iframe {
      width: 100%;
      height: 300px;
      border: none;
      border-radius: 10px;
    }

    .gallery {
      display: flex;
      gap: 15px;
      margin-top: 25px;
      flex-wrap: wrap;
    }

    .gallery img {
      width: 180px;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .quote {
      font-style: italic;
      text-align: center;
      font-size: 18px;
      color: #7b1fa2;
      margin-top: 10px;
    }

    .print-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: #7e57c2;
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 50px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .print-btn:hover {
      background: #5e35b1;
    }

  </style>
</head>
<body>

<h1>🛕 Temple360 Report – Common Shivan Temple</h1>

<div class="cards">
  <div class="card">
    <h3>📍 Location</h3>
    <p>Tamil Nadu, India</p>
  </div>
  <div class="card">
    <h3>⏳ Age</h3>
    <p>500+ Years Old</p>
  </div>
  <div class="card">
    <h3>🧘‍♂️ Monthly Visitors</h3>
    <p>3,000+</p>
  </div>
  <div class="card">
    <h3>⭐ Devotee Rating</h3>
    <p>4.9 / 5</p>
  </div>
  <div class="card">
    <h3>💰 Monthly Donations</h3>
    <p>₹1,25,000</p>
  </div>
</div>

<div class="chart-section">
  <h2>📊 Darshan Bookings (Last 6 Months)</h2>
  <canvas id="darshanChart"></canvas>
</div>


<div class="chart-section">
  <h2>🪔 Upcoming Festivals</h2>
  <ul>
    <li>🕉 Mahashivaratri – March 8</li>
    <li>🔥 Pradosham – Every 15 Days</li>
    <li>🌕 Pournami Pooja – Monthly</li>
  </ul>
</div>

<div class="chart-section">
  <h2>📸 Temple Gallery</h2>
  <div class="gallery">
    <img src="temple1.jpg" alt="Gopuram" />
    <img src="temple2.jpg" alt="Lingam" />
    
  </div>
</div>

<div class="quote-section">
  <h2>🧘 Daily Wisdom</h2>
  <p class="quote">"Om Namah Shivaya – the chant of cosmic peace."</p>
</div>

<button class="print-btn" onclick="window.print()">🖨️ Download Report</button>

<script>
  const ctx = document.getElementById('darshanChart').getContext('2d');
  const darshanChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Darshan Bookings',
        data: [350, 420, 380, 500, 470, 520],
        backgroundColor: '#8e24aa'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script>

</body>
</html>

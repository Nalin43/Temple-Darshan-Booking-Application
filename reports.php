<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shivan Temple Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Kalam&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #f3e5f5, #ede7f6);
            padding: 50px 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            padding: 40px;
            animation: fadeIn 1s ease;
        }

        .card h4 {
            text-align: center;
            font-family: 'Kalam', cursive;
            color: #4a148c;
            margin-bottom: 30px;
            font-size: 26px;
        }

        h5.section-title {
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 10px;
            color: #512da8;
            font-size: 18px;
        }

        p, ul {
            font-size: 15px;
            color: #444;
            line-height: 1.6;
        }

        ul {
            padding-left: 20px;
        }

        ul li::marker {
            content: "🔸 ";
        }

        .highlight {
            color: #8e24aa;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #777;
            font-size: 13px;
        }

        .icon-header {
            font-size: 24px;
            color: #6a1b9a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #7e57c2;
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: 0.3s ease;
        }

        .print-btn:hover {
            background: #5e35b1;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h4><i class="fas fa-om"></i> Temple Report: Common Shivan Temple</h4>

        <h5 class="section-title"><i class="fas fa-map-marker-alt"></i> Location</h5>
        <p>This <span class="highlight">Shivan temple</span> is located in a spiritually significant area of Tamil Nadu. Many such temples are set near rivers, hills, or sacred groves, symbolizing natural harmony and divine energy.</p>

        <h5 class="section-title"><i class="fas fa-hands"></i> Temple Significance</h5>
        <p>Dedicated to <strong>Lord Shiva</strong>, the deity is worshipped in the form of a <strong>Lingam</strong>. Devotees seek blessings for <strong>health, peace, prosperity, and liberation (moksha)</strong>.</p>

        <h5 class="section-title"><i class="fas fa-archway"></i> Architecture</h5>
        <p>The temple follows traditional <strong>Dravidian architecture</strong>, featuring a <strong>Gopuram</strong>, <strong>Vimana</strong>, and <strong>Nandi mandapam</strong>. Rich stone carvings, inscriptions, and ancient shrines mark the space.</p>

        <h5 class="section-title"><i class="fas fa-calendar-alt"></i> Festivals Celebrated</h5>
        <ul>
            <li>🕉️ <strong>Mahashivaratri</strong> – Night-long prayers, fasting, and abhishekam</li>
            <li>🔥 <strong>Pradosham</strong> – Fortnightly ritual for spiritual cleansing</li>
            <li>🌕 <strong>Pournami & Amavasya Poojas</strong></li>
        </ul>

        <h5 class="section-title"><i class="fas fa-bus"></i> Accessibility</h5>
        <p>Easily reachable by public transport, including buses and autos. Pilgrims often combine these visits with spiritual tourism in Tamil Nadu.</p>

        <h5 class="section-title"><i class="fas fa-star"></i> Highlights</h5>
        <ul>
            <li>Shiva Lingam as the main deity</li>
            <li>Majestic Nandi statue facing the sanctum</li>
            <li>Peaceful surroundings for prayer and meditation</li>
            <li>Online booking and digital donation available</li>
        </ul>

        <div class="footer">
            © 2025 Online Temple Darshan Booking System – All rights reserved.
        </div>
    </div>
</div>

<button class="print-btn" onclick="window.print()">
    🖨️ Print / Download Report
</button>

</body>
</html>

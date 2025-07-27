<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Temple Darshan Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #fceabb,rgb(231, 184, 246));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #fff;
            padding: 40px 35px;
            width: 500px;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }
        h2, h3 {
            text-align: center;
            font-family: 'Kalam', cursive;
            color: #6b2f8c;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>🌼 Shivann Temple 🌼</h2>
        <h3>🛕 Darshan Booking Form</h3>

        <form id="darshanForm" method="POST">
            <div class="form-group"><input type="text" name="name" placeholder="Full Name" required></div>
            <div class="form-group">
                <select name="temple" required>
                    <option value="Shivan Temple" selected>Shivan Temple</option>
                </select>
            </div>
            <div class="form-group">
                <select name="time" required>
                    <option value="">-- Select Darshan Time --</option>
                    <option value="5:00-6:00 AM">5:00-6:00 AM</option>
                    <option value="9:00-10:00 AM">9:00-10:00 AM</option>
                    <option value="3:00-4:00 PM">3:00-4:00 PM</option>
                    <option value="5:00-7:00 PM">5:00-7:00 PM</option>
                </select>
            </div>
            <div class="form-group">
                <select name="darshan_type" required>
                    <option value="">-- Select Darshan Type --</option>
                    <option value="General">General Darshan – ₹50</option>
                    <option value="Special">Special Darshan – ₹150</option>
                </select>
            </div>
            <div class="form-group"><input type="number" name="persons" placeholder="Number of Persons" min="1" required></div>
            <div class="form-group"><input type="date" name="date" id="darshan_date" required>
            <script>
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('darshan_date').setAttribute('min', today);
</script>

        </div>
            <button type="submit">🚩Submit</button>
        </form>
    </div>

    <script>
        document.getElementById("darshanForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const form = e.target;
            const data = {
                name: form.name.value,
                temple: form.temple.value,
                time: form.time.value,
                darshan_type: form.darshan_type.value,
                persons: parseInt(form.persons.value),
                date: form.date.value
            };

            const rate = data.darshan_type === "Special" ? 150 : 50;
            data.total = rate * data.persons;

            const redirect = document.createElement("form");
            redirect.method = "POST";
            redirect.action = "payment.php";

            for (let key in data) {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = key;
                input.value = data[key];
                redirect.appendChild(input);
            }

            document.body.appendChild(redirect);
            redirect.submit();
        });
    </script>
</body>
</html>

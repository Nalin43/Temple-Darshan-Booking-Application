<!DOCTYPE html>
<html>
<head>
  <title>Temple Darshan | Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('temple_bg.png'); /* replace with your image path */
      background-size: cover;
      background-position: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .center-box {
      background: rgba(96, 151, 167, 0.85);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 15pxrgb(114, 255, 7);
      text-align: center;
    }
    .btn-lg {
      margin: 10px;
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

  <div class="center-box">
    <h1 class="mb-4 text-warning">Isha Temple Booking</h1>
    <button class="btn btn-success btn-lg" onclick="showUserOptions()">User Login</button>
    <a href="admin_login.php" class="btn btn-primary btn-lg">Admin Login</a>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-header bg-warning">
          <h5 class="modal-title w-100">Choose an Option</h5>
        </div>
        <div class="modal-body">
          <button onclick="location.href='register.php'" class="btn btn-outline-success mb-3 w-100">Register</button>
          <button onclick="showLoginForm()" class="btn btn-outline-primary w-100">Login</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" method="POST" action="login_process.php">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title w-100">User Login</h5>
        </div>
        <div class="modal-body">
          <input type="email" class="form-control mb-3" name="email" placeholder="Enter Email" required>
          <input type="password" class="form-control mb-3" name="password" placeholder="Enter Password" required>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showUserOptions() {
      var myModal = new bootstrap.Modal(document.getElementById('userModal'));
      myModal.show();
    }
    function showLoginForm() {
      bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
      var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show();
    }
  </script>
</body>
</html>

<?php
session_start();
include 'includes/config.php';  // Include your database connection file

// Initialize error message
$error = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input data from form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if fields are not empty
    if (!empty($username) && !empty($password)) {
        // Prepare SQL to fetch user data
        $sql = "SELECT * FROM admin_profile WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            
            // Since the password is stored as plain text, compare directly
            if ($password === $admin['password']) {
                // Set session variables for successful login
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_profile_image'] = $admin['profile_image'];  // Path to profile image


                // Redirect to dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                $error = 'Invalid password. Please try again.';
            }
        } else {
            $error = 'Invalid email. Please try again.';
        }
    } else {
        $error = 'All fields are required.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Oasis Travellers</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    .input-group .btn {
      cursor: pointer;
    }
    .text-danger {
      color: red;
    }
  </style>
</head>
<body>

  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-3">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="images/logo.png" alt="" style="height: 100%; width:220px;">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  </div>
                <form class="row g-3 needs-validation" novalidate method="POST" action="">
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                            <div class="invalid-feedback">Please enter your username.</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                            <button type="button" id="togglePassword" class="btn btn-outline-primary">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <!-- Error Message Display -->
                    <?php if ($error): ?>
                    <div class="col-12">
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Keep me logged in</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Sign in</button>
                    </div>
                    <div class="col-12">
                        <p class="small mb-0"><a href="forget_password.php">I forgot my Password?</a></p>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#yourPassword');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            eyeIcon.classList.toggle('bi-eye'); // For showing eye icon
            eyeIcon.classList.toggle('bi-eye-slash'); // For hiding eye icon
        });
    });
  </script>
</body>
</html>

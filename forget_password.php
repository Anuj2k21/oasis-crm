<?php
session_start();
require 'config.php'; // Include database configuration

// Include PHPMailer classes
require 'vendor/autoload.php'; // Adjust this path if necessary

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ['status' => '', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Check if email already exists in otp_requests table
        $stmt = $conn->prepare("SELECT id FROM otp_requests WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Email already exists
            $response['status'] = 'error';
            $response['message'] = 'OTP already sent to this email.';
        } else {
            // Generate OTP
            $otp = rand(100000, 999999);

            // Save OTP to database
            $stmt = $conn->prepare("INSERT INTO otp_requests (email, otp) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $otp);
            $stmt->execute();

            // Send OTP to email using PHPMailer
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth   = true;
                $mail->Username   = 'niteshvishwakarma099@gmail.com'; // SMTP username
                $mail->Password   = 'keidkvkqiqocgndi'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('niteshvishwakarma099@gmail.com', 'Nitesh Vishwakarma');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = "Your OTP code is <b>$otp</b>";

                $mail->send();
                $_SESSION['email'] = $email;
                $_SESSION['otp_sent'] = true; // Set session variable
                $response['status'] = 'success';
                $response['message'] = 'OTP sent successfully!';
            } catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = "Failed to send OTP. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        echo json_encode($response);
        exit();
    } elseif (isset($_POST['otp'])) {
        // Verify OTP
        $otp = $_POST['otp'];
        $email = $_SESSION['email'];

        // Check if OTP is correct and update its status to 'verified'
        $stmt = $conn->prepare("SELECT id FROM otp_requests WHERE email = ? AND otp = ? AND status = 'unverified'");
        $stmt->bind_param("ss", $email, $otp);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Update OTP status to 'verified'
            $stmt = $conn->prepare("UPDATE otp_requests SET status = 'verified' WHERE email = ? AND otp = ?");
            $stmt->bind_param("ss", $email, $otp);
            $stmt->execute();

            $response['status'] = 'success';
            $response['message'] = 'OTP verified successfully!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid OTP or OTP already verified. Please try again.';
        }

        echo json_encode($response);
        exit();
    } elseif (isset($_POST['password'])) {
        // Change password
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = $_SESSION['email'];

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $password, $email);
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Your password has been changed successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to change the password. Please try again.';
        }
        
        echo json_encode($response);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Forget Password</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
  <!-- Include SweetAlert CSS and JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
    .text-center {
    text-align: center;
}

.mt-2 {
    margin-top: 0.5rem; /* Adjust as needed for spacing */
}

img{
  display: block;
  margin-left: auto;
  margin-right: auto;
  height: 100%; 
  width:100px;
}
</style>

</head>

<body>
  <main>
    <div class="container">
      <section class="section register flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                   
                    <h5 class="card-title text-center pb-0 fs-4">Forget Password</h5>
                    <p class="text-center small">Enter your email and we'll send you a Otp to reset your password.</p>
                  </div>
                  <form id="otp-form" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="email" class="form-label">Enter your Email</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Please enter your email</div>
                      </div>
                    </div>
                    <div class="col-12">
                     <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                    <div class="col-12 text-center mt-2">
                        <p class="small mb-0">
                            <a href="index.php">
                              <span class="glyphicon"></span> Back to login
                            </a>
                        </p>
                    </div>
                  </form>
                </div>
              </div>
              <div class="credits"></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <script>
    $(document).ready(function() {
        $('#otp-form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '', // Your current PHP file URL to handle OTP request
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Check your email for OTP.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Show OTP verification popup
                                Swal.fire({
                                    title: 'Verify OTP',
                                    html: `
                                        <form id="otp-verification-form" class="otp-form">
                                            <label for="otp" style="color:green; font-weight:bold;">Check your email for OTP</label>
                                            <input type="text" id="otp" name="otp" class="swal2-input" placeholder="Enter OTP" required>
                                            <button type="submit" class="swal2-confirm swal2-styled">Verify</button>
                                        </form>
                                    `,
                                    showConfirmButton: false, // Disable the default confirm button
                                    allowOutsideClick: false // Prevent closing the popup by clicking outside
                                });

                                // Handle OTP verification form submission
                                $(document).on('submit', '#otp-verification-form', function(event) {
                                    event.preventDefault();
                                    const otp = $('#otp').val();

                                    $.ajax({
                                        url: '', // Your current PHP file URL to handle OTP verification
                                        type: 'POST',
                                        data: { otp: otp },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.status === 'success') {
                                                Swal.fire({
                                                    title: 'OTP Verified!',
                                                    text: 'Your OTP has been verified successfully.',
                                                    icon: 'success',
                                                    confirmButtonText: 'OK'
                                                }).then(() => {
                                                    // Show change password popup
                                                    Swal.fire({
                                                        title: 'Change Password',
                                                        html: `
                                                            <form id="change-password-form" class="change-password-form">
                                                                <input type="password" id="new-password" name="password" class="swal2-input" placeholder="New Password" required>
                                                                <input type="password" id="confirm-password" name="confirm-password" class="swal2-input" placeholder="Confirm Password" required>
                                                                <button type="submit" class="swal2-confirm swal2-styled">Change Password</button>
                                                            </form>
                                                        `,
                                                        showConfirmButton: false, // Disable the default confirm button
                                                        allowOutsideClick: false // Prevent closing the popup by clicking outside
                                                    });

                                                    // Handle change password form submission
                                                    $(document).on('submit', '#change-password-form', function(event) {
                                                        event.preventDefault();
                                                        const newPassword = $('#new-password').val();
                                                        const confirmPassword = $('#confirm-password').val();

                                                        if (newPassword === confirmPassword) {
                                                            $.ajax({
                                                                url: '', // Your current PHP file URL to handle password change
                                                                type: 'POST',
                                                                data: { password: newPassword },
                                                                dataType: 'json',
                                                                success: function(response) {
                                                                    if (response.status === 'success') {
                                                                        Swal.fire({
                                                                            title: 'Password Changed!',
                                                                            text: 'Your password has been changed successfully.',
                                                                            icon: 'success',
                                                                            confirmButtonText: 'OK'
                                                                        }).then(() => {
                                                                            // Redirect to login page or perform any further actions
                                                                            window.location.href = 'index.php';
                                                                        });
                                                                    } else {
                                                                        Swal.fire({
                                                                            title: 'Error!',
                                                                            text: response.message,
                                                                            icon: 'error',
                                                                            confirmButtonText: 'OK'
                                                                        });
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            Swal.fire({
                                                                title: 'Error!',
                                                                text: 'Passwords do not match. Please try again.',
                                                                icon: 'error',
                                                                confirmButtonText: 'OK'
                                                            });
                                                        }
                                                    });
                                                });
                                            } else {
                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: response.message,
                                                    icon: 'error',
                                                    confirmButtonText: 'OK'
                                                });
                                            }
                                        }
                                    });
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    });
</script>



</body>
</html>

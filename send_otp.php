<?php
session_start();
require 'config.php'; // Include database configuration

// Include PHPMailer classes
require 'vendor/autoload.php'; // Adjust this path if necessary

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$response = ['status' => '', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

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
        $response['status'] = 'success';
        $response['message'] = 'OTP sent successfully!';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = "Failed to send OTP. Mailer Error: {$mail->ErrorInfo}";
    }

    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send OTP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Forget Password</h2>
        <div id="alert-container"></div>
        <form id="otp-form">
            <div class="form-group">
                <label for="email">Enter your Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#otp-form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        let alertType = response.status === 'success' ? 'alert-success' : 'alert-danger';
                        let alertMessage = `
                            <div class="alert ${alertType} alert-dismissible fade show" role="alert">
                                ${response.message}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
                        $('#alert-container').html(alertMessage);
                        if (response.status === 'success') {
                            setTimeout(function() {
                                window.location.href = 'verify_otp.php';
                            }, 2000); // Redirect after 2 seconds
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>

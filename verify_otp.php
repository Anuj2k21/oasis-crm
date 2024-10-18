<?php
session_start();
require 'config.php'; // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $otp = $_POST['otp'];

    // Verify OTP
    $stmt = $conn->prepare("SELECT * FROM otp_requests WHERE email = ? AND otp = ? AND created_at >= NOW() - INTERVAL 10 MINUTE AND status = FALSE");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update status to true
        $update_stmt = $conn->prepare("UPDATE otp_requests SET status = TRUE WHERE email = ? AND otp = ?");
        $update_stmt->bind_param("ss", $email, $otp);
        $update_stmt->execute();

        echo "OTP verified";
        // Redirect to the change password page
        header("Location: change_password.php");
    } else {
        echo "Invalid OTP";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <form action="verify_otp.php" method="POST">
            <div class="form-group">
                <label for="otp">Enter OTP:</label>
                <input type="text" class="form-control" id="otp" name="otp" required>
            </div>
            <button type="submit" class="btn btn-primary">Verify</button>
        </form>
    </div>
</body>
</html>

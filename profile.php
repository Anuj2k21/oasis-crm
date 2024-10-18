<?php
session_start();
include('includes/config.php'); // Assuming you have a separate file for database connection
include('includes/header.php');
include('includes/sidebar.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch admin details from the database
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM admin_profile WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle profile update
    if (isset($_POST['update_profile'])) {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $company = $_POST['company'];
        $address = $_POST['address'];

        // Define image folder path
        $image_folder = "uploads/";
        
        // Check if folder exists, if not, create it
        if (!is_dir($image_folder)) {
            mkdir($image_folder, 0777, true); // Create folder with read/write permissions
        }

        // Check if a new image is uploaded
        if (!empty($_FILES['profile_image']['name'])) {
            $image_name = $_FILES['profile_image']['name'];
            $image_tmp = $_FILES['profile_image']['tmp_name'];

            // Ensure unique file names by appending a timestamp
            $unique_image_name = time() . '_' . $image_name;

            // Move the uploaded file to your folder
            move_uploaded_file($image_tmp, $image_folder . $unique_image_name);
            $profile_image = $image_folder . $unique_image_name;
        } else {
            $profile_image = $admin['profile_image']; // Use the existing image if no new upload
        }

        $query = "UPDATE admin_profile SET full_name = ?, email = ?, phone = ?, company = ?, address = ?, profile_image = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $full_name, $email, $phone, $company, $address, $profile_image, $admin_id);
        $stmt->execute();

        echo "<div class='alert alert-success'>Profile updated successfully!</div>";
    }

    // Handle password change
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Verify current password
        if (password_verify($current_password, $admin['password'])) {
            if ($new_password == $confirm_password) {
                // Hash the new password and update it in the database
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE admin_profile SET password = ?, updated_at = NOW() WHERE id = ?";
                $stmt->prepare($query);
                $stmt->bind_param("si", $hashed_password, $admin_id);
                $stmt->execute();

                echo "<div class='alert alert-success'>Password changed successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>New passwords do not match!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Current password is incorrect!</div>";
        }
    }
}
?>

<!-- Profile Update and Password Change Form -->
<div class="container mt-5 mr-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h1 class="mb-4 text-center">Admin Profile</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <!-- Profile Information -->
                        <div class="mb-3 text-center">
                            <label for="profile_image" class="form-label">Profile Image</label><br>
                            <?php if (!empty($admin['profile_image'])): ?>
                                <img src="<?php echo $admin['profile_image']; ?>" alt="Profile Image" width="100" height="100" class="rounded-circle"><br><br>
                            <?php else: ?>
                                <img src="/uploads/" alt="Profile Image" width="100" height="100" class="rounded-circle"><br><br>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $admin['full_name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $admin['phone']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="company" name="company" value="<?php echo $admin['company']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" required><?php echo $admin['address']; ?></textarea>
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Change Form -->
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Change Password</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" name="change_password" class="btn btn-danger w-100">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
// Include the database connection
include('includes/config.php'); // Make sure you have a config.php file with your connection logic

// Handle form submission
if (isset($_POST['submit'])) {
    $role = $_POST['role'];
    $full_name = $_POST['name'];
    $mobile_no = $_POST['mobile_no'];
    $user_id = $_POST['user_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password
    $status = $_POST['status']; // Get the status from form

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image); // Save the image in an 'uploads' folder
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Insert user data into the database
    $sql = "INSERT INTO users (role, image, full_name, contact, user_id, password, status) 
            VALUES ('$role', '$image', '$full_name', '$mobile_no', '$user_id', '$password', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User created successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap4.css" rel="stylesheet">
</head>
<body>
    <!--start header-->
    <?php include('includes/header.php');?>
    <!--end header-->
    <!--start sidebar-->
    <?php include('includes/sidebar.php');?>
    <!--end sidebar-->
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <h1 class="breadcrumb-item"><a href="#">User Management</a></h1>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New User</h5>
                            <!-- User Creation Form -->
                            <form id="myForm" method="POST" action="" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="selectRole" class="form-label">Select Role</label>
                                        <select class="form-select" id="selectRole" name="role">
                                            <option selected>Select Designation</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="image" class="form-label">Upload Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name">
                                    </div>
                                    <div class="col-md-4 pt-4">
                                        <label for="mobileNo" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" id="mobileNo" name="mobile_no" placeholder="Enter Mobile Number">
                                    </div>
                                    <div class="col-md-4 pt-4">
                                        <label for="userId" class="form-label">User Id/ email</label>
                                        <input type="text" class="form-control" id="userId" name="user_id" placeholder="Enter User Id">
                                    </div>
                                    <div class="col-md-4 pt-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                    </div>
                                    <div class="col-md-4 pt-4">
                                        <button type="submit" name="submit" class="btn btn-primary" style="font-weight: 500;">Create User</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table to display user data -->
                    <div class="row table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Full Name</th>
                                    <th class="text-center">Contact</th>
                                    <th class="text-center">User Id</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Status</th> <!-- Added Status Column -->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $index => $row): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $row['role']; ?></td>
                                    <td><img src="uploads/<?php echo $row['image']; ?>" alt="User Image" width="50"></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['status']; ?></td> <!-- Display Status -->
                                    <td>
                                    
                                        <!-- Action buttons (Edit, Delete) -->
                                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>
<?php include('includes/footer.php');?>
</html>

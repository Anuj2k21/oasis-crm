<?php
// Start session to handle messages
session_start();

// Include database connection
include 'includes/config.php';

// Create Country & City
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    $country = $_POST['country'];
    $city = $_POST['city'];
    $hotel_name = $_POST['hotel_name'];
    $category = $_POST['category'];
    $room_type = $_POST['room_type'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO hotels (country, city, hotel_name, category, room_type, address, phone) VALUES ('$country', '$city', '$hotel_name', '$category', '$room_type', '$address', '$phone')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Hotel created successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error creating hotel: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: hotel.php");
    exit();
}

// Edit Country & City
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $hotel_name = $_POST['hotel_name'];
    $category = $_POST['category'];
    $room_type = $_POST['room_type'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $sql = "UPDATE hotels SET country='$country', city='$city', hotel_name='$hotel_name', category='$category', address='$address', phone='$phone' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Hotel updated successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error updating hotel: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: hotel.php");
    exit();
}

// Delete Country & City
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM hotels WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Hotels deleted successfully!';
        $_SESSION['msg_type'] = 'danger';
    } else {
        $_SESSION['message'] = 'Error deleting hotel: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: hotel.php");
    exit();
}
// Fetch countries and cities from the locations table
$countries = [];
$sql = "SELECT DISTINCT country_name FROM locations";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $country[] = $row['country_name'];
    }
}

$cities = [];
$sql = "SELECT DISTINCT city_name FROM locations";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $city[] = $row['city_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Form</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <h1 class="breadcrumb-item"><a href="#">Hotel</a></h1>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Hotel</h5>
                            <?php if (isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
                                    <?php 
                                        echo $_SESSION['message'];
                                        unset($_SESSION['message']);
                                    ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- Country & City Form -->
                            <form id="myForm" action="hotel.php" method="POST">
                                <input type="hidden" name="action" value="create">
                                <div class="container mt-4">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="country_name" class="form-label">Country</label>
                                            <select class="form-select" id="country" name="country" required>
                                               <option selected>Select Country</option>
                                               <?php foreach ($country as $country): ?>
                                                    <option value="<?= htmlspecialchars($country) ?>"><?= htmlspecialchars($country) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_name" class="form-label">City</label>
                                            <select class="form-select" id="city" name="city" required>
                                               <option selected>Select City</option>
                                               <?php foreach ($city as $city): ?>
                                                    <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_name" class="form-label">Hotel Name</label>
                                            <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Enter Hotel Name" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_name" class="form-label">Category</label>
                                            <select class="form-select" id="category" name="category" required>
                                               <option selected>Select Category</option>
                                               <option value="7 Star">7 Star</option>
                                               <option value="5 Star">5 Star</option>
                                               <option value="3 Star">3 Star</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="room_type" class="form-label">Room Type</label>
                                            <input type="text" class="form-control" id="room_type" name="room_type" placeholder="Enter Room Type" required>
                                        </div>
                                        <div class="col-md-5">
                                          <label for="address" class="form-label">Address</label>
                                          <input type="text" class="form-control" id="address" name="address"  placeholder="Enter address here" required>
                                        </div>
                                        <div class="col-md-3">
                                          <label for="contact" class="form-label">Contact No.</label>
                                          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Contact Number" required>
                                        <div id="phone-error" style="color: red; display: none;">Please enter a valid 10-digit phone number.</div>
                                    </div>
                                    </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary" style="font-weight: 500;">Create</button>
                                        </div>
                        
                                        
                                        <!-- Hotel Data Table -->
        <section class="container pt-5">
            <div class="row table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Hotel Name</th>
                            <th>Category</th>
                            <th>Room Type</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch data for DataTable
                        $result = mysqli_query($conn, "SELECT * FROM hotels");
                        $sr = 1;
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $sr++; ?></td>
                                <td><?php echo htmlspecialchars($row['country']); ?></td>
                                <td><?php echo htmlspecialchars($row['city']); ?></td>
                                <td><?php echo htmlspecialchars($row['hotel_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td><?php echo htmlspecialchars($row['room_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['address']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td>
                                    <a href="edit_hotel.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="hotel.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        
        //Javascript Validation
        function validateTextInput(event) {
  const inputField = event.target;

  // Remove any numeric characters
  inputField.value = inputField.value.replace(/[0-9]/g, '');
}

// Apply the validation function to the input field
document.getElementById('hotel_name').addEventListener('input', validateTextInput);
document.getElementById('address').addEventListener('input', validateTextInput);

        document.getElementById('phone').addEventListener('input', function (e) {
    const phoneInput = this.value;
    const phoneError = document.getElementById('phone-error');

    // Remove any non-numeric characters
    this.value = phoneInput.replace(/\D/g, '');

    // Prevent input if more than 10 digits
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }

    // Check if input is exactly 10 digits
    if (this.value.length === 10) {
        phoneError.style.display = 'none'; // Hide error if valid
        this.setCustomValidity("");
    } else {
        phoneError.style.display = 'block'; // Show error if invalid
        this.setCustomValidity("Please enter a 10-digit valid number");
    }
});

    </script>

    <?php include('includes/footer.php'); ?>
</body>
</html>

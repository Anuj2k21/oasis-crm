<?php
// Start session to handle messages
session_start();

// Include database connection
include 'includes/config.php';

// Create Country & City
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    $vehicle_name = $_POST['vehicle_name'];
    $seating_capacity = $_POST['seating_capacity'];
    $vehicle_cost_price = $_POST['vehicle_cost_price'];
    $vehicle_selling_price = $_POST['vehicle_selling_price'];

    $sql = "INSERT INTO vehicles (vehicle_name, seating_capacity, vehicle_cost_price, vehicle_selling_price) VALUES ('$vehicle_name', '$seating_capacity', '$vehicle_cost_price', '$vehicle_selling_price')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Vehicle created successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error creating Supplier: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: vehicle.php");
    exit();
}

// Edit Country & City
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $vehicle_name = $_POST['vehicle_name'];
    $seating_capacity = $_POST['seating_capacity'];
    $vehicle_cost_price = $_POST['vehicle_cost_price'];
    $vehicle_selling_price = $_POST['vehicle_selling_price'];
    $sql = "UPDATE vehicles SET vehicle_name='$vehicle_name', seating_capacity='$seating_capacity', vehicle_cost_price='$vehicle_cost_price', vehicle_selling_price='$vehicle_selling_price' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Vehicle updated successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error updating Supplier: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: vehicle.php");
    exit();
}

// Delete Country & City
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM vehicles WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Vehicle deleted successfully!';
        $_SESSION['msg_type'] = 'danger';
    } else {
        $_SESSION['message'] = 'Error deleting supplier: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: vehicle.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Form</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>
<body>
    <!--start header-->
    <?php include('includes/header.php'); ?>
    <!--end header -->

    <!--start sidebar-->
    <?php include('includes/sidebar.php'); ?>
    <!--end sidebar -->

    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <h1 class="breadcrumb-item"><a href="#">Vehicle</a></h1>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Vehicle</h5>
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
                            <!-- Horizontal Form -->
                            <form id="myForm" action="vehicle.php" method="POST">
                                <input type="hidden" name="action" value="create">
                                <div class="container mt-4">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="selectCompany" class="form-label">Vehicle Name</label>
                            <input type="text" class="form-control" id="vehicle_name" name="vehicle_name" placeholder="Enter Vehicle Name" required>
                        </div>
                        <div class="col-md-6">
                          <label for="" class="form-label">Seating Capacity</label>
                          <input type="text" class="form-control" id="seating_capacity" name="seating_capacity" placeholder="Enter Seating Capacity" required>                 
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tourname" class="form-label">Vehicle Cost Price</label>
                            <input type="text" class="form-control" id="vehicle_cost_price" name="vehicle_cost_price" placeholder="Enter Vehicle Cost Price" required>
                        </div>
                        <div class="col-md-6">
                          <label for="pickuptime" class="form-label">Vehicle Selling Price</label>
                          <input type="text" class="form-control" id="vehicle_selling_price" name="vehicle_selling_price" placeholder="Enter Vehicle Selling Price" required>
                        </div>
                    </div>                   
                       <div class="row mb-3">
                        <div class="col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary" style="font-weight: 500;">Create Vehicle</button>
                      </div>
                      
       <!-- Supplier Data Table -->
        <section class="container pt-5">
            <div class="row table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                          <th>Sr#</th>
                          <th>Vehicle Name</th>
                          <th>Seating Capacity</th>
                          <th>Vehicle Cost Price</th>
                          <th>Vehicle Selling Price</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Fetch data for DataTable
                        $result = mysqli_query($conn, "SELECT * FROM vehicles");
                        $sr = 1;
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $sr++; ?></td>
                                <td><?php echo htmlspecialchars($row['vehicle_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['seating_capacity']); ?></td>
                                <td><?php echo htmlspecialchars($row['vehicle_cost_price']); ?></td>
                                <td><?php echo htmlspecialchars($row['vehicle_selling_price']); ?></td>
                                <td>
                                    <a href="edit_vehicle.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="vehicle.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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

    </main><!-- End #main -->

    <!-- Basic setup -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
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
document.getElementById('vehicle_name').addEventListener('input', validateTextInput);

        function validateNumberInput(event) {
  const inputField = event.target;

  // Remove any non-numeric characters
  inputField.value = inputField.value.replace(/\D/g, '');
}

// Apply the validation function to each input field
document.getElementById('seating_capacity').addEventListener('input', validateNumberInput);
document.getElementById('vehicle_cost_price').addEventListener('input', validateNumberInput);
document.getElementById('vehicle_selling_price').addEventListener('input', validateNumberInput);

    </script>

</body>
<?php include('includes/footer.php');?>
</html>

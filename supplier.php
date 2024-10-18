<?php
// Start session to handle messages
session_start();

// Include database connection
include 'includes/config.php';

// Create Country & City
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    $supplier_name = $_POST['supplier_name'];
    $company_name = $_POST['company_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_gst_no = $_POST['supplier_gst_no'];

    $sql = "INSERT INTO supplier (supplier_name, company_name, supplier_address, supplier_gst_no) VALUES ('$supplier_name', '$company_name', '$supplier_address', '$supplier_gst_no')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Supplier created successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error creating Supplier: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: supplier.php");
    exit();
}

// Edit Country & City
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $supplier_name = $_POST['supplier_name'];
    $company_name = $_POST['company_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_gst_no = $_POST['supplier_gst_no'];
    $sql = "UPDATE supplier SET supplier_name='$supplier_name', company_name='$company_name', supplier_address='$supplier_address', supplier_gst_no='$supplier_gst_no' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Supplier updated successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error updating Supplier: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: supplier.php");
    exit();
}

// Delete Country & City
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM supplier WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Supplier deleted successfully!';
        $_SESSION['msg_type'] = 'danger';
    } else {
        $_SESSION['message'] = 'Error deleting supplier: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: supplier.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Form</title>
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
                    <h1 class="breadcrumb-item"><a href="#">Supplier</a></h1>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Supplier</h5>
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
                            <form id="myForm" action="supplier.php" method="POST">
                                <input type="hidden" name="action" value="create">
                                <div class="container mt-4">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="country_name" class="form-label">Supplier Name</label>
                                            <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter Supplier Name" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_name" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_name" class="form-label">Supplier Address</label>
                                            <input type="text" class="form-control" id="supplier_address" name="supplier_address" placeholder="Enter Supplier Address" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_name" class="form-label">Supplier GST No.</label>
                                            <input type="text" class="form-control" id="supplier_gst_no" name="supplier_gst_no" placeholder="Enter Supplier GST No." required>
                                        </div>
                                    </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary" style="font-weight: 500;">Create</button>
                                        </div>
                                        <!-- Supplier Data Table -->
        <section class="container pt-5">
            <div class="row table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Supplier Name</th>
                            <th>Company Name</th>
                            <th>Supplier Address</th>
                            <th>Supplier GST No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch data for DataTable
                        $result = mysqli_query($conn, "SELECT * FROM supplier");
                        $sr = 1;
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $sr++; ?></td>
                                <td><?php echo htmlspecialchars($row['supplier_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['supplier_address']); ?></td>
                                <td><?php echo htmlspecialchars($row['supplier_gst_no']); ?></td>
                                <td>
                                    <a href="edit_supplier.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="supplier.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
document.getElementById('supplier_name').addEventListener('input', validateTextInput);
document.getElementById('company_name').addEventListener('input', validateTextInput);
document.getElementById('supplier_address').addEventListener('input', validateTextInput);

    </script>

    <?php include('includes/footer.php'); ?>
</body>
</html>

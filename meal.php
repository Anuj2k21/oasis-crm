<?php
// Start session to handle messages
session_start();

// Include database connection
include 'includes/config.php';

// Create Meal Type
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    $meal_name = $_POST['meal_name'];

    $sql = "INSERT INTO meal_type (meal_name) VALUES ('$meal_name')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Meal type created successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error creating meal type: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: meal.php");
    exit();
}

// Edit Meal Type
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $meal_name = $_POST['meal_name'];

    $sql = "UPDATE meal_type SET meal_name='$meal_name' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Meal type updated successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error updating meal type: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: meal.php");
    exit();
}

// Delete Meal Type
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM meal_type WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Meal type deleted successfully!';
        $_SESSION['msg_type'] = 'danger';
    } else {
        $_SESSION['message'] = 'Error deleting meal type: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: meal.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Type Form</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>
<body>
    <!-- Start header -->
    <?php include('includes/header.php'); ?>
    <!-- End header -->

    <!-- Start sidebar -->
    <?php include('includes/sidebar.php'); ?>
    <!-- End sidebar -->

    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <h1 class="breadcrumb-item"><a href="#">Meal Types</a></h1>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Meal Type</h5>

                            <!-- Bootstrap Alert Messages -->
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

                            <!-- Meal Type Form -->
                            <form id="myForm" action="meal.php" method="POST">
                                <input type="hidden" name="action" value="create">
                                <div class="container mt-4">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="meal_name" class="form-label">Meal Name</label>
                                            <input type="text" class="form-control" id="meal_name" name="meal_name" placeholder="Enter Meal Name" required>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary" style="font-weight: 500;">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Meal Types Data Table -->
        <section class="container pt-5">
            <div class="row table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Meal Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                //Fetch for DataTable 
                $result = mysqli_query($conn, "SELECT * FROM meal_type");
                        $sr = 1;
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $sr++; ?></td>
                                <td><?php echo $row['meal_name']; ?></td>
                                <td>
                                    <a href="edit_meal.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="meal.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
    </main><!-- End #main -->

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
document.getElementById('meal_name').addEventListener('input', validateTextInput);

    </script>

    <?php include('includes/footer.php'); ?>
</body>
</html>

<?php
// Start session to handle messages
session_start();

// Include database connection
include('includes/config.php');

// Create Country, City & Tour
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    $country = $_POST['country'];
    $city = $_POST['city'];
    $tour_name = $_POST['tour_name'];
    $pickup_time = $_POST['pickup_time'];
    $duration = $_POST['duration'];
    $vehicle_type = $_POST['vehicle_type'];

    $sql = "INSERT INTO tours (country, city, tour_name, pickup_time, duration, vehicle_type) 
            VALUES ('$country', '$city', '$tour_name', '$pickup_time', '$duration', '$vehicle_type')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Tour created successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error creating tour: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: tour.php");
    exit();
}

// Edit Country, City & Tour
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $tour_name = $_POST['tour_name'];
    $pickup_time = $_POST['pickup_time'];
    $duration = $_POST['duration'];
    $vehicle_type = $_POST['vehicle_type'];

    $sql = "UPDATE tours 
            SET country='$country', city='$city', tour_name='$tour_name', pickup_time='$pickup_time', duration='$duration', vehicle_type='$vehicle_type' 
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Tour updated successfully!';
        $_SESSION['msg_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error updating tour: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: tour.php");
    exit();
}

// Delete Country, City & Tour
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tours WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Tour deleted successfully!';
        $_SESSION['msg_type'] = 'danger';
    } else {
        $_SESSION['message'] = 'Error deleting tour: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: tour.php");
    exit();
}

// Fetch countries and cities from the locations table
$countries = [];
$sql = "SELECT DISTINCT country_name FROM locations";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countries[] = $row['country_name'];
    }
}

$cities = [];
$sql = "SELECT DISTINCT city_name FROM locations";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['city_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Master</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        th { text-align: center; }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <h1 class="breadcrumb-item"><a href="#">Tour Master</a></h1>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Tour</h5>

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

                            <!-- Tour Form -->
                            <form action="tour.php" method="POST">
                                <input type="hidden" name="action" value="create">
                                <div class="container mt-4">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="country" class="form-label">Country</label>
                                            <select class="form-select" id="country" name="country" required>
                                                <option disabled selected>Select Country</option>
                                                <?php foreach ($countries as $country): ?>
                                                    <option value="<?= htmlspecialchars($country) ?>"><?= htmlspecialchars($country) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City</label>
                                            <select class="form-select" id="city" name="city" required>
                                                <option disabled selected>Select City</option>
                                                <?php foreach ($cities as $city): ?>
                                                    <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="tour_name" class="form-label">Tour Name</label>
                                            <input type="text" class="form-control" id="tour_name" name="tour_name" placeholder="Enter Tour Name" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="pickup_time" class="form-label">Pick Up Time</label>
                                            <input type="time" class="form-control" id="pickup_time" name="pickup_time" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="duration" class="form-label">Duration</label>
                                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter Duration" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                            <select class="form-select" id="vehicle_type" name="vehicle_type" required>
                                                <option disabled selected>Select Vehicle</option>
                                                <option value="Sharing Basis Vehicle">Sharing Basis Vehicle</option>
                                                <option value="Private Basis Vehicle">Private Basis Vehicle</option>
                                                <option value="Ticket Only">Ticket Only</option>
                                            </select>
                                        </div>
                                    </div>
                    <div class="container mt-4">
                    <h4 class="mb-3  text-black p-3" style=" font-size:16px; font-weight:bold;">The Rates are Entered in AED Currency</h4>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="table-header">
                            <tr class="">
                             <th>Transfer Type</th>
                             <th>Adult Price</th>
                             <th>Child Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td rowspan="4" style="text-align: center; font-weight:bold;">Sharing Transfers</td>
                            <td style="text-align: center;">
                              <input type="text" value="" style="font-weight:bold; margin:0 auto; width:30%;">
                            </td>
                            <td style="text-align:center;">
                             <input type="text" value="" style="font-weight:bold; margin: 0 auto; width:30%;">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead class="table-header">
                    <tr class="">
                        <th>Transfer Type</th>
                        <th>From Pax</th>
                        <th>To Pax</th>
                        <th>Buying Price</th>
                    </tr>
                </thead>
                <tbody style="border: 1px solid black">
                    <tr>
                        <td rowspan="5" style="text-align: center; font-weight:bold;">Private Transfers</td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                    </tr>
                    <tr>
                       
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                        <td style="text-align: center;"><input type="text" value="" style="font-weight:bold; width:30%; margin:0 auto; display:block;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h5 class="mb-3 text-black p-3" style="font-size:16px; font-weight:bold;">Without Transfer (Add ons - for Sharing & Private Transfer)</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-header">
                    <tr class="">
                        <th class="col-md-5">Ticket Only</th>
                        <th>Description</th>
                        <th>Adult Cost</th>
                        <th>Child Cost</th>
                        <th>Adult Sell</th>
                        <th>Child Sell</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" value="Abu Dhabi City Tour With Ferrari (Standard Ticket)" style="font-weight:bold; font-size:16px; width:100%;"></td>
                        <td>
                          <label for="inclusion" class="form-label" style="font-weight:bold;">Remark</label>
                          <textarea class="form-control" id="textAreaExample3" rows="2" style="font-weight:bold;"></textarea>
                        </td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="" style="font-weight:bold; font-size:16px; width:100%;"></td>
                        <td>
                          <label for="inclusion" class="form-label" style="font-weight:bold;">Remark</label>
                          <textarea class="form-control" id="textAreaExample3" rows="2" style="font-weight:bold;"></textarea>
                        </td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="" style="font-weight:bold; font-size:16px; width:100%;"></td>
                        <td>
                          <label for="inclusion" class="form-label" style="font-weight:bold;">Remark</label>
                          <textarea class="form-control" id="textAreaExample3" rows="2" style="font-weight:bold;"></textarea>
                        </td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" value="" style="font-weight:bold; font-size:16px; width:100%;"></td>
                        <td>
                          <label for="inclusion" class="form-label" style="font-weight:bold;">Remark</label>
                          <textarea class="form-control" id="textAreaExample3" rows="2" style="font-weight:bold;"></textarea>
                        </td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                        <td><input type="text" value="" style="font-weight:bold; width:100px;"></td>
                    </tr>
                </tbody>
            </table>
                    </div>
                        <div class="col-md-6 d-flex align-items-end my-3">
                            <button type="submit" class="btn btn-primary" style="font-weight: 500;">Create Tour</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container pt-2">
        <div class="row table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr#</th>
                <th>Country</th>
                <th>City</th>
                <th>Tour Name</th>
                <th>Pickup Time</th>
                <th>Duration</th>
                <th>Vehicle Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
             // Fetch data for DataTable
            $result = mysqli_query($conn, "SELECT * FROM tours");
            $sr = 1;
            while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $sr++; ?></td>
                    <td><?php echo htmlspecialchars($row['country']); ?></td>
                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                    <td><?php echo htmlspecialchars($row['tour_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['pickup_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['duration']); ?></td>
                    <td><?php echo htmlspecialchars($row['vehicle_type']); ?></td>
                    <td>
                        <a href="edit_tour.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="tour.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    
            </div>
          </div>

        </div>
      </div>
    </section>
    
     <!-- Basic setup -->
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap4.js"></script>
    
    <script>
          $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
  </main><!-- End #main -->

  </body>
<?php include('includes/footer.php');?>
</html>
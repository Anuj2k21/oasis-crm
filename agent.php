<?php
// Start session to handle messages
session_start();

// Include database connection
include 'includes/config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company = $_POST['company'];
    $agent_names = $_POST['agent_name']; // Array of agent names
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gstin = $_POST['gstin'];
    $agent_type = $_POST['agent_type'];

    // File upload
    $document_upload = $_FILES['document_upload']['name'];

    // Upload directory
    $target_dir = "Files/";

    // Move file to target directory if a document is uploaded
    if (!empty($document_upload)) {
        $document_target_file = $target_dir . basename($document_upload);
        move_uploaded_file($_FILES['document_upload']['tmp_name'], $document_target_file);
    } else {
        // Set default value if no document is uploaded
        $document_upload = "No document";
    }

    // Insert data into the database for each agent name
    foreach ($agent_names as $agent_name) {
        $sql = "INSERT INTO agents (company, agent_name, address, country, city, email, contact, gstin, agent_type, document_upload) 
                VALUES ('$company', '$agent_name', '$address', '$country', '$city', '$email', '$contact', '$gstin', '$agent_type', '$document_upload')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = 'Agent created successfully!';
            $_SESSION['msg_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error creating agent: ' . mysqli_error($conn);
            $_SESSION['msg_type'] = 'danger';
        }
    }

    header("Location: agent.php");
    exit();
}

// Delete agent
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM agents WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Agent deleted successfully!';
        $_SESSION['msg_type'] = 'danger';
    } else {
        $_SESSION['message'] = 'Error deleting agent: ' . mysqli_error($conn);
        $_SESSION['msg_type'] = 'danger';
    }
    header("Location: agent.php");
    exit();
}

// Fetch countries from the locations table
$countries = [];
$sql = "SELECT DISTINCT country_name FROM locations";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countries[] = $row['country_name'];
    }
}

// Fetch cities from the locations table
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
    <title>Agent Form</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
    <style>
        th {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>
    
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <h1 class="breadcrumb-item"><a href="#">Agent</a></h1>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Agent</h5>
                            <!-- Display Messages -->
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
                            <!-- Agent Form -->
                            <form name="myform" id="myForm" action="agent.php" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="company" name="company" placeholder="Enter Company Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="agent_name" class="form-label">Agent Name</label>
                                        <button type="button" class="btn btn-success my-2" id="addAgentField">
                                            <i class="bi bi-plus"></i> Add More
                                        </button>
                                        <div id="agentNameContainer">
                                            <input type="text" class="form-control mb-2" id="agent_name" name="agent_name[]" placeholder="Enter Agent Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-select" id="country" name="country">
                                            <option selected>Select Country</option>
                                            <?php foreach ($countries as $country): ?>
                                                <option value="<?= htmlspecialchars($country) ?>"><?= htmlspecialchars($country) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="city" class="form-label">City</label>
                                        <select class="form-select" id="city" name="city">
                                            <option selected>Select City</option>
                                            <?php foreach ($cities as $city): ?>
                                                <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="contact" class="form-label">Contact No.</label>
                                        <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter Contact Number" required>
                                        <div id="phone-error" style="color: red; display: none;">Please enter a valid 10-digit phone number.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gstin" class="form-label">GSTIN</label>
                                        <input type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter GSTIN" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="agent_type" class="form-label">Agent Type</label>
                                        <select class="form-select" id="agent_type" name="agent_type">
                                            <option selected>Select Agent Type</option>
                                            <option>B2B</option>
                                            <option>B2C</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="document_upload" class="form-label">Document Upload</label>
                                        <input type="file" class="form-control" id="document_upload" name="document_upload">
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary" style="font-weight: 500;">Create Agent</button>
                                </div>  
                            </form>

                            <!-- Agent Data Table -->
                            <section class="container pt-5">
                                <div class="row table-responsive">
                                    <table class="table table-striped" id="agentTable">
                                        <thead>
                                            <tr>
                                                <th>Company</th>
                                                <th>Agent Name</th>
                                                <th>Address</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>GSTIN</th>
                                                <th>Agent Type</th>
                                                <th>Document</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = $conn->query("SELECT * FROM agents");
                                            while ($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['company']) ?></td>
                                                    <td><?= htmlspecialchars($row['agent_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['address']) ?></td>
                                                    <td><?= htmlspecialchars($row['country']) ?></td>
                                                    <td><?= htmlspecialchars($row['city']) ?></td>
                                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                                    <td><?= htmlspecialchars($row['contact']) ?></td>
                                                    <td><?= htmlspecialchars($row['gstin']) ?></td>
                                                    <td><?= htmlspecialchars($row['agent_type'])?></td>
                                                    <td>
                                                      <?php if ($row['document_upload'] !== "No document"): ?>
                                                      <a href="Files/<?= htmlspecialchars($row['document_upload']) ?>" target="_blank">View Document</a>
                                                      <?php else: ?>
                                                      No document
                                                      <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="agent.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this agent?');">Delete</a>
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
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#agentTable').DataTable();

    document.getElementById('contact').addEventListener('input', function (e) {
        const contactInput = this.value;
        const contactError = document.getElementById('phone-error');

        // Remove any non-numeric characters
        this.value = contactInput.replace(/\D/g, '');

        // Prevent input if more than 10 digits
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }

        // Check if input is exactly 10 digits
        if (this.value.length === 10) {
            contactError.style.display = 'none'; // Hide error if valid
            this.setCustomValidity(""); // Clear custom validity message
        } else {
            contactError.style.display = 'block'; // Show error if not valid
            this.setCustomValidity("Please enter a valid 10-digit phone number."); // Set custom validity message
        }
    });

    // Add more agent fields dynamically
    $('#addAgentField').click(function() {
        $('#agentNameContainer').append(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="agent_name[]" placeholder="Enter Agent Name" required>
                <button type="button" class="btn btn-danger remove-agent-field">&times;</button>
            </div>
        `);
    });

    // Remove agent field dynamically
    $('#agentNameContainer').on('click', '.remove-agent-field', function() {
        $(this).closest('.input-group').remove();
    });
});
</script>
</body>
<?php include('includes/footer.php');?>
</html>

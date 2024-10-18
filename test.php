<?php
// Database connection
$servername = "localhost"; // Update with your DB details
$username = "root";
$password = "";
$dbname = "oasis_traveller"; // Update with your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch companies
$companies = [];
$sql = "SELECT DISTINCT company FROM agents";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row['company'];
    }
}

// Handle AJAX request for fetching agents
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['companyName'])) {
    $companyName = $_POST['companyName'];
    $stmt = $conn->prepare("SELECT * FROM agents WHERE company = ?");
    $stmt->bind_param("s", $companyName);
    $stmt->execute();
    $result = $stmt->get_result();

    $agents = [];
    while ($row = $result->fetch_assoc()) {
        $agents[] = $row;
    }

    echo json_encode($agents);
    exit; // Prevent further execution
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Information Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <form id="bookingForm" action="" method="POST" style="padding:5px;">
        <h5 class="mb-3 p-3" style="font-weight:700">Agent Information</h5>
        <hr>
        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="referenceNumber" class="form-label" style="font-weight:700">Reference Number</label>
                <input type="text" class="form-control" id="referenceNumber" name="referenceNumber" placeholder="Enter Reference">
            </div>
            <div class="col-md-3">
                <label for="companyName" class="form-label" style="font-weight:700">Company Name</label>
                <select class="form-select" id="companyName" name="companyName">
                    <option value="">Select Company</option>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?= htmlspecialchars($company) ?>"><?= htmlspecialchars($company) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="agentName" class="form-label" style="font-weight:700">Agent Name</label>
                <select class="form-select" id="agentName" name="agentName">
                    <option value="">Select Agent</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="address" class="form-label" style="font-weight:700">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
            </div>
        </div>
        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="country" class="form-label" style="font-weight:700">Country</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
            </div>
            <div class="col-md-3">
                <label for="city" class="form-label" style="font-weight:700">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
            </div>
            <div class="col-md-3">
                <label for="contact" class="form-label" style="font-weight:700">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact">
            </div>
            <div class="col-md-3">
                <label for="soldby" class="form-label" style="font-weight:700">Sold By</label>
                <?php foreach ($companies as $company): ?>
                   <option value="<?= htmlspecialchars($company) ?>"><?= htmlspecialchars($company) ?></option>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="gstin" class="form-label" style="font-weight:700">GSTIN No.</label>
                <input type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter GSTIN No.">
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#companyName').change(function() {
        var companyName = $(this).val();

        if (companyName) {
            $.ajax({
                type: 'POST',
                url: '', // Current page URL
                data: {companyName: companyName},
                dataType: 'json',
                success: function(response) {
                    $('#agentName').empty();
                    $('#agentName').append('<option value="">Select Agent</option>');
                    $.each(response, function(index, agent) {
                        $('#agentName').append('<option value="' + agent.agent_name + '" data-agent=\'' + JSON.stringify(agent) + '\'>' + agent.agent_name + '</option>');
                    });
                }
            });
        } else {
            $('#agentName').empty();
            $('#agentName').append('<option value="">Select Agent</option>');
        }
    });

    $('#agentName').change(function() {
        var agentData = $(this).find('option:selected').data('agent');

        if (agentData) {
            $('#address').val(agentData.address);
            $('#country').val(agentData.country);
            $('#city').val(agentData.city);
            $('#contact').val(agentData.contact);
            $('#gstin').val(agentData.gstin);
        } else {
            $('#address').val('');
            $('#country').val('');
            $('#city').val('');
            $('#contact').val('');
            $('#gstin').val('');
        }
    });
});
</script>
</body>
</html>

<?php
// Database connection
include('includes/config.php');

// Fetch companies
$companies = [];
$sql = "SELECT DISTINCT company FROM agents";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row['company'];
    }
}

// Fetch hotels with their address and phone
$hotels = [];
$sql = "SELECT hotel_name, address, phone FROM hotels";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hotels[] = $row;
    }
}

// Fetch countries from the hotel table
$country = [];
$sql = "SELECT DISTINCT country FROM hotels";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $country[] = $row['country'];
    }
}

// Fetch cities from the hotel table
$city = [];
$sql = "SELECT DISTINCT city FROM hotels";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $city[] = $row['city'];
    }
}

// Fetch nationality from the visa table
$nationality = [];
$sql = "SELECT DISTINCT country FROM visa_types";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nationality[] = $row['country'];
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


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $reference_number = $_POST['reference_number'] ?? '';
    $company_name = $_POST['company_name'] ?? '';
    $agent_name = $_POST['agent_name'] ?? '';
    $address = $_POST['address'] ?? '';
    $country = $_POST['country'] ?? '';
    $city = $_POST['city'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $sold_by = $_POST['sold_by'] ?? '';
    $gstin_no = $_POST['gstin_no'] ?? '';
    $guest_name = $_POST['guest_name'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $hotel = $_POST['hotel'] ?? '';
    $hotel_address = $_POST['hotel_address'] ?? '';
    $hotel_no = $_POST['hotel_no'] ?? '';
    $room_no = $_POST['room_no'] ?? '';
    $whatsapp_number = $_POST['whatsapp_number'] ?? '';
    $emergency_number = $_POST['emergency_number'] ?? '';
    $adult = $_POST['adult'] ?? '';
    $child = $_POST['child'] ?? '';
    $infant = $_POST['infant'] ?? '';

    // Prepare the SQL query to insert the data into the database
    $sql = "INSERT INTO agent_info (reference_number, company_name, agent_name, address, country, city, contact, sold_by, gstin_no, guest_name, destination, hotel, hotel_address, hotel_no, room_no, whatsapp_number, emergency_number, adult, child, infant) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param(
        "sssssssssssssssssssss", 
        $reference_number, $company_name, $agent_name, $address, $country, $city, $contact, $sold_by, $gstin_no, 
        $guest_name, $destination, $hotel, $hotel_address, $hotel_no,
        $room_no, $whatsapp_number, $emergency_number, $adult, $child, $infant
    );

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect or display success message
        echo "<script>alert('Data inserted successfully!'); window.location.href='success_page.php';</script>";
    } else {
        // Display error message
        echo "<script>alert('Error: Could not insert data. Please try again.'); window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
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
                <input type="text" class="form-control" id="soldby" name="soldby" placeholder="Enter Sold By">
            </div>
        </div>
        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="gstin" class="form-label" style="font-weight:700">GSTIN No.</label>
                <input type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter GSTIN No.">
            </div>
        </div>
    </form>

    <!-- Guest Information Start here -->
    <h5 class="mb-3 p-3" style="font-weight:700">Guest Information</h5>
    <hr>
    <div class="row mb-3 px-3">
        <div class="col-md-3">
            <label for="guestName" class="form-label" style="font-weight:700">Guest Name</label>
            <input type="text" class="form-control" id="guestName" name="guestName" placeholder="Enter Guest Name">
        </div>
        <div class="col-md-3">
            <label for="destination" class="form-label" style="font-weight:700">Destination/Country</label>
            <select class="form-select" id="destinationCountry">
                <option selected>Select Country</option>
                <?php foreach ($country as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>"><?= htmlspecialchars($country) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="city" class="form-label" style="font-weight:700">City</label>
            <select class="form-select" id="destinationCity">
                <option selected>Select City</option>
                <?php foreach ($city as $city): ?>
                    <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="hotel" class="form-label" style="font-weight:700">Hotel Name</label>
            <select class="form-select" id="hotelName">
                <option selected>Select Hotel</option>
                <?php foreach ($hotels as $hotel): ?>
                    <option value="<?= htmlspecialchars($hotel['hotel_name']) ?>" data-address="<?= htmlspecialchars($hotel['address']) ?>" data-phone="<?= htmlspecialchars($hotel['phone']) ?>">
                        <?= htmlspecialchars($hotel['hotel_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3 px-3">
        <div class="col-md-3">
            <label for="hotelAddress" class="form-label" style="font-weight:700">Hotel Address</label>
            <input type="text" class="form-control" id="hotelAddress" name="hotelAddress" placeholder="Enter Hotel Address">
        </div>
        <div class="col-md-3">
            <label for="phone" class="form-label" style="font-weight:700">Hotel Contact No.</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Contact No.">
        </div> 
        <div class="col-md-3">
            <label for="room_no" class="form-label" style="font-weight:700">Room Number</label>
            <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Enter Room No.">
        </div>
        <div class="col-md-3">
            <label for="whatsappNumber" class="form-label" style="font-weight:700">WhatsApp Number</label>
            <input type="text" class="form-control" id="whatsappNumber" name="whatsappNumber" placeholder="Enter WhatsApp No.">
        </div>     
    </div>
    <div class="row mb-3 px-3">
                <div class="col-md-3">
                    <label for="emergencyNumber" class="form-label" style="font-weight:700">Emergency Number</label>
                    <input type="text" class="form-control" id="emergencyNumber" name="emergencyNumber" placeholder="Enter Emergency No.">
                </div>
                <div class="col-md-3">
                    <label for="adult" class="form-label" style="font-weight:700">Adults</label>
                    <input type="text" class="form-control" id="adult" name="adult" placeholder="Enter No. of Adults">
                </div>
                <div class="col-md-3">
                    <label for="child" class="form-label" style="font-weight:700">Children</label>
                    <input type="text" class="form-control" id="child" name="child" placeholder="Enter No. of Children">
                </div>
                <div class="col-md-3">
                    <label for="infant" class="form-label" style="font-weight:700">Infants</label>
                    <input type="text" class="form-control" id="infant" name="infant" placeholder="Enter No. of Infants">
                </div>
            </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary" name="submit" id="submitBtn">Submit</button>
    </div>
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

    $('#hotelName').change(function() {
        var selectedOption = $(this).find('option:selected');
        var address = selectedOption.data('address');
        var phone = selectedOption.data('phone');

        $('#hotelAddress').val(address ? address : '');
        $('#phone').val(phone ? phone : '');
    });
});
</script>
</body>
</html>

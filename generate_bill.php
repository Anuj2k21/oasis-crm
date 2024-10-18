<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!--start header-->
  <?php include('includes/header.php');?>
  <!--end header-->
  <!--start sidebar-->
  <?php include('includes/sidebar.php');?>
  <!--end sidebar-->
  <?php include('includes/config.php');

// Fetch supplier_name from supplier
$supplier = [];
$sql = "SELECT DISTINCT supplier_name FROM supplier";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $supplier[] = $row['supplier_name'];
    }
}

// Fetch hotel_name from hotels
$hotels = [];
$sql = "SELECT DISTINCT hotel_name FROM hotels";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hotels[] = $row['hotel_name'];
    }
}
// Fetch room_type from hotels
$room_type = [];
$sql = "SELECT DISTINCT room_type FROM hotels";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $room_type[] = $row['room_type'];
    }
}

// Fetch meal_name from meal_type
$meal = [];
$sql = "SELECT DISTINCT meal_name FROM meal_type";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meal[] = $row['meal_name'];
    }
}

// Fetch duration from tours
$duration = [];
$sql = "SELECT DISTINCT duration FROM tours";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $duration[] = $row['duration'];
    }
}

// Fetch tour_name from tours
$tour = [];
$sql = "SELECT DISTINCT tour_name FROM tours";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tour[] = $row['tour_name'];
    }
}

// Fetch supplier_name from supplier
$suppliers = [];
$sql = "SELECT DISTINCT supplier_name FROM supplier";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $suppliers[] = $row['supplier_name'];
    }
}

// Fetch visa_type from visa_types
$visa = [];
$sql = "SELECT DISTINCT visa_type FROM visa_types";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $visa[] = $row['visa_type'];
    }
}

// Fetch nationality from nationalities
$nationality = [];
$sql = "SELECT DISTINCT nationality FROM nationalities";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nationality[] = $row['nationality'];
    }
}

// Check if form is submitted
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data (you may want to add more validation here)
    $referenceNumber = $_POST['referenceNumber'];
    $companyName = $_POST['companyName'];
    $agentName = $_POST['agentName'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];
    $sold_by = $_POST['sold_by'];
    $gstin_no = $_POST['gstin_no'];
    $guest_name = $_POST['guest_name'];
    $destination_country = $_POST['destination_country'];
    $destination_city = $_POST['destination_city'];
    $hotel_name = $_POST['hotel_name'];
    $hotel_address = $_POST['hotel_address'];
    $hotel_contact_no = $_POST['hotel_contact_no'];
    $room_no = $_POST['room_no'];
    $whatsapp_no = $_POST['whatsapp_no'];
    $emergency_no = $_POST['emergency_no'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $infants = $_POST['infants'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO agent_info (reference_number, company_name, agent_name, address, country, city, contact, sold_by, gstin_no, guest_name, destination_country, destination_city, hotel_name, hotel_address, hotel_contact_no, room_no, whatsapp_no, emergency_no, adults, children, infants) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssssssiii", $referenceNumber, $companyName, $agentName, $address, $country, $city, $contact, $sold_by, $gstin_no, $guest_name, $destination_country, $destination_city, $hotel_name, $hotel_address, $hotel_contact_no, $room_no, $whatsapp_no, $emergency_no, $adults, $children, $infants);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        // After success, redirect to prevent form resubmission
        header("Location: success_page.php"); // Change to your desired page or reload the current page
        exit(); // Ensure no further code is executed
    } else {
        // Error handling code here
        echo "Error: Could not save data.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="assets/js/main.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
      button {
        margin-top: 10px;
      }


    </style>
  </head>
  <body>

  <main id="main" class="main">
<div id="submitted-info" style="display:none;font-weight: bold; background-color:pink; padding:20px; text-align:center;">
    
    <p style="color:black; display:inline;  margin:20px">Reference Number <span id="reference-display" style="color: green;">7883737</span></p>

    <p style="color:black;display:inline;  margin:20px">Company Name <span id="company-display" style="color: green">Aman Pvt Litd</span></p>

    <p style="color:black;display:inline;  margin:20px">Agent Name  <span id="agent-display" style="color: green">Aman SHah ahah</span></p>
   
   
</div>
    <div class="container mt-5">
      <h2>Generate Bill</h2>  
        
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a
            class="nav-link active"
            id="booking-info-tab"
            data-bs-toggle="tab"
            href="#booking-info"
            role="tab"
            >Booking Info</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="hotel-tab"
            data-bs-toggle="tab"
            href="#hotelbooking"
            role="tab"
            >Hotel</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="tours-tab"
            data-bs-toggle="tab"
            href="#tours"
            role="tab"
            >Tours</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="visa-tab"
            data-bs-toggle="tab"
            href="#visa"
            role="tab"
            >Visa</a
          >
        </li>
        <!-- <li class="nav-item">
          <a
            class="nav-link"
            id="air-ticket-tab"
            data-bs-toggle="tab"
            href="#air-ticket"
            role="tab"
            >Air Ticket</a
          >
        </li> -->
        <li class="nav-item">
          <a
            class="nav-link"
            id="supplier-payment-tab"
            data-bs-toggle="tab"
            href="#supplier-payment"
            role="tab"
            >Supplier Payment</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="received-amount-tab"
            data-bs-toggle="tab"
            href="#received-amount"
            role="tab"
            >Received Amount</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="invoice-tab"
            data-bs-toggle="tab"
            href="#invoice"
            role="tab"
            >Invoice</a
          >
        </li>

        <li class="nav-item">
          <a
            class="nav-link"
            id="payment-history-tab"
            data-bs-toggle="tab"
            href="#payment-history"
            role="tab"
            >Payment History</a
          >
        </li>
      </ul>

 <div class="tab-content" id="myTabContent">


    

        <!-- Booking Information Tab -->
        <div
          class="tab-pane fade show active"
          id="booking-info"
          role="tabpanel"
        >
             <!-- Booking Information Form Start -->
    <form id="bookingForm" method="POST">
        <h5 class="mb-3 p-3" style="font-weight: bold;">Agent Information</h5>
        <hr>

        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="referenceNumber" class="form-label" style="font-weight: bold;">Reference Number</label>
                <input type="text" class="form-control" id="referenceNumber" name="referenceNumber" placeholder="Enter Reference" value="">
            </div>
            <div class="col-md-3">
                <label for="companyName" class="form-label" style="font-weight: bold;">Company Name</label>
                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company Name" value="">
            </div>
            <div class="col-md-3">
                <label for="agentName" class="form-label" style="font-weight: bold;">Agent Name</label>
                <input type="text" class="form-control" id="agentName" name="agentName" placeholder="Enter Agent Name" value="">
            </div>
            <div class="col-md-3">
                <label for="address" class="form-label" style="font-weight: bold;">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
            </div>
        </div>

        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="country" class="form-label" style="font-weight: bold;">Country</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
            </div>
            <div class="col-md-3">
                <label for="city" class="form-label" style="font-weight: bold;">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
            </div>
            <div class="col-md-3">
                <label for="contact" class="form-label" style="font-weight: bold;">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact">
            </div>
            <div class="col-md-3">
                <label for="sold_by" class="form-label" style="font-weight: bold;">Sold By</label>
                <input type="text" class="form-control" id="sold_by" name="sold_by" placeholder="Enter Sold By">
            </div>
        </div>

        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="gstin_no" class="form-label" style="font-weight: bold;">GSTIN No.</label>
                <input type="text" class="form-control" id="gstin_no" name="gstin_no" placeholder="Enter GSTIN No.">
            </div>
            <div class="col-md-3">
                <label for="guest_name" class="form-label" style="font-weight: bold;">Guest Name</label>
                <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="Enter Guest Name">
            </div>
            <div class="col-md-3">
                <label for="destination_country" class="form-label" style="font-weight: bold;">Destination Country</label>
                <input type="text" class="form-control" id="destination_country" name="destination_country" placeholder="Enter Destination Country">
            </div>
            <div class="col-md-3">
                <label for="destination_city" class="form-label" style="font-weight: bold;">Destination City</label>
                <input type="text" class="form-control" id="destination_city" name="destination_city" placeholder="Enter Destination City">
            </div>
        </div>

        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="hotel_name" class="form-label" style="font-weight: bold;">Hotel Name</label>
                <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Enter Hotel Name">
            </div>
            <div class="col-md-3">
                <label for="hotel_address" class="form-label" style="font-weight: bold;">Hotel Address</label>
                <input type="text" class="form-control" id="hotel_address" name="hotel_address" placeholder="Enter Hotel Address">
            </div>
            <div class="col-md-3">
                <label for="hotel_contact_no" class="form-label" style="font-weight: bold;">Hotel Contact No.</label>
                <input type="text" class="form-control" id="hotel_contact_no" name="hotel_contact_no" placeholder="Enter Hotel Contact No.">
            </div>
            <div class="col-md-3">
                <label for="room_no" class="form-label" style="font-weight: bold;">Room No.</label>
                <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Enter Room No.">
            </div>
        </div>

        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="whatsapp_no" class="form-label" style="font-weight: bold;">WhatsApp No.</label>
                <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="Enter WhatsApp No.">
            </div>
            <div class="col-md-3">
                <label for="emergency_no" class="form-label" style="font-weight: bold;">Emergency No.</label>
                <input type="text" class="form-control" id="emergency_no" name="emergency_no" placeholder="Enter Emergency No.">
            </div>
            <div class="col-md-3">
                <label for="adults" class="form-label" style="font-weight: bold;">Adults</label>
                <input type="number" class="form-control" id="adults" name="adults" placeholder="Number of Adults" min="0">
            </div>
            <div class="col-md-3">
                <label for="children" class="form-label" style="font-weight: bold;">Children</label>
                <input type="number" class="form-control" id="children" name="children" placeholder="Number of Children" min="0">
            </div>
        </div>

        <div class="row mb-3 px-3">
            <div class="col-md-3">
                <label for="infants" class="form-label" style="font-weight: bold;">Infants</label>
                <input type="number" class="form-control" id="infants" name="infants" placeholder="Number of Infants" min="0">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

   
          <button class="btn btn-primary" id="saveBooking">Save & Next</button>

 </div>
 <script>
                $(document).ready(function() {
                    $('#bookingForm').on('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission

                        const formData = $(this).serialize(); // Serialize the form data

                        // Disable the submit button to prevent multiple submissions
                        $('button[type="submit"]').prop('disabled', true);

                        // AJAX call to send the form data to the server
                        $.ajax({
                            url: '', // Specify your PHP script that processes the form
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Data saved successfully!',
                                    confirmButtonText: 'OK'
                                });

                                // After success, display the submitted data and redirect
                                const referenceNumberInput = document.getElementById("referenceNumber");
                                const companyNameInput = document.getElementById("companyName");
                                const agentNameInput = document.getElementById("agentName");
                                document.getElementById("reference-display").innerText = referenceNumberInput.value;
                                document.getElementById("company-display").innerText = companyNameInput.value;
                                document.getElementById("agent-display").innerText = agentNameInput.value;

                                // Display the submitted info
                                document.getElementById("submitted-info").style.display = "block";

                                // Reset the form fields and enable the submit button
                                $('#bookingForm').trigger("reset");
                                $('button[type="submit"]').prop('disabled', false);

                                // Redirect to avoid form re-submission on refresh
                                window.location.href = ""; // Replace with your own redirect
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'There was a problem saving the data!',
                                    confirmButtonText: 'OK'
                                });
                                
                                // Re-enable the submit button on error
                                $('button[type="submit"]').prop('disabled', false);
                            }
                        });
                    });
                });
            </script>


    <!-- booking info ENds-->

        <!-- Hotel Tab aman -->
 <div class="tab-pane fade" id="hotelbooking" role="tabpanel" >
        
    <div class="tab-content" id="myTabContent" style="overflow:auto">
        <div class="tab-pane fade show active" id="booking" role="tabpanel" aria-labelledby="booking-tab">
            <div class="table-container mt-3">
                <table class="table table-bordered" id="booking_hotel">
                    <thead>
                        <tr>
                            <th class="px-5">Supplier</th>
                            <th class="px-5">Hotel</th>
                            <th>Rooms</th>
                            <th style="white-space:nowrap">Room Type</th>
                            <th style="white-space:nowrap">Meal Type</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Deadline</th>
                            <th>Cost(AED)</th>
                            <th>Sell(AED)</th>
                            <th style="white-space:nowrap">Gross Profit</th>
                            <th class="text-center">
                                <button class="btn btn-success btn-sm" id="addRowBtn-1">Add</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="hotelBookingBody">
                        <tr>
                            <td class="col-md-3 w-auto">
                                <select class="form-select" style="width:200px;">
                                    <option selected disabled>Select Supplier</option>
                                     <?php foreach ($supplier as $supplier): ?>
                                    <option value="<?= htmlspecialchars($supplier) ?>"><?= htmlspecialchars($supplier) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="col-md-3 w-auto">
                                <select class="form-select" style="width:200px;">
                                    <option selected disabled>Select Hotel</option>
                                     <?php foreach ($hotels as $hotels): ?>
                                    <option value="<?= htmlspecialchars($hotels) ?>"><?= htmlspecialchars($hotels) ?></option>
                                   <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" style="width:100px;"></td>
                            <td class="col-md-2">
                                <select class="form-select" style="width:200px;">
                                    <option selected disabled>Select Room Type</option>
                                    <?php foreach ($room_type as $room_type): ?>
                                    <option value="<?= htmlspecialchars($room_type) ?>"><?= htmlspecialchars($room_type) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="col-md-2">
                                <select class="form-select" style="width:150px">
                                    <option selected disabled>Select Meal</option>
                                      <?php foreach ($meal as $meal): ?>
                                    <option value="<?= htmlspecialchars($meal) ?>"><?= htmlspecialchars($meal) ?></option>
                                   <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="date" class="form-control" ></td>
                            <td><input type="date" class="form-control"></td>
                            <td><input type="date" class="form-control"></td>
                            <td><input type="text" class="form-control cost-input"></td>
                            <td><input type="text" class="form-control sell-input"></td>
                            <td><input type="text" class="form-control gross-profit-input" readonly></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm deleteRowBtn-1">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
          <button class="btn btn-primary" id="saveHotel">Save & Next</button>
          <button class="btn btn-secondary" id="skipHotel">Skip</button>
      </div>
<script>
// Hotel tab value Dynamically start
document.addEventListener('DOMContentLoaded', function () {
    const hotelTableBody = document.getElementById('hotelBookingBody');
    const addRowBtn = document.getElementById('addRowBtn-1');

    // Function to calculate gross profit (Sell - Cost)
    function calculateGrossProfit() {
        const rows = document.querySelectorAll('#booking_hotel tbody tr');
        rows.forEach(row => {
            const costInput = row.querySelector('.cost-input');
            const sellInput = row.querySelector('.sell-input');
            const grossProfitInput = row.querySelector('.gross-profit-input');

            const cost = parseFloat(costInput.value) || 0;
            const sell = parseFloat(sellInput.value) || 0;
            const grossProfit = sell - cost;

            grossProfitInput.value = grossProfit.toFixed(2); // Set the calculated value
        });
    }

    // Function to dynamically add a new row
    function addRow() {
        const newRow = hotelTableBody.rows[0].cloneNode(true); // Clone the first row
        // Clear the input values in the new row
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        
        // Append the new row to the table body
        hotelTableBody.appendChild(newRow);

        // Reattach event listeners to the new row's inputs for calculation
        newRow.querySelectorAll('.sell-input, .cost-input').forEach(input => {
            input.addEventListener('input', calculateGrossProfit);
        });

        // Attach delete row functionality to the delete button
        attachDeleteListener(newRow);
    }

    // Function to delete a row
    function attachDeleteListener(row) {
        const deleteBtn = row.querySelector('.deleteRowBtn-1');
        deleteBtn.addEventListener('click', function () {
            row.remove();
        });
    }

    // Attach listeners to existing rows
    document.querySelectorAll('#hotelBookingBody tr').forEach(row => {
        row.querySelectorAll('.sell-input, .cost-input').forEach(input => {
            input.addEventListener('input', calculateGrossProfit);
        });
        attachDeleteListener(row); // Attach delete functionality
    });

    // Add new row on button click
    addRowBtn.addEventListener('click', function (e) {
        e.preventDefault();
        addRow(); // Add a new row when the "Add" button is clicked
    });
});



//form submitting and save to db
const saveHotelDataToDb=(hotelData)=>{
$.ajax({
    url: 'save_hotel.php',
    type: 'POST',
    data: JSON.stringify({
        hotelData,
    }),
    contentType: 'application/json',
    success: function(response) {
      
        const res = JSON.parse(response);
        if (res.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: res.message,
                confirmButtonText: 'OK'
            });
            //move to tour tab if success
            document.getElementById('tours-tab').click();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: res.message,
                confirmButtonText: 'OK'
            });
        }
    },
    error: function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was a problem with the request!',
            confirmButtonText: 'OK'
        });
    }
});
}


function getTableData(e) {
  e.preventDefault();
    var table = document.getElementById('booking_hotel');
    var tableData = [];
    var headers = [];
    var headerCells = table.rows[0].cells;
    for (var i = 0; i < headerCells.length; i++) {
        headers.push(headerCells[i].textContent.trim());
    }
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = {};
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];
            var inputElement = cell.querySelector('input, select'); 
            if (inputElement) {
                rowData[headers[j]] = inputElement.value.trim();
            } else {
                rowData[headers[j]] = cell.textContent.trim();
            }
        }
        tableData.push(rowData);
    }
     const reference_number=document.getElementById("reference-display").innerText;
     const hotelData = tableData.map((dataum) => ({
    supplier: dataum.Supplier,
    hotel: dataum.Hotel,
    rooms: dataum.Rooms !== '' ? Number(dataum.Rooms) : null,
    room_type: dataum["Room Type"],
    meal_type: dataum["Meal Type"],
    check_in: dataum["Check In"],
    check_out: dataum["Check Out"],
    deadline: dataum.Deadline,
    cost_aed:  dataum["Cost(AED)"] !== '' ? Number(dataum["Cost(AED)"]) : null, 
    sell_aed:  dataum["Sell(AED)"] !== '' ? Number(dataum["Sell(AED)"]) : null, 
    // gross_profit:  dataum["Gross Profit"] !== '' ? Number(dataum["Gross Profit"]) : null, 
    reference_number,
}));
    saveHotelDataToDb(hotelData);
}


document.getElementById("saveHotel").addEventListener('click',getTableData)
</script>

 <!-- Hotel tab value Dynamically end -->



 <!-- Tour tab starts -->
        <div class="tab-pane fade" id="tours" role="tabpanel">
           <div class="tab-content" id="myTabContent" style="overflow:auto">
        
            <div class="table-container">
                <table class="table table-bordered" id="booking_tour">
                    <thead style="font-size: 14px;">
                        <tr>
                            <th>Date</th>
                            <th>Pickup Time</th>
                            <th>Duration</th>
                            <th>Tour Type</th>
                            <th>Tour</th>
                            <th>Adult</th>
                            <th>Child</th>
                            <th>Infant</th>
                            <th>Cost (AED)</th>
                            <th>Total Selling (AED)</th>
                            <th>Gross Profit</th>
                            <th>Remark</th>
                            <th class="text-center">
                                <button class="btn btn-success btn-sm" id="addRowBtn-2">Add</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="date" class="form-control" placeholder="mm/dd/yyyy"></td>
                            <td><input type="time" class="form-control"></td>
                            <td class="col-md-2">
                                <select class="form-select" style="width:180px;">
                                    <option selected disabled>Select Duration</option>
                                     <?php foreach ($duration as $duration): ?>
                                    <option value="<?= htmlspecialchars($duration) ?>"><?= htmlspecialchars($duration) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="col-md-2">
                                <select class="form-select" style="width:180px;">
                                    <option selected disabled>Select Tour Type</option>
                                    <option>Sharing Transfers</option>
                                    <option>Private Transfers</option>
                                    <option>Ticket Only</option>
                                </select>
                            </td>
                            <td class="col-md-2">
                                <select class="form-select" style="width:150px;">
                                    <option selected disabled>Select Tour</option>
                                     <?php foreach ($tour as $tour): ?>
                                    <option value="<?= htmlspecialchars($tour) ?>"><?= htmlspecialchars($tour) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                            <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                            <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                            <td class="col-md-1"><input type="text" class="form-control cost-input" style="width:100px;"></td> <!-- Cost input -->
                            <td class="col-md-1"><input type="text" class="form-control sell-input" style="width:100px;"></td> <!-- Total Selling input -->
                            <td class="col-md-1"><input type="text" class="form-control gross-profit-input" style="width:100px;" readonly></td> <!-- Gross Profit input -->
                            <td class="col-md-2"><textarea placeholder="Remark" class="form-control" style="width:100px;"></textarea></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm deleteRowBtn-2">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
         
        </div>
          <button class="btn btn-primary" id="saveTours">Save & Next</button>
          <button class="btn btn-secondary" id="skipTours">Skip</button>
    </div>
          

    <script>
      //Tour Tab value Dynamically start
// Attach event listeners to all sell and cost input fields
document.querySelectorAll('.sell-input, .cost-input').forEach(input => {
    input.addEventListener('input', calculateGrossProfit);
});

function calculateGrossProfit() {
    // Select all rows in the table body of booking_tour
    const rows = document.querySelectorAll('#booking_tour tbody tr');
    
    // Iterate over each row to calculate the gross profit
    rows.forEach(row => {
        const costInput = row.querySelector('.cost-input');
        const sellInput = row.querySelector('.sell-input');
        const grossProfitInput = row.querySelector('.gross-profit-input');

        // Parse the sell and cost values from the respective input fields
        const cost = parseFloat(costInput.value) || 0;
        const sell = parseFloat(sellInput.value) || 0;

        // Calculate the gross profit: Total Selling - Total Cost
        const grossProfit = sell - cost;

        // Set the calculated gross profit value in the corresponding input field
        grossProfitInput.value = grossProfit.toFixed(2);
    });
}
// Add functionality to dynamically add rows (optional)
document.getElementById('addRowBtn-2').addEventListener('click', function() {
    const tbody = document.querySelector('#booking_tour tbody');
    const newRow = tbody.rows[0].cloneNode(true);
    
    // Clear all input fields in the cloned row
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelector('textarea').value = '';
    
    // Append the new row to the table
    tbody.appendChild(newRow);

    // Reattach event listeners to the new inputs
    newRow.querySelectorAll('.sell-input, .cost-input').forEach(input => {
        input.addEventListener('input', calculateGrossProfit);
    });
});

// Delete row functionality
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('deleteRowBtn-2')) {
        const row = e.target.closest('tr');
        row.remove();
    }
});
 
//amanTour
function getTableData(e) {
  e.preventDefault();
    var table = document.getElementById('booking_tour');
    var tableData = [];
    var headers = [];
    var headerCells = table.rows[0].cells;
    for (var i = 0; i < headerCells.length; i++) {
        headers.push(headerCells[i].textContent.trim());
    }
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = {};
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];
            var inputElement = cell.querySelector('input, select'); 
            if (inputElement) {
                rowData[headers[j]] = inputElement.value.trim();
            } else {
                rowData[headers[j]] = cell.textContent.trim();
            }
        }
        tableData.push(rowData);
    }
     const reference_number=document.getElementById("reference-display").innerText;

     console.log("table data",...tableData)

}
</script>
<!-- Tour tab Ends -->

    
    
    
    
 <!-- Visa Tab -->
          <div class="tab-pane fade" id="visa" role="tabpanel" >
      <div class="tab-content" id="myTabContent" style="overflow:auto">
       
            <div class="table-container mt-3">
                <table class="table table-bordered" id="booking_visa" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th style="white-space:nowrap;">Visa Type Country</th>
                            <th>Name</th>
                            <th style="white-space:nowrap;">Passport No.</th>
                            <th>Adult/Child</th>
                            <th>Nationality</th>
                            <th>ECR</th>
                            <th>Cost (AED)</th>
                            <th>Sell (AED)</th>
                            <th>Cost (INR)</th>
                            <th>Sell (INR)</th>
                            <th>Gross P.(AED)</th>
                            <th>Gross P.(INR)</th>
                            <th class="text-center">
                                <button class="btn btn-success btn-sm" id="addRowBtn-3">Add</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="date" class="form-control" name="date"></td>
                            <td class="col-md-2">
                                <select class="form-select" name="supplier" style="width:200px;">
                                    <option selected disabled>Select Supplier</option>
                                     <?php foreach ($suppliers as $suppliers): ?>
                                    <option value="<?= htmlspecialchars($suppliers) ?>"><?= htmlspecialchars($suppliers) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="col-md-2">
                                <select class="form-select" name="visa_type" style="width:200px;">
                                    <option selected disabled>Select Visa Type</option>
                                     <?php foreach ($visa as $visa): ?>
                                    <option value="<?= htmlspecialchars($visa) ?>"><?= htmlspecialchars($visa) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="col-md-2"><input type="text" class="form-control" name="name" style="width:200px;"></td>
                            <td class="col-md-2"><input type="text" class="form-control" name="passport" style="width:150px;"></td>
                            <td class="col-md-2">
                                <select class="form-select" name="adult_child" style="width:100px;">
                                  <option value="" selected disabled>Select</option>
                                  <option value="Adult">Adult</option>
                                  <option value="Child">Child</option>
                                </select>
                            </td>
                            <td class="col-md-2">
                                <select class="form-select" name="nationality" style="width:150px;">
                                 <option value="" disabled>Select Nationality</option>
                                    <?php foreach ($nationality as $nation): ?>
                                    <option value="<?= htmlspecialchars($nation) ?>" 
                                     <?php if ($nation == "Indian") echo 'selected'; ?>>
                                     <?= htmlspecialchars($nation) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <td class="col-md-2">
                                <select class="form-select" name="ecr" style="width:100px;">
                                    <option selected disabled>Select</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control cost" name="cost_AED" style="width:70px;"></td>
                            <td><input type="text" class="form-control sell" name="sell_AED" style="width:70px;"></td>
                            <td><input type="text" class="form-control cost" name="cost_INR" style="width:70px;"></td>
                            <td><input type="text" class="form-control sell" name="sell_INR" style="width:70px;"></td>
                            <td><input type="text" class="form-control gross_profit" name="gross_profit(AED)" readonly style="width:100px"></td>
                            <td><input type="text" class="form-control gross_profit" name="gross_profit(INR)" readonly style="width:100px"></td>
                            <td><button class="btn btn-danger btn-sm deleteRowBtn-3">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
       
        </div>
        <button class="btn btn-primary" id="saveVisa">Save & Next</button>
          <button class="btn btn-secondary" id="skipVisa">Skip</button>
    </div>
          
        

        <!-- Visa tab Ends -->

        <!-- Air Ticket Tab -->
        <!-- <div class="tab-pane fade" id="air-ticket" role="tabpanel">
          <h4>Air Ticket</h4>
          <button class="btn btn-primary" id="saveAirTicket">
            Save & Next
          </button>
          <button class="btn btn-secondary" id="skipAirTicket">Skip</button>
        </div> -->

        <!-- Supplier Payment Tab -->
        <div class="tab-pane fade" id="supplier-payment" role="tabpanel">
       <div class="content-section">
        <div class="content-section">
  <!-- Supplier Payment Details Form -->
  <form id="SupplierPaymentForm">
    <h5 class="mb-3" style="font-weight: bold;">Supplier Payment Details</h5>
    <hr />

    <!-- Row 1: Transaction ID, Payment Date, Net in INR, Conversion Rate -->
    <div class="row mb-3">
      <div class="col-md-3">
        <label
          for="transaction_id_sp"
          class="form-label"
          style="font-weight: bold;"
          >Transaction ID</label
        >
        <input
          type="text"
          class="form-control"
          id="transaction_id_sp"
          placeholder="Enter Transaction Id"
        />
      </div>
      <div class="col-md-3">
        <label
          for="payment_date_sp"
          class="form-label"
          style="font-weight: bold;"
          >Payment Date</label
        >
        <input type="date" class="form-control" id="payment_date_sp" />
      </div>
      <div class="col-md-3">
        <label for="net_in_inr_sp" class="form-label" style="font-weight: bold;"
          >Net in INR</label
        >
        <input
          type="text"
          class="form-control"
          id="net_in_inr_sp"
          placeholder="Enter Net in INR"
        />
      </div>
      <div class="col-md-3">
        <label
          for="conversion_rate_sp"
          class="form-label"
          style="font-weight: bold;"
          >Conversion Rate (AED)</label
        >
        <input
          type="text"
          class="form-control"
          id="conversion_rate_sp"
          placeholder="Enter Conversion Rate"
        />
      </div>
    </div>

    <!-- Row 2: Amount in AED, Payment Method, Important Note -->
    <div class="row mb-3">
      <div class="col-md-3">
        <label for="amount_aed_sp" class="form-label" style="font-weight: bold;"
          >Amount (AED)</label
        >
        <input type="text" class="form-control" id="amount_aed_sp" readonly />
      </div>
      <div class="col-md-3">
        <label
          for="payment_method_sp"
          class="form-label"
          style="font-weight: bold;"
          >Payment Method</label
        >
        <select class="form-select" id="payment_method_sp">
          <option selected disabled>Select</option>
          <option>Cash</option>
          <option>Cheque</option>
          <option>IMPS</option>
          <option>RTGS</option>
          <option>NEFT</option>
          <option>Dubai A/C</option>
          <option>Credit Card</option>
          <option>Amzad UPI</option>
          <option>Atul UPI</option>
          <option>Cash in Singapore</option>
          <option>Cash in Thailand</option>
        </select>
      </div>
      <div class="col-md-6 pt-4">
        <label
          for="important_note_sp"
          class="form-label"
          style="font-weight: bold;"
          >Important Note</label
        >
        <textarea
          class="form-control"
          id="important_note_sp"
          rows="3"
        ></textarea>
      </div>
    </div>

    <!-- Save & Next Button -->
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
      <button
        class="btn btn-primary"
        type="button"
        id="saveButton"
        style="font-weight: 500;"
      >
        Save & Next
      </button>
    </div>
  </form>
  <!-- Filters Section -->
  <div class="mt-5">
    <h5 class="mb-3" style="font-weight: bold;">Filter & Search Payments</h5>
    <div class="row mb-3">
      <div class="col-md-3">
        <label for="filter_start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="filter_start_date" />
      </div>
      <div class="col-md-3">
        <label for="filter_end_date" class="form-label">End Date</label>
        <input type="date" class="form-control" id="filter_end_date" />
      </div>
      <div class="col-md-6">
        <label for="search_text" class="form-label">Search</label>
        <input
          type="text"
          class="form-control"
          id="search_text"
          placeholder="Search by any field"
        />
      </div>
    </div>
  </div>

  <!-- Table to display added payments -->
  <div class="mt-5">
    <h5 class="mb-3" style="font-weight: bold;">Saved Payment Details</h5>
    <table class="table table-striped" id="paymentTable">
      <thead>
        <tr>
          <th scope="col">Transaction ID</th>
          <th scope="col">Payment Date</th>
          <th scope="col">Net in INR</th>
          <th scope="col">Conversion Rate</th>
          <th scope="col">Amount in AED</th>
          <th scope="col">Payment Method</th>
          <th scope="col">Important Note</th>
        </tr>
      </thead>
      <tbody>
        <!-- Rows will be added dynamically -->
      </tbody>
    </table>
  </div>
</div>
    </div>
          <button class="btn btn-primary" id="saveSupplierPayment">
            Save & Next
          </button>
          <button class="btn btn-secondary" id="skipSupplierPayment">
            Skip
          </button>
        </div>


 <script>
  // Automatically calculate AED amount based on INR and Conversion Rate
  document
    .getElementById("net_in_inr_sp")
    .addEventListener("input", calculateAED);
  document
    .getElementById("conversion_rate_sp")
    .addEventListener("input", calculateAED);

  function calculateAED() {
    let inr = parseFloat(document.getElementById("net_in_inr_sp").value);
    let conversionRate = parseFloat(
      document.getElementById("conversion_rate_sp").value
    );

    if (!isNaN(inr) && !isNaN(conversionRate)) {
      let aed = (inr / conversionRate).toFixed(2); // Calculate AED
      document.getElementById("amount_aed_sp").value = aed;
    } else {
      document.getElementById("amount_aed_sp").value = ""; // Clear AED if inputs are invalid
    }
  }

  // Add payment details to the table when Save & Next is clicked
  document.getElementById("saveButton").addEventListener("click", function () {
    let transactionId = document.getElementById("transaction_id_sp").value;
    let paymentDate = document.getElementById("payment_date_sp").value;
    let netInINR = document.getElementById("net_in_inr_sp").value;
    let conversionRate = document.getElementById("conversion_rate_sp").value;
    let amountAED = document.getElementById("amount_aed_sp").value;
    let paymentMethod = document.getElementById("payment_method_sp").value;
    let importantNote = document.getElementById("important_note_sp").value;

    // Check if all fields are filled before adding to the table
    if (
      transactionId &&
      paymentDate &&
      netInINR &&
      conversionRate &&
      amountAED &&
      paymentMethod !== "Select"
    ) {
      let table = document
        .getElementById("paymentTable")
        .getElementsByTagName("tbody")[0];

      // Create a new row
      let newRow = table.insertRow();

      // Insert cells and fill them with the form data
      newRow.insertCell(0).textContent = transactionId;
      newRow.insertCell(1).textContent = paymentDate;
      newRow.insertCell(2).textContent = netInINR;
      newRow.insertCell(3).textContent = conversionRate;
      newRow.insertCell(4).textContent = amountAED;
      newRow.insertCell(5).textContent = paymentMethod;
      newRow.insertCell(6).textContent = importantNote;

      // Clear the form fields after saving the entry
      document.getElementById("SupplierPaymentForm").reset();
      document.getElementById("amount_aed_sp").value = ""; // Also clear AED input
    } else {
      alert("Please fill in all the required fields!");
    }
  });

  // Date filtering and search functionality
  document
    .getElementById("filter_start_date")
    .addEventListener("change", filterTable);
  document
    .getElementById("filter_end_date")
    .addEventListener("change", filterTable);
  document.getElementById("search_text").addEventListener("input", filterTable);

  function filterTable() {
    let startDate = new Date(
      document.getElementById("filter_start_date").value
    );
    let endDate = new Date(document.getElementById("filter_end_date").value);
    let searchText = document.getElementById("search_text").value.toLowerCase();

    let table = document
      .getElementById("paymentTable")
      .getElementsByTagName("tbody")[0];
    let rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
      let cells = rows[i].getElementsByTagName("td");
      let transactionId = cells[0].textContent.toLowerCase();
      let paymentDate = new Date(cells[1].textContent);
      let netInINR = cells[2].textContent.toLowerCase();
      let conversionRate = cells[3].textContent.toLowerCase();
      let amountAED = cells[4].textContent.toLowerCase();
      let paymentMethod = cells[5].textContent.toLowerCase();
      let importantNote = cells[6].textContent.toLowerCase();

      let matchesSearch =
        transactionId.includes(searchText) ||
        netInINR.includes(searchText) ||
        conversionRate.includes(searchText) ||
        amountAED.includes(searchText) ||
        paymentMethod.includes(searchText) ||
        importantNote.includes(searchText);

      let matchesDateFilter =
        (!isNaN(startDate.getTime()) ? paymentDate >= startDate : true) &&
        (!isNaN(endDate.getTime()) ? paymentDate <= endDate : true);

      if (matchesSearch && matchesDateFilter) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  }
</script>
  <!--Supplier Ends-->


        <!-- Received Amount Tab -->
        <div class="tab-pane fade" id="received-amount" role="tabpanel">
         <div class=" table-responsive mt-4" style="overflow:auto;" >
        <div id="paymentInfo" class="content-section">
                        
                
    <form id="PaymentForm" style="padding:5px;border:5px solid lightgray">
   
    <div class="container" id="payment" style="
        padding: 20px;
        border-radius: 8px;">
      <form id="gstForm">
        <div class="row">
          <div class="col-md-3">
            <label for="refBillNo" class="label-style">REF/BILL NO:</label>
            <input type="text" id="refBillNo" class="form-control" />
          </div>
          <div class="col-md-3">
            <label for="companyName" class="label-style">Company Name:</label>
            <input type="text" id="companyName" class="form-control" />
          </div>
          <div class="col-md-3">
            <label for="services" class="label-style">Services:</label>
            <select id="services" class="form-select">
              <option value="">Select</option>
              <option value="Visa">Visa</option>
              <option value="Hotel">Hotel</option>
              <option value="Tour">Tour</option>
              <option value="Air Ticket">Air Ticket</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="cost" class="label-style">Cost:</label>
            <input type="number" id="cost" class="form-control" min="0" />
          </div>
        </div>

 <div class="row mb-3" style="display:flex; flex-direction:row; justify-content:space-around">
        <div class="col-md-2">
            <label for="total_bill_aed" class="form-label label-style" style="font-weight:700" >Total Bill(AED)</label>
            <input type="text" class="form-control" id="total_bill_aed" value="0" oninput="calculateAED()" style="width:100px; font-weight:700">
        </div>
        <div class="col-md-2">
            <label for="total_bill_inr" class="form-label label-style" style="font-weight:700">Total Bill(INR)</label>
            <input type="text" class="form-control" id="total_bill_inr" value="0" oninput="calculateAED()" style="width:100px; font-weight:700">
        </div>
        <div class="col-md-2">
            <label for="received_aed" class="form-label label-style" style="font-weight:700">Received(AED)</label>
            <input type="text" class="form-control" id="received_aed" value="0" oninput="calculateAED()" style="width:100px; font-weight:700; background-color:#76AD78;color:white">
        </div>
        <div class="col-md-2">
            <label for="received_inr" class="form-label label-style" style="font-weight:700">Received(INR)</label>
            <input type="text" class="form-control" id="received_inr" value="0" oninput="calculateAED()" style="width:100px; font-weight:700; background-color:#76AD78;color:white">
        </div>
        <div class="col-md-2">
            <label for="pending_aed" class="form-label label-style" style="font-weight:700;">Pending(AED)</label>
              <input type="text" class="form-control" id="pending_aed" value="0.00" style="width:100px; font-weight:700; background-color:#E06666;color:white">
        </div>
        <div class="col-md-2">
            <label for="pending_inr" class="form-label label-style" style="font-weight:700;">Pending(INR)</label>
            <input type="text" class="form-control" id="pending_inr" value="0.00" style="width:100px; font-weight:700; background-color:#E06666;color:white">
        </div>
    </div>
        <div class="row mt-3">
          <div class="col-md-3">
            <div class="form-check">
              <input type="checkbox" id="cgst9" class="form-check-input e" />
              <label for="cgst9" class="form-check-label label-style">CGST 9%:</label>
              <input
                type="text"
                id="cgst9Value"
                class="form-control mt-2"
                readonly
              />
            </div>
            <div class="form-check">
              <input type="checkbox" id="cgst2_5" class="form-check-input" />
              <label for="cgst2_5" class="form-check-label label-style">CGST 2.5%:</label>
              <input
                type="text"
                id="cgst2_5Value"
                class="form-control mt-2"
                readonly
              />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <input type="checkbox" id="sgst9" class="form-check-input" />
              <label for="sgst9" class="form-check-label label-style">SGST 9%:</label>
              <input
                type="text"
                id="sgst9Value"
                class="form-control mt-2"
                readonly
              />
            </div>
            <div class="form-check">
              <input type="checkbox" id="sgst2_5" class="form-check-input" />
              <label for="sgst2_5" class="form-check-label label-style">SGST 2.5%:</label>
              <input
                type="text"
                id="sgst2_5Value"
                class="form-control mt-2"
                readonly
              />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check">
              <input type="checkbox" id="igst18" class="form-check-input" />
              <label for="igst18" class="form-check-label label-style">IGST 18%:</label>
              <input
                type="text"
                id="igst18Value"
                class="form-control mt-2"
                readonly
              />
            </div>
            <div class="form-check">
              <input type="checkbox" id="igst5" class="form-check-input" />
              <label for="igst5" class="form-check-label label-style">IGST 5%:</label>
              <input
                type="text"
                id="igst5Value"
                class="form-control mt-2"
                readonly
              />
            </div>
          </div>
          <div class="col-md-3">
            <label for="serviceCharge label-style">Service Charge:</label>
            <input
              type="number"
              id="serviceCharge"
              class="form-control"
              min="0"
              style="width:80px"
            />
            <div class="form-check mt-2">
              <input
                type="radio"
                id="tcs5"
                name="tcs_tds"
                class="form-check-input"
              />
              <label for="tcs5" class="form-check-label label-style">TCS 5%:</label>
              <input
                type="text"
                id="tcs5Value"
                class="form-control mt-2"
                readonly
              />
            </div>
            <div class="form-check mt-2">
              <input
                type="radio"
                id="tds2"
                name="tcs_tds"
                class="form-check-input"
              />
              <label for="tds2" class="form-check-label label-style">TDS 2%:</label>
              <input
                type="text"
                id="tds2Value"
                class="form-control mt-2"
                readonly
              />
            </div>
          </div>
        </div>
        <div class="row mt-3">
           <div class="col-md-3">
            <label for="sale">Sale:</label>
            <input type="text" id="sale" class="form-control" readonly />
          </div> 
          <div class="col-md-3">
            <label for="grandProfit " class="label-style">Nett Profit(INR):</label>
            <input type="text" id="grandProfit" class="form-control" readonly />
          </div>

          <div class="col-md-3">
            <label for="nettProfit" class="label-style">Nett Profit (AED):</label>                                    <
            <input type="text" id="nettProfit" class="form-control" readonly />
          </div>
               <div class="col-md-3">
            <label for="grandProfit" class="label-style">Grand Total  (AED):</label>
            <input type="text" id="grandProfit" class="form-control" readonly />
          </div>
          <div class="col-md-3">
            <label for="grandTotal" class="label-style">Grand Total INR:</label>
            <input type="text" id="grandTotal" class="form-control" readonly />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-3">
            <label for="creditNote" class="label-style">Credit Note:</label>
            <input type="text" id="creditNote" class="form-control" />
          </div>
          <div class="col-md-3">
            <label for="paymentStatus" class="label-style">Payment Status:</label>
            <select id="paymentStatus" class="form-select">
              <option value="unpaid">Unpaid</option>
              <option value="paid">Paid</option>
            </select>
          </div>
        </div>


</form>
</div>
    
<!-- payment collection -->

<form id="paymentForm" class="mt-5" style=" padding:5px; border:5px solid lightgray">
         <h4 class="mb-3" style="font-weight:900">Payment Collection Details</h4>
  <hr>
    <div class="row mb-3" style="display:flex; flex-direction:row; justify-content:space-around">
        <div class="col-md-2">
            <label for="transactionid" class="form-label" style="font-weight:700">Transaction Id</label>
            <input type="text" class="form-control" id="transactionid" style="width:150px;font-weight:700" required>
        </div>
        <div class="col-md-2">
            <label for="collection_date" class="form-label" style="font-weight:700">Collection Date</label>
            <input type="date" class="form-control" id="collection_date" style="width:150px;font-weight:700" required>
        </div>
        <div class="col-md-2">
            <label for="net_in_inr" class="form-label" style="font-weight:700">Net In INR</label>
            <input type="number" class="form-control" id="net_in_inr" style="width:100px;font-weight:700" required oninput="calculateAED()">
        </div>
        <div class="col-md-2">
            <label for="conversion_rate" class="form-label" style="font-weight:700; text-wrap:nowrap">Conversion Rate (AED)</label>
            <input type="number" class="form-control" id="conversion_rate" style="width:100px;font-weight:700" required oninput="calculateAED()">
        </div>
        <div class="col-md-3">
            <label for="amount_aed" class="form-label" style="font-weight:700">Amount (AED)</label>
            <input type="number" class="form-control" id="amount_aed" style="width:100px;font-weight:700">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-2">
            <label for="payment_method" class="form-label" style="font-weight:700">Payment Method</label>
            <select class="form-select" id="payment_method" required>
                <option selected>Select</option>
                <option>Cash in Hand</option>
                <option>CDM ICICI</option>
                <option>CDM HDFC</option>
                <option>Cheque ICICI</option>
                <option>Cheque HDFC</option>
                <option>IMPS ICICI</option>
                <option>RTGS ICICI</option>
                <option>RTGS HDFC</option>
                <option>NEFT ICICI</option>
                <option>NEFT HDFC</option>
                <option>Dubai A/C</option>
                <option>Cash in Dubai</option>
                <option>Cash in Singapore</option>
                <option>Cash in Thailand</option>
                <option>Amzad UPI</option>
                <option>Atul UPI</option>
            </select>
        </div>
        <div class="col-md-8">
            <label for="important_note" class="form-label" style="font-weight:700">Important Note</label>
            <textarea class="form-control" id="important_note"></textarea>
        </div>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
        <button class="btn btn-primary" type="submit" style="font-weight: 500; background-color:green">Save Payment</button>
    </div>    
</form>
       
                            


        </div>
       
 
  <button class="btn btn-primary" id="saveReceivedAmount">
            Save & Next
          </button>
          <button class="btn btn-secondary" id="skipReceivedAmount">
            Skip
          </button>
        </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // Counter for table row numbering
    let paymentCounter = 1;

    // Handle form submission
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Get all the form values
        const transactionId = document.getElementById('transactionid').value.trim();
        const collectionDate = document.getElementById('collection_date').value;
        const netInInr = document.getElementById('net_in_inr').value;
        const amountAed = document.getElementById('amount_aed').value;
        const paymentMethod = document.getElementById('payment_method').value;
        const importantNote = document.getElementById('important_note').value.trim();

        // Validate that the user has selected a payment method
        if (paymentMethod === 'Select' || !transactionId || !collectionDate || !netInInr || !amountAed) {
            alert('Please fill in all required fields.');
            return;
        }

        // Create a new row in the table with the form values
        const tableBody = document.querySelector('#paymentTable tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${paymentCounter++}</td>
            <td>${collectionDate}</td>
            <td>${paymentMethod}</td>
            <td>${transactionId}</td>
            <td>${netInInr}</td>
            <td>${amountAed}</td>
            <td>${importantNote}</td>
        `;

        // Append the new row to the table
        tableBody.appendChild(newRow);

        // Clear the form after saving
        document.getElementById('paymentForm').reset();
        document.getElementById('amount_aed').value = '';  // Clear the AED value
    });

    // Function to calculate AED based on INR and conversion rate
   
  
  
  </script>
  
   <script>

function calculateAED() {
   const netInInr = parseFloat(document.getElementById("net_in_inr").value) || 0;
    const conversionRate = parseFloat(document.getElementById("conversion_rate").value) || 1;

    // Check if both fields have values
    if (netInInr && conversionRate) {
        const amountInAed = netInInr / conversionRate;
        
        // Update Amount in AED
        document.getElementById("amount_aed").value = amountInAed.toFixed(2); // Limit to 2 decimal places

        // Update the received AED and INR fields automatically
        document.getElementById("received_aed").value = amountInAed.toFixed(2);
        document.getElementById("received_inr").value = netInInr.toFixed(2);
    }

    // Fetch total bill AED and received AED values
    const totalBillAED = parseFloat(document.getElementById('total_bill_aed').value) || 0;
    const receivedAED = parseFloat(document.getElementById('received_aed').value) || 0;

    // Calculate Total Bill INR using the conversion rate of 3.65
    const totalBillINR = totalBillAED * 23;

    // Update the Total Bill INR field
    document.getElementById('total_bill_inr').value = totalBillINR.toFixed(2);

    // Fetch received INR value (it is already updated automatically)
    const receivedINR = parseFloat(document.getElementById('received_inr').value) || 0;

    // Calculate pending amounts for AED and INR
    const pendingAED = totalBillAED - receivedAED;
    const pendingINR = totalBillINR - receivedINR;

    // Update pending amounts in the corresponding fields
    document.getElementById('pending_aed').value = pendingAED.toFixed(2);
    document.getElementById('pending_inr').value = pendingINR.toFixed(2);
}
  </script>

  
  <script>
               // all gst and Service charges 

      document.addEventListener("DOMContentLoaded", function () {
        const igst18Checkbox = document.getElementById("igst18");
        const igst5Checkbox = document.getElementById("igst5");
        const cgst9Checkbox = document.getElementById("cgst9");
        const sgst9Checkbox = document.getElementById("sgst9");
        const cgst2_5Checkbox = document.getElementById("cgst2_5");
        const sgst2_5Checkbox = document.getElementById("sgst2_5");
        const costInput = document.getElementById("cost");
        const serviceChargeInput = document.getElementById("serviceCharge");
        const saleInput = document.getElementById("sale");
        const grandTotalInput = document.getElementById("grandTotal");
        const nettProfitInput = document.getElementById("nettProfit");
        const grandProfitInput = document.getElementById("grandProfit");
        const tcs5Checkbox = document.getElementById("tcs5");
        const tds2Checkbox = document.getElementById("tds2");

        function disableAllExcept(checkbox) {
          const checkboxes = [
            igst18Checkbox,
            igst5Checkbox,
            cgst9Checkbox,
            sgst9Checkbox,
            cgst2_5Checkbox,
            sgst2_5Checkbox,
          ];
          checkboxes.forEach((cb) => {
            if (cb !== checkbox) {
              cb.checked = false;
              cb.disabled = checkbox.checked;
            }
          });
        }

        function calculateGST() {
          var igst = 0,
              cgst = 0,
              sgst = 0;
          let cost = parseFloat(costInput.value) || 0;
          let serviceCharge = parseFloat(serviceChargeInput.value) || 0;
          serviceCharge = serviceCharge * 0.8474;

          let sale = cost + serviceCharge + igst + cgst + sgst;

          if (igst18Checkbox.checked) {                         
            igst = serviceCharge * 0.18;
            document.getElementById("igst18Value").value = igst.toFixed(2);     
          } else {
            document.getElementById("igst18Value").value = 0;
          }

          if (igst5Checkbox.checked) {
            igst = sale * 0.05;
            document.getElementById("igst5Value").value = igst.toFixed(2);
          } else {
            document.getElementById("igst5Value").value = 0;
          }

          if (cgst9Checkbox.checked || sgst9Checkbox.checked) {
            cgst = serviceCharge * 0.09;
            sgst = serviceCharge * 0.09;
            document.getElementById("cgst9Value").value = cgst.toFixed(2);
            document.getElementById("sgst9Value").value = sgst.toFixed(2);
            cgst9Checkbox.checked = true;
            sgst9Checkbox.checked = true;
          } else {
            document.getElementById("cgst9Value").value = 0;
            document.getElementById("sgst9Value").value = 0;
          }

          if (cgst2_5Checkbox.checked || sgst2_5Checkbox.checked) {
            cgst = sale * 0.025;
            sgst = sale * 0.025;
            document.getElementById("cgst2_5Value").value = cgst.toFixed(2);
            document.getElementById("sgst2_5Value").value = sgst.toFixed(2);
            cgst2_5Checkbox.checked = true;
            sgst2_5Checkbox.checked = true;
          } else {
            document.getElementById("cgst2_5Value").value = "";
            document.getElementById("sgst2_5Value").value = "";
          }

          // calculate tcs and tds...........

          let tcs = 0;
          let tds = 0;

          if (tcs5Checkbox.checked) {
            tcs = sale * 0.05;

            document.getElementById("tcs5Value").value = tcs.toFixed(2);

            // tcs5Checkbox.checked = true;
            // tds2Checkbox.checked = true;
          } else {
            document.getElementById("tcs5Value").value = "";
          }

          if (tds2Checkbox.checked) {
            tds = sale * 0.02;
            document.getElementById("tds2Value").value = tds.toFixed(2);
          } else {
            document.getElementById("tds2Value").value = "";
          }

          // tcs and tds  ends ..............

          let grandTotal = sale + igst + cgst + sgst + tcs + tds;

          // let grandProfit = nettProfit - (cost + serviceCharge);
          let grandProfit = sale - cost;
          let nettProfit = grandProfit - (igst + cgst + sgst + tcs + tds);
          // sale = igst + cgst + sgst + tcs + tds;

          saleInput.value = sale.toFixed(2);
          grandTotalInput.value = grandTotal.toFixed(2);
          nettProfitInput.value = nettProfit.toFixed(2);
          grandProfitInput.value = grandProfit.toFixed(2);
        }

        igst18Checkbox.addEventListener("change", function () {
          disableAllExcept(igst18Checkbox);
          calculateGST();
        });

        igst5Checkbox.addEventListener("change", function () {
          disableAllExcept(igst5Checkbox);
          calculateGST();
        });

        cgst9Checkbox.addEventListener("change", function () {
          disableAllExcept(cgst9Checkbox);
          sgst9Checkbox.checked = cgst9Checkbox.checked; // Sync CGST 9% and SGST 9%
          calculateGST();
        });

        sgst9Checkbox.addEventListener("change", function () {
          disableAllExcept(sgst9Checkbox);
          cgst9Checkbox.checked = sgst9Checkbox.checked; // Sync SGST 9% and CGST 9%
          calculateGST();
        });

        cgst2_5Checkbox.addEventListener("change", function () {
          disableAllExcept(cgst2_5Checkbox);
          sgst2_5Checkbox.checked = cgst2_5Checkbox.checked; // Sync CGST 2.5% and SGST 2.5%
          calculateGST();
        });

        sgst2_5Checkbox.addEventListener("change", function () {
          disableAllExcept(sgst2_5Checkbox);
          cgst2_5Checkbox.checked = sgst2_5Checkbox.checked; // Sync SGST 2.5% and CGST 2.5%
          calculateGST();
        });

        costInput.addEventListener("input", calculateGST);
        serviceChargeInput.addEventListener("input", calculateGST);
        tcs5Checkbox.addEventListener("change", calculateGST);
        tds2Checkbox.addEventListener("change", calculateGST);
      });
    </script>

  <script>

    
    //Recieved tab  dynamic 
    function updateForm() {
    // Get values from inputs
    const totalBillAED = parseFloat(document.getElementById('total_bill_aed').value) || 0;
    const totalBillINR = parseFloat(document.getElementById('total_bill_inr').value) || 0
    const receivedAED = parseFloat(document.getElementById('received_aed').value) || 0;
    const receivedINR = parseFloat(document.getElementById('received_inr').value) || 0;
    const gstAED = parseFloat(document.getElementById('gst_aed').value) || 0;
    const gstINR = parseFloat(document.getElementById('gst_inr').value) || 0;
    const vatAED = parseFloat(document.getElementById('vat_aed').value) || 0;
    const vatINR = parseFloat(document.getElementById('vat_inr').value) || 0;
    const serviceChargeAED = parseFloat(document.getElementById('service_charge_aed').value) || 0;
    const serviceChargeINR = parseFloat(document.getElementById('service_charge_inr').value) || 0;

    // Calculate pending amounts
    const pendingAED = totalBillAED - receivedAED;
    const pendingINR = totalBillINR - receivedINR;

    document.getElementById('pending_aed').value = pendingAED.toFixed(2);
    document.getElementById('pending_inr').value = pendingINR.toFixed(2);

    // Calculate gross profit and grand total (simple calculation for example)
    const grossProfitAED = (totalBillAED + serviceChargeAED) * (1 + (gstAED + vatAED) / 100);
    const grossProfitINR = (totalBillINR + serviceChargeINR) * (1 + (gstINR + vatINR) / 100);
    
    document.getElementById('gross_profit_aed').value = grossProfitAED.toFixed(2);
    document.getElementById('gross_profit_inr').value = grossProfitINR.toFixed(2);

    document.getElementById('grand_total_aed').value = (grossProfitAED).toFixed(2);
    document.getElementById('grand_total_inr').value = (grossProfitINR).toFixed(2);
}
</script>
 <scrip src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



        
<!--Received Amount Form end-->

        


        <!--Recieved tab Ends->

        <!-- Invoice Tab -->
           <!-- TinyMCE Script -->
<style>
  .desgin{
    font-Size:20px;
    font-familly:'poppins';
    
  }
</style>
<div class="tab-pane fade" id="invoice" role="tabpanel">

<div id="invoiceInfo" class="content-section">
    <div class="row">
        <!-- Description Section (left side) -->
        <div class="col-lg-6 py-4">
            <div class="card">
                <div class="card-body">
                   
                    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                   
                    <!-- TinyMCE Editor -->
                       <form action="#" id="invoiceForm" style="border:10px #f2f2f2">
    <div class="mb-3">
        <label style="font-size:24px; font-weight:700;background-color:#f2f2f2; width:100%; padding:18px">Description</label>
        <!-- Replace textarea with a div that Quill will target -->
        
        <textarea id="description" name="description" class="form-control  desgin" style="height: 150px;"></textarea>
    </div>
</form>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill Editor -->
<script>
    var quill = new Quill('#description', {
        theme: 'snow'  // 'snow' is a simple Quill theme
    });
</script>
                    <!-- End TinyMCE Editor -->

                </div>
            </div>
        </div>

        <!-- Table Section (right side) -->
        <div class="col-lg-6">
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="booking_invoice">
                    <thead>
                        <tr id="countUnits">
                            <th class="col-md-2">Traveller</th>
                            <th class="col-md-2">Units</th>
                            <th class="col-md-2" style="white-space:nowrap;">Final Rate (INR)</th>
                            <th class="col-md-2" style="white-space:nowrap;">Total Amount (INR)</th>
                            <th class="text-center">
                                <button class="btn btn-success btn-sm" id="addRowBtn-4">Add</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                  <select class="form-select" id="travellerType" style="width:120px">
                                    <option selected disabled>Select</option>
                                    <option>Adult</option>
                                    <option>Child</option>
                                    <option>Infant</option>
                                    <option>Pax</option>
                                </select>
                            </td>
                            <td><input type="number" class="form-control" id="units" oninput="calculateTotal()" / style="width:100px"></td>
                        <td><input type="number" class="form-control" id="finalRate" oninput="calculateTotal()" / style="width:100px"></td>
                        <td><input type="number" class="form-control" id="totalAmount" readonly / style="width:100px"></td>
                            <td>
                                <button class="btn btn-sm btn-danger deleteRowBtn-4">x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Invoice Summary Section -->
    <div class="row mt-4 p-2 m-0 mb-5">
        <!-- Total -->
           <div class="col-md-2">
            <label for="total" class="form-label" style="font-weight: bold;">Total</label>
            <input type="text" id="total" class="form-control" value="0" style="width:80px" readonly />
        </div>
        <!-- Service Charge -->
         <div class="col-md-2">
            <label for="serviceCharge" class="form-label" style="font-weight: bold;">Service Charge</label>
            <input type="text" id="serviceCharge" class="form-control" value="0" style="width:70px" oninput="calculateTotal()" />
        </div>
        
        <!-- GST Type Selection -->
        <div class="col-md-3">
            <label class="form-label">GST Type</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gstType" id="igst" checked>
                    <label class="form-check-label" for="igst" style="font-weight: bold;">IGST</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gstType" id="cgstSgst">
                    <label class="form-check-label" for="cgstSgst" style="font-weight: bold;">CGST & SGST</label>
                </div>
            </div>  

            <div>
                <div class="form-check form-check-inline mt-4">
                    <input class="form-check-input" type="radio" name="gstType" id="tcs" checked>
                    <label class="form-check-label" for="tcs" style="font-weight: bold;">TCS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gstType" id="tds">
                    <label class="form-check-label" for="tds" style="font-weight: bold;">TDS</label>
                </div>
            </div>
        </div>

        

        <!-- GST Section -->
        <div class="col-md-2">
    <label for="gst" class="form-label" style="font-weight: bold;">GST (%)</label>
    <select id="gst" class="form-control" style="width: 100px;" onchange="calculateTotal()">
        <option value="5">5%</option>
        <option value="18">9%+9%</option>
        <option value="18" selected>18%</option>
    </select>
</div>
        <div class="col-md-2">
            <label for="gstAmount" class="form-label">GST</label>
            <input type="text" id="gstAmount" class="form-control" style="width:70px" readonly />
        </div>

        <!-- TCS/TDS Section Below GST -->
      
<div class="col-md-2">
    <label for="tcsTds" class="form-label">TCS/TDS%</label>
    <select id="tcsTds" class="form-control" style="width:70px" onchange="calculateTotal()">
        <option value="2">2%</option>
        <option value="5">5%</option>
    </select>
</div>
        <div class="col-md-2">
            <label for="tcsTds_amount" class="form-label">TCS/TDS</label>
            <input type="text" id="tcsTds_amount" class="form-control" style="width:70px" readonly />
          </div>



        <!-- Grand Total -->
        <div class="col-md-2">
            <label for="grandTotal" class="form-label">Grand Total</label>
            <input type="number" id="grandTotal" class="form-control" readonly style="width:80px" />
        </div>

        <!-- Save Button -->
        <div class="col-md-4 mt-5 " style="text-align:end;">
            <button class="btn btn-primary" onclick="generateInvoice()">Generate Invoice</button>
           
        </div>
    </div>
</div>
 <!-- Invoice Output Section (Hidden initially) -->

    <!-- new code starts here -->
  

 `<div id="invoiceOutput" style="margin-top:20px;display:none" >
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="top">
          <table width="720" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td style="border: #663366 2px solid; padding: 1px;">
                <table
                  width="100%"
                  border="0"
                  align="center"
                  cellpadding="0"
                  cellspacing="0"
                >
                  <tr>
                    <td>
                      <table
                        width="100%"
                        border="0"
                        align="center"
                        cellpadding="1"
                        cellspacing="0"
                      >
                        <tr>
                          <td align="center">
                            <h3 style="font-weight:900">
                              <span style="position: absolute;">PERFORMA INVOICE</span>
                            </h3>
                          </td>
                          <td style="text-align: right !important;">
                            <img
                              src="http://oasistraveller.com/images/oasis.png"
                              style="width: 300px; height: 60px;"
                            /><br />
                            <b> GSTIN:09AAGFO2795N1ZH</b>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <table
                        width="100%"
                        border="1"
                        cellspacing="0"
                        cellpadding="0"
                        style="
                          border-left: 1px !important;
                          border-right: 1px !important;
                        "
                      >
                        <tr
                          style="
                           background-color:#276fae !important; font-weight: 700;
                           color:whitesmoke !important; 
                          "
                        >
                          <td
                            colspan="2"
                            style="text-align: center; background-color:#276fae !important;;
                           color:whitesmoke !important;  "
                          >
                            <h4 style="font-weight:700">
                              Travel Partner (Agent) & Customer Information
                            </h4>
                          </td>
                        </tr>
                        <tr>
                          <td
                            width="41%"
                            style="text-align: left;"
                            valign="bottom"
                          >           
                          <b>Invoice No</b>
                           
                            <div>
                              <b>
                              <p id="invoiceNumber"></p>
                              </b>
                               <hr>
                            </div>
                           
                          </td>
                          <td
                            width="59%"
                            style="text-align: right;"
                            valign="bottom"
                          >
                          <b>  Invoice Date</b>
                          
                            <div>
                              <b>
                                <p id="dateTime"></p>
                              </b>
                               <hr>
                            </div>
                           
                          </td>
                          
                        </tr>
                        <tr>
                          <td
                            width="50%"
                            style="text-align: left;"
                            valign="top"
                          >
                            <table
                              
                              width="100%"
                              style="font-weight: bold;
                              line-height:1;
                              padding:0;
                              margin-top:0;
                              background-color:white !important"
                            >
                              <tr>
                                <td width="30%">Booking Ref No</td>
                                <td width="3%">:</td>
                                <td width="67%"></td>
                              </tr>
                              <tr>
                                <td>Company Name</td>
                                <td>:</td>
                                <td>xyz Travellers</td>
                              </tr>
                              <tr>
                                <td>Contact Person</td>
                                <td>:</td>
                                <td>Mr. Amit Chaurasia</td>
                              </tr>

                              <tr>
                                <td>Phone No</td>
                                <td>:</td>
                                <td>9925050010</td>
                              </tr>
                              <tr>
                                <td>GSTIN</td>
                                <td>:</td>
                                <td>GT761287</td>
                              </tr>
                            </table>
                          </td>
                          <td
                            width="50%"
                            style="text-align: left;"
                            valign="top"
                          >
                            <table
                              border="0"
                              width="100%"
                              style="font-weight: bold;
                              background-color:white !important"
                            >
                              <tr style="background-color:white !important"">
                                <td width="30%">Traveller Name</td>
                                <td width="5%">:</td>
                                <td width="65%">
                                  Gunjankumar Nikunjkumar Patel
                                </td>
                              </tr>
                              <tr style="background-color:white !important"">
                                <td>Hotel Name</td>
                                <td>:</td>
                                <td></td>
                              </tr>
                              <tr style="background-color:white !important"">
                                <td>Traveller Count</td>
                                <td>:</td>
                                <td>1</td>
                              </tr>
                              <tr>
                                <td style="background-color:white !important"">Traveller Date</td>
                                <td>:</td>
                                <td></td>
                              </tr>
                              <tr style="background-color:white !important"">
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <table
                        border="1"
                        width="100%"
                        cellpadding="5"
                        cellspacing="0"
                        style="
                          border-left: 0px !important;
                          border-right: 0px !important;
                          border-top: 0px !important;
                          border-bottom: 0px !important;



                        "
                      >
                        <thead>
                          <tr style="background:#276fae; color:whitesmoke; font-weight:700">
                            <th>
                              Description
                            </th>
                            <th>
                              Traveller
                            </th>
                            <th>
                              Units
                            </th>
                            <th>`
                              Final Rate
                            </th>
                            <th>
                              Total Amount
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr style="background-color:white !important"">
                            <td rowspan="1" width="50%" height="auto"  style="border-right:1px solid gray">
                              <p>
                        
                                <span id="descriptionCell" class="marker">

                                </span>
                              </p>
                            </td>
                            <td style="text-align: left; vertical-align: top; border-right:1px solid gray">
                            <span id="travellerCell"></span>
                            </td>
                            <td style="text-align: right; vertical-align: top; border-right:1px solid gray" >
                              <span id="unitsCell"></span>
                            </td>
                            <td style="text-align: right; vertical-align: top; border-right:1px solid gray">
                              <span id="rateCell"></span>
                            </td>
                            <td style="text-align: right; vertical-align: top; border-right:1px solid gray">
                              <span id="totalAmountCell"></span>
                            </td>
                          </tr>

                        
                        
                        </tbody>
                      </table>

                      <tr>
                        <td style="border: 0 !important;">
                          <table
                            width="100%"
                            border="1"
                            cellspacing="0"
                            cellpadding="0"
                            style="
                              border-left: 1px !important;
                              border-right: 1px !important;
                              border-bottom: 1px !important;
                              background-color: #ebf2f5;
                            "
                          >
                            <tr>
                              <td
                                width="75%"
                                style="
                                  text-align: center;
                                  vertical-align: middle;
                                  
                                "
                                valign="top"
                                
                              >
                                <div>
                                  <b>
                                    <h3>Thank you for your business!</h3>
                                  </b>
                                </div>
                              </td>

                              <td width="25%">
                                <div>
                                  <b>
                                    <table
                                      border="0"
                                      style="
                                        font-weight: bolder;
                                        background-color: #ebf2f5;
                                      "
                                    >
                                      <tr>
                                        <td style="text-align: left;">
                                          Bill Total 
                                        </td><td>:</td>
                                        <td id="billTotal">
                                         

                                        </td>
                                        <td style="text-align: right;">
                                          
                                        </td>
                                      </tr>

                                      <tr>
                                        <td style="text-align: left;">
                                          Service Charge
                                        </td>
                                        <td>:</td>
                                        <td style="text-align: right;">0.0</td>
                                      </tr>
                                      <tr>
                                        <td style="text-align: left;">
                                          IGST (0%)
                                        </td>
                                        <td>:</td>
                                        <td style="text-align: right;"><span>0.0</span></td>
                                      </tr>

                                      <tr>
                                        <td style="text-align: left;">
                                          Grand Total </td><td>:</td>

                                        <td id="grandTotalOutput">
                                        </td>
                                        <td style="text-align: right;">
                                          
                                        </td>
                                      </tr>
                                    </table>
                                  </b>
                                </div>
                              </td>
                            </tr>
                          </table>
                          <table
                            width="100%"
                            border="1" 
                            cellspacing=""
                            cellpadding="1"
                        
                            style="
                              border-left: 1px !important;
                              border-right: 1px !important;
                              border-bottom: 1px !important;"
                              
                          >
                            <tr>
                              <td
                                width="50%"
                                style="text-align: left;"
                                valign="top"
                              >
                                <h6
                                  class="head"
                                  style="text-align: center !important; padding:5px"
                                >
                                  ICICI BANK DETAILS - OASIS TRAVELLER
                                </h6>
                                <div style="line-height: 1; border-right:2px solid gray; background-color:white !important">
                                  Bank Name - ICICI BANK | Account Type -
                                  CURRENT ACCOUNT<br />Currency - INR| Account
                                  Name -OASIS TRAVELLER<br />Account Number -
                                  645005002895 | Branch Name - 3530
                                  |<br /> IFSC Code - ICIC0003530
                                </div>
                              </td>
                              <td
                                width="50%"
                                style="text-align: left;"
                                valign="top"
                              >
                                <h6
                                  class="head"
                                  style="text-align: center !important; padding:5px"
                                >
                                  HDFC BANK DETAILS - OASIS DMC PVT LTD
                                </h6>
                                <div style="padding:5px; line-height: 1; background-color:white !important">
                                  Bank Name - HDFC BANK | Account Type - CURRENT
                                  ACCOUNT<br />Currency - INR| Account Name
                                  -OASIS DMC PVT LTD <br />Account Number -
                                  50200057126112 | Branch Name - 2623<br />
                                  | IFSC Code - HDFC0002623
                                </div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                      <tr>
                        <td
                          class="head"
                          align="center"
                          style="border: 1px solid !important; padding:5px"
                        >
                          <strong
                            >INR Invoice is valid for same (current) date only.
                          </strong>
                        </td>
                      </tr>

                      <tr>
                        <td
                          class="head"
                          align="center"
                          style="border: 1px solid !important; padding:5px; padding-bottom:10px"
                        >
                          <strong
                            >Inconsistency, if any, must be informed to us in
                            inscription within 2 days.
                          </strong>
                        </td>
                      </tr>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
    //Invoice Tab Value Dynamic start
document.addEventListener('DOMContentLoaded', function () {
    // Handle adding new row
    document.getElementById('addRowBtn-4').addEventListener('click', function () {
        const tbody = document.querySelector('#booking_invoice tbody');
        const firstRow = tbody.querySelector('tr');
        const newRow = firstRow.cloneNode(true);

        // Clear all input fields in the cloned row
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        newRow.querySelector('select').value = '';

        // Append the new row to the table
        tbody.appendChild(newRow);
    });

    // Handle deleting rows
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('deleteRowBtn-4')) {
            const row = e.target.closest('tr');
            const rows = document.querySelectorAll('#booking_invoice tbody tr');
            if (rows.length > 1) {
                row.remove();
            }
        }
    });
});




// calculate Total starts
 function calculateTotal() {
        const units = document.getElementById('units').value;
        const rate = document.getElementById('finalRate').value;
        const totalAmount = units * rate;
        document.getElementById('totalAmount').value = totalAmount;
        document.getElementById('total').value = totalAmount;

        const total = parseFloat(document.getElementById('total').value) || 0;
        const serviceCharge = parseFloat(document.getElementById('serviceCharge').value) || 0;
        const gstPercentage = parseFloat(document.getElementById('gst').value) || 0;
        const tcsTdsPercentage = parseFloat(document.getElementById('tcsTds').value) || 0;
        const gstAmount = (total * gstPercentage) / 100;
        document.getElementById('gstAmount').value = gstAmount;
        const tcsTdsAmount = (total * tcsTdsPercentage) / 100;
        document.getElementById('tcsTds_amount').value = tcsTdsAmount;
        const grandTotal = total + serviceCharge + gstAmount + tcsTdsAmount;
        document.getElementById('grandTotal').value = grandTotal;
    }

// calculate total ends
//Invoice Tab Value Dynamic end



// Generate Invoice javascript code start 

function generateInvoice() {
    const newWindow = window.open('', '_blank');
    
    // Fetch dynamic values from input fields
    const date = document.getElementById('dateTime').textContent; // Change to textContent to get the formatted date
    const invoiceNumber = document.getElementById('invoiceNumber').textContent; // Ensure this is correct
    const description = document.getElementById('description').value;
    const travellerType = document.getElementById('travellerType').value;
    const units = document.getElementById('units').value;
    const finalRate = document.getElementById('finalRate').value;
    const totalAmount = document.getElementById('totalAmount').value;
    const billTotal = document.getElementById('total').value; // Make sure this is defined properly
    const gstAmount = document.getElementById('gstAmount').value; // Get GST amount dynamically
    const grandTotal = document.getElementById('grandTotal').value;

    newWindow.document.write(`
   <html>
    <head>
        <title>Invoice</title>
        <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
         font-family: 'Poppins', sans-serif;
            @page {
                size: A4;
                margin: 20mm;
            }
        </style>
    </head>
    <body>
        <div id="invoiceOutput" style="margin-top: 20px; backgroundColor:white;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top">
                        <table width="720" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="border: #663366 2px solid; padding: 1px;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
                                                    <tr>
                                                        <td align="center">
                                                            <h3 style="font-weight:900">
                                                                <span style="position: absolute;">PERFORMA INVOICE</span>
                                                            </h3>
                                                        </td>
                                                        <td style="text-align: right !important;">
                                                            <img src="http://oasistraveller.com/images/oasis.png" style="width: 300px; height: 60px;" />
                                                            <br />
                                                            <b> GSTIN: 09AAGFO2795N1ZH</b>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-left: 1px !important; border-right: 1px !important;">
                                                    <tr style="background-color: #276fae !important; font-weight: 700; color: whitesmoke !important;">
                                                        <td colspan="2" style="text-align: center; background-color: #276fae !important; color: whitesmoke !important;">
                                                            <h4 style="font-weight: 700;">Travel Partner (Agent) & Customer Information</h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="41%" style="text-align: left;" valign="bottom">
                                                            <b>Invoice No :</b> <strong>${invoiceNumber}</strong>
                                                            <hr />
                                                        </td>
                                                        <td width="59%" style="text-align: right;" valign="bottom">
                                                            <b>Invoice Date :</b> <strong>${date}</strong>
                                                            <hr />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <table width="100%" style="font-weight: bold; line-height: 1; padding: 0; margin-top: 0;">
                                                                <tr>
                                                                    <td width="30%">Booking Ref No</td>
                                                                    <td width="3%">:</td>
                                                                    <td width="67%">30858</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Company Name</td>
                                                                    <td>:</td>
                                                                    <td>xyz Travellers</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Contact Person</td>
                                                                    <td>:</td>
                                                                    <td>Mr. Amit Chaurasia</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Phone No</td>
                                                                    <td>:</td>
                                                                    <td>9925050010</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>GSTIN</td>
                                                                    <td>:</td>
                                                                    <td>GT761287</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <table border="0" width="100%" style="font-weight: bold;">
                                                                <tr style="background-color: white !important">
                                                                    <td width="30%">Traveller Name</td>
                                                                    <td width="5%">:</td>
                                                                    <td width="65%">Gunjankumar Nikunjkumar Patel</td>
                                                                </tr>
                                                                <tr style="background-color: white !important">
                                                                    <td>Hotel Name</td>
                                                                    <td>:</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Traveller Count</td>
                                                                    <td>:</td>
                                                                    <td>1</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Traveller Date</td>
                                                                    <td>:</td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="1" width="100%" cellpadding="5" cellspacing="0" style="border-left: 0px !important; border-right: 0px !important; border-top: 0px !important; border-bottom: 0px !important;">
                                                    <thead>
                                                        <tr style="background: #276fae; color: whitesmoke; font-weight: 700;">
                                                            <th>Description</th>
                                                            <th>Traveller</th>
                                                            <th>Units</th>
                                                            <th>Final Rate</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background-color: white !important">
                                                            <td rowspan="1" width="50%" height="auto" style="border-right: 1px solid gray;">
                                                                <p>${description}</p>
                                                            </td>
                                                            <td style="text-align: left; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${travellerType}</span>
                                                            </td>
                                                            <td style="text-align: right; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${units}</span>
                                                            </td>
                                                            <td style="text-align: right; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${finalRate}</span>
                                                            </td>
                                                            <td style="text-align: right; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${totalAmount}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0 !important;">
                                                <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-left: 1px !important; border-right: 1px !important; border-bottom: 1px !important; background-color: #ebf2f5;">
                                                    <tr>
                                                        <td width="75%" style="text-align: center; vertical-align: middle;" valign="top">
                                                            <div>
                                                                <b>
                                                                    <h3>Thank you for your business!</h3>
                                                                </b>
                                                            </div>
                                                        </td>
                                                        <td width="25%">
                                                            <div>
                                                                <b>
                                                                    <table border="0" style="font-weight: bolder; background-color: #ebf2f5;">
                                                                        <tr>
                                                                            <td style="text-align: left;">Bill Total </td>
                                                                            <td>:</td>
                                                                            <td>${billTotal}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left;">Service Charge</td>
                                                                            <td>:</td>
                                                                            <td style="text-align: right;">0.0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left;">IGST (0%)</td>
                                                                            <td>:</td>
                                                                            <td style="text-align: right;">${gstAmount}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left;">Grand Total</td>
                                                                            <td>:</td>
                                                                            <td style="text-align: right;">${grandTotal}</td>
                                                                        </tr>
                                                                    </table>
                                                                </b>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-left: 1px !important; border-right: 1px !important; border-bottom: 1px !important;">
                                                    <tr>
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <h4 class="head" style="text-align: center !important; background:#276fae; color:whitesmoke; padding:7px">ICICI BANK DETAILS - OASIS TRAVELLER</h4>
                                                           
                                                            <div style="ml-2">
                                                                Bank Name - ICICI BANK | Account Type - CURRENT ACCOUNT<br />
                                                                Currency - INR | Account Name - OASIS TRAVELLER<br />
                                                                Account Number - 645005002895 | Branch Name - 3530<br />
                                                                IFSC Code - ICIC0003530
                                                            </div>
                                                        </td>
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <h4 class="head" style="text-align: center !important; background:#276fae; color:whitesmoke; padding:6px">HDFC BANK DETAILS - OASIS DMC PVT LTD</h4>
                                                          
                                                            <div style="ml-2">
                                                                Bank Name - HDFC BANK | Account Type - CURRENT ACCOUNT<br />
                                                                Currency - INR | Account Name - OASIS DMC PVT LTD<br />
                                                                Account Number - 50200057126112 | Branch Name - 2623<br />
                                                                IFSC Code - HDFC0002623
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="head" align="center" style="border: 1px solid !important;  background:#276fae; color:whitesmoke; padding:7px">
                                                <strong>INR Invoice is valid for same (current) date only.</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="head" align="center" style="border: 1px solid !important;  background:#276fae; color:whitesmoke; padding:7px">
                                                <strong>Inconsistency, if any, must be informed to us in inscription within 2 days.</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>

    `);

    newWindow.document.close();
    newWindow.focus();
    newWindow.print();
}




// invoiceNumber Dynamic Showing script code


 let invoiceCounter = 3; // Example starting number. This can be stored and incremented dynamically.

        function generateInvoiceNumber() {
            const prefix = "OT"; // Fixed prefix
            const now = new Date();

            // Get date parts
            let day = now.getDate();
            let month = now.getMonth() + 1; // Months are zero-indexed
            const year = now.getFullYear();

            // Get seconds part
            let seconds = now.getSeconds();

            // Format day, month, and seconds with leading zeros
            day = day < 10 ? '0' + day : day;
            month = month < 10 ? '0' + month : month;
            seconds = seconds < 10 ? '0' + seconds : seconds; // Add leading zero to seconds if needed

            // Combine to form the date part as ddmmyyyy
            const datePart = `${day}${month}${year}`;

            // Increment and format the invoice counter with leading zeros
            const formattedCounter = invoiceCounter.toString().padStart(4, '0');

            // Combine prefix, date, counter, and seconds
            const invoiceNumber = `${prefix}${datePart}${formattedCounter}${seconds}`;

            // Display the invoice number in the HTML
            document.getElementById('invoiceNumber').textContent = invoiceNumber;

            // Increment the invoiceCounter for the next invoice (this would usually be stored somewhere persistently)
            invoiceCounter++;
        }

        // Call the function to generate the invoice number when the page loads
        generateInvoiceNumber();

    

 function formatDateTime() {
    const now = new Date();

    // Get date parts
    let day = now.getDate();
    let month = now.getMonth() + 1; // Months are zero-indexed
    const year = now.getFullYear();

    // Get time parts
    let hours = now.getHours();
    let minutes = now.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';

    // Convert 24-hour format to 12-hour format
    hours = hours % 12;
    hours = hours ? hours : 12; // hour '0' should be '12'

    // Format minutes with leading zero
    minutes = minutes < 10 ? '0' + minutes : minutes;

    // Format day and month with leading zeros
    day = day < 10 ? '0' + day : day;
    month = month < 10 ? '0' + month : month;

    // Format the date as "dd-mm-yyyy" and time as "HH:MM AM/PM"
    const formattedDateTime = `${day}-${month}-${year} ${hours}:${minutes} ${ampm}`;

    // Display the formatted date and time in the HTML
    document.getElementById('dateTime').textContent = formattedDateTime;
}

// Call the function to display the date and time when the page loads
formatDateTime();



// Generate Invoice javascript code ends
</script>





       <!-- invoice section ends -->



        <!-- Payment History Tab -->
        <div class="tab-pane fade" id="payment-history" role="tabpanel">
          <div class="tab-content" id="myTabContent">

          <div class="card">
            <div class="card-body">

             <div  id="recieved_statement" style="margin-top: 20px;" >
               <h4 style="color: black;">Saved Payment Details</h4>
   
              <!-- Table with stripped rows -->
        
    <table id="paymentTable" class="table datatable " style="width:100%;">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Payment Method</th>
                <th>Transaction ID</th>
                <th>Amount (INR)</th>
                <th>Amount (AED)</th>
                <th>Important Note</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be dynamically added here -->
        </tbody>
    </table>
</div>

 </div>
              <!-- End Table with stripped rows -->
  
        </div>
          <button class="btn btn-primary" id="savePaymentHistory">
           HOME
          </button>
          <button class="btn btn-secondary" id="skipPaymentHistory">
            Skip
          </button>
       
      </div>
    </div>

    </main>




    <!-- javasvript for Next step and skip steps  starts  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function goToNextTab() {
        let currentTab = document.querySelector(".nav-tabs .active");
        let nextTab = currentTab.parentElement.nextElementSibling;

        if (nextTab) {
          let nextLink = nextTab.querySelector("a");
          nextLink.click();
        }
      }

      // Save & Next functionality
      document
        .getElementById("saveBooking")
        .addEventListener("click", function () {
          // Add your save logic here if necessary
          alert("Booking Info saved!");
          goToNextTab();
        });

      // document
      //   .getElementById("saveHotel")
      //   .addEventListener("click", function () {
      //     alert("Hotel information saved!");
      //     goToNextTab();
      //   });

    //   document
    //     .getElementById("saveTours")
    //     .addEventListener("click", function () {
    //       alert("Tours saved!");
    //       goToNextTab();
    //     });

      document
        .getElementById("saveVisa")
        .addEventListener("click", function () {
          alert("Visa information saved!");
          goToNextTab();
        });

      document
        .getElementById("saveAirTicket")
        .addEventListener("click", function () {
          alert("Air Ticket saved!");
          goToNextTab();
        });

      document
        .getElementById("saveInvoice")
        .addEventListener("click", function () {
          alert("Invoice generated!");
          // You may want to handle final saving logic here.
        });

      document
        .getElementById("saveSupplierPayment")
        .addEventListener("click", function () {
          alert("Supplier Payment saved!");
          goToNextTab();
        });

      document
        .getElementById("saveReceivedAmount")
        .addEventListener("click", function () {
          alert("Received Amount saved!");
          goToNextTab();
        });

      document
        .getElementById("savePaymentHistory")
        .addEventListener("click", function () {
          alert("Payment History saved!");
          // You may want to handle final saving logic here.
        });

      // Skip functionality
      document
        .getElementById("skipBooking")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipHotel")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipTours")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipVisa")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipAirTicket")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipInvoice")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipSupplierPayment")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipReceivedAmount")
        .addEventListener("click", function () {
          goToNextTab();
        });

      document
        .getElementById("skipPaymentHistory")
        .addEventListener("click", function () {
          goToNextTab();
        });
    </script>

<!-- javasvript for Next step and skip steps  ends -->





  </body>
</html>

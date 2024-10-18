    <?php
    // Handle form submission on POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
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

        // Database connection
        $servername = "localhost"; // Update with your DB server info
        $username = "root";        // Update with your DB username
        $password = "";            // Update with your DB password
        $dbname = "generate_bill"; // Update with your DB name

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            echo 'Connection failed: ' . $conn->connect_error;
            exit;
        }

        // Prepare SQL statement to insert data
        $sql = "INSERT INTO bookings (referenceNumber, companyName, agentName, address, country, city, contact, sold_by, gstin_no, guest_name, destination_country, destination_city, hotel_name, hotel_address, hotel_contact_no, room_no, whatsapp_no, emergency_no, adults, children, infants)
                VALUES ('$referenceNumber', '$companyName', '$agentName', '$address', '$country', '$city', '$contact', '$sold_by', '$gstin_no', '$guest_name', '$destination_country', '$destination_city', '$hotel_name', '$hotel_address', '$hotel_contact_no', '$room_no', '$whatsapp_no', '$emergency_no', '$adults', '$children', '$infants')";

        if ($conn->query($sql) === TRUE) {
            echo 'success'; // Only outputs 'success' if the query is successful
        } else {
            echo 'SQL Error: ' . $conn->error; // Outputs the SQL error for debugging
        }

        $conn->close();
        exit; // Ensure to exit after processing POST
    }
    ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Booking Form -->
    <div class="container mt-5">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="booking-info" role="tabpanel">
                <form id="bookingForm" method="POST">
                    <h5 class="mb-3 p-3" style="font-weight: bold;">Agent Information</h5>
                    <hr>

                    <div class="row mb-3 px-3">
                        <div class="col-md-3">
                            <label for="referenceNumber" class="form-label" style="font-weight: bold;">Reference Number</label>
                            <input type="text" class="form-control" id="referenceNumber" name="referenceNumber" placeholder="Enter Reference" required>
                        </div>
                        <div class="col-md-3">
                            <label for="companyName" class="form-label" style="font-weight: bold;">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company Name" required>
                        </div>
                        <div class="col-md-3">
                            <label for="agentName" class="form-label" style="font-weight: bold;">Agent Name</label>
                            <input type="text" class="form-control" id="agentName" name="agentName" placeholder="Enter Agent Name" required>
                        </div>
                        <div class="col-md-3">
                            <label for="address" class="form-label" style="font-weight: bold;">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                        </div>
                    </div>

                    <div class="row mb-3 px-3">
                        <div class="col-md-3">
                            <label for="country" class="form-label" style="font-weight: bold;">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" required>
                        </div>
                        <div class="col-md-3">
                            <label for="city" class="form-label" style="font-weight: bold;">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                        </div>
                        <div class="col-md-3">
                            <label for="contact" class="form-label" style="font-weight: bold;">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact" required>
                        </div>
                        <div class="col-md-3">
                            <label for="sold_by" class="form-label" style="font-weight: bold;">Sold By</label>
                            <input type="text" class="form-control" id="sold_by" name="sold_by" placeholder="Enter Sold By" required>
                        </div>
                    </div>

                    <div class="row mb-3 px-3">
                        <div class="col-md-3">
                            <label for="gstin_no" class="form-label" style="font-weight: bold;">GSTIN No.</label>
                            <input type="text" class="form-control" id="gstin_no" name="gstin_no" placeholder="Enter GSTIN No." required>
                        </div>
                        <div class="col-md-3">
                            <label for="guest_name" class="form-label" style="font-weight: bold;">Guest Name</label>
                            <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="Enter Guest Name" required>
                        </div>
                        <div class="col-md-3">
                            <label for="destination_country" class="form-label" style="font-weight: bold;">Destination Country</label>
                            <input type="text" class="form-control" id="destination_country" name="destination_country" placeholder="Enter Destination Country" required>
                        </div>
                        <div class="col-md-3">
                            <label for="destination_city" class="form-label" style="font-weight: bold;">Destination City</label>
                            <input type="text" class="form-control" id="destination_city" name="destination_city" placeholder="Enter Destination City" required>
                        </div>
                    </div>

                    <div class="row mb-3 px-3">
                        <div class="col-md-3">
                            <label for="hotel_name" class="form-label" style="font-weight: bold;">Hotel Name</label>
                            <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Enter Hotel Name" required>
                        </div>
                        <div class="col-md-3">
                            <label for="hotel_address" class="form-label" style="font-weight: bold;">Hotel Address</label>
                            <input type="text" class="form-control" id="hotel_address" name="hotel_address" placeholder="Enter Hotel Address" required>
                        </div>
                        <div class="col-md-3">
                            <label for="hotel_contact_no" class="form-label" style="font-weight: bold;">Hotel Contact No.</label>
                            <input type="text" class="form-control" id="hotel_contact_no" name="hotel_contact_no" placeholder="Enter Hotel Contact No." required>
                        </div>
                        <div class="col-md-3">
                            <label for="room_no" class="form-label" style="font-weight: bold;">Room No.</label>
                            <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Enter Room No." required>
                        </div>
                    </div>

                    <div class="row mb-3 px-3">
                        <div class="col-md-3">
                            <label for="whatsapp_no" class="form-label" style="font-weight: bold;">WhatsApp No.</label>
                            <input type="text" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="Enter WhatsApp No." required>
                        </div>
                        <div class="col-md-3">
                            <label for="emergency_no" class="form-label" style="font-weight: bold;">Emergency No.</label>
                            <input type="text" class="form-control" id="emergency_no" name="emergency_no" placeholder="Enter Emergency No." required>
                        </div>
                        <div class="col-md-3">
                            <label for="adults" class="form-label" style="font-weight: bold;">Adults</label>
                            <input type="number" class="form-control" id="adults" name="adults" placeholder="Number of Adults" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <label for="children" class="form-label" style="font-weight: bold;">Children</label>
                            <input type="number" class="form-control" id="children" name="children" placeholder="Number of Children" min="0" required>
                        </div>
                    </div>

                    <div class="row mb-3 px-3">
                        <div class="col-md-3">
                            <label for="infants" class="form-label" style="font-weight: bold;">Infants</label>
                            <input type="number" class="form-control" id="infants" name="infants" placeholder="Number of Infants" min="0" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- JavaScript to handle form submission and AJAX request -->
    <script>
        $(document).ready(function() {
            $('#bookingForm').submit(function(event) {
                event.preventDefault(); // Prevent form from submitting normally
                var formData = $(this).serialize(); // Collect form data

                $.ajax({
                    url: '', // Same page (PHP will handle form submission)
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Booking information saved successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                $('#bookingForm')[0].reset(); // Clear form on success
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error saving the booking information: ' + response,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'AJAX request failed: ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
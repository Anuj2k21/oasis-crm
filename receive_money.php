
  

<?php
// Database connection details
$host = 'localhost';
$dbname = 'payment_collection';
$username = 'root';
$password = '';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// If the request is sent via AJAX (check using `isset($_POST['ajax'])`)
if (isset($_POST['ajax'])) {
    $bookingId = isset($_POST['booking_id']) ? $_POST['booking_id'] : '';
    $refNo = isset($_POST['ref_no']) ? $_POST['ref_no'] : '';

    // SQL query to fetch data from the payments table
    $sql = "SELECT * FROM payments WHERE id = '$bookingId' OR ref_no = '$refNo'";
    $result = mysqli_query($conn, $sql);

    // Check if any results were returned
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        // Return the results as JSON
        echo json_encode($data);
    } else {
        echo json_encode(['message' => 'No records found']);
    }

    // Close connection
    mysqli_close($conn);
    exit(); // End the PHP script after returning the AJAX response
}
?>

 <!--start header-->
 <?php include('includes/header.php');?>
 <!--end header-->
<!--start sidebar-->
  <?php include('includes/sidebar.php');?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Search</title>
    <style>
        @media (max-width: 768px) {
            #searchForm {
                margin-left: 0;
                margin-top: 20px;
            }
            .card-body {
                padding: 10px;
            }
            .card {
                width: 100% !important;
                margin-left: 0 !important;
            }
            .form-group {
                margin-bottom: 1rem;
            }
            .btn {
                width: 100%;
            }
        }

        @media (min-width: 769px) {
            .first-card {
                margin-left: 40px;
            }
        }

        @media (max-width: 576px) {
            .form-row {
                flex-direction: column;
            }
            .form-group {
                width: 100%;
            }
            .d-flex {
                flex-direction: column !important;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid" >
        <!-- Search form -->
        <form id="searchForm" style="margin-top:100px;margin-Left:400px">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="refNo" class="col-form-label">Invoice No./Ref.No.</label>
                    <input type="text" class="form-control" id="refNo" placeholder="Enter Invoice No.">
               
            </div>
            <button type="button" id="searchBtn" class="btn btn-primary mt-3" style="background-color:blue; font-weight:800; border-radius:10px; height:50px;">Search</button>
        
    </div>
        </form>

        <br>

        <!-- Responsive layout for the two cards -->
        <div class="row" style="display-flex; justify-content:space-around">
            <div class="col-lg-5 col-md-12" style="margin-left:300px">
                <!-- First card with margin-left 40px for larger screens -->
                <div class="card first-card">
                    <div class="card-header text-center">
                        <h2 style="color: green; font-weight:800;">Payment Collection Details</h2>
                    </div>
                    <div class="card-body">
                        <form id="paymentForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="transactionid" class="form-label">Transaction Id</label>
                                    <input type="text" class="form-control" id="transactionid" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="collection_date" class="form-label">Collection Date</label>
                                    <input type="date" class="form-control" id="collection_date" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="net_in_inr" class="form-label">Net In INR</label>
                                    <input type="number" class="form-control" id="net_in_inr" required oninput="calculateAED()">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="amount_aed" class="form-label">Amount (AED)</label>
                                    <input type="number" class="form-control" id="amount_aed">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <select class="form-control" id="payment_method" required>
                                        <option selected>Select</option>
                                        <!-- Options -->
                                        <option>Cash in Hand</option>
                                        <option>CDM ICICI</option>
                                        <option>CDM HDFC</option>
                                        <!-- other options -->
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="important_note" class="form-label">Important Note</label>
                                    <textarea class="form-control" id="important_note"></textarea>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-success btn-block" type="submit">Save Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 style="color: green; font-weight:800;">Payment Status</h2>
                    </div>
                    <div class="card-body">
                        <form id="moneyBookingForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Company Name</span>
                                    <span class="form-control" id="company_name" style="font-weight:600; color:green">-</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Ref.NO.</span>
                                    <span class="form-control" id="ref_no" style="font-weight:600; color:green">-</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Total (AED)</span>
                                    <span class="form-control" id="total_aed" style="font-weight:600; color:green">-</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Total (INR)</span>
                                    <span class="form-control" id="total_inr" style="font-weight:600; color:green">-</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Total Received (AED)</span>
                                    <span class="form-control bg-success text-white" id="total_received_aed">-</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Total Received (INR)</span>
                                    <span class="form-control bg-success text-white" id="total_received_inr">-</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Total Pending (AED)</span>
                                    <span class="form-control bg-danger text-white" id="total_pending_aed">-</span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="form-label font-weight-bold">Total Pending (INR)</span>
                                    <span class="form-control bg-danger text-white" id="total_pending_inr">-</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <span class="form-label font-weight-bold">STATUS</span>
                                    <span class="form-control bg-danger text-white" id="status">-</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateAED() {
            const netInInr = parseFloat(document.getElementById("net_in_inr").value) || 0;
            if (netInInr) {
                const amountInAed = netInInr / 23;
                document.getElementById("amount_aed").value = amountInAed.toFixed(2);
            }
        }

        $('#searchBtn').on('click', function () {
            var bookingId = $('#bookingId').val();
            var refNo = $('#refNo').val();

            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    booking_id: bookingId,
                    ref_no: refNo,
                    ajax: true
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.message) {
                        alert(data.message);
                    } else {
                        $('#company_name').text(data.company_name);
                        $('#ref_no').text(data.ref_no);
                        $('#total_aed').text(data.total_aed);
                        $('#total_inr').text(data.total_inr);
                        $('#total_received_aed').text(data.total_received_aed || '-');
                        $('#total_received_inr').text(data.total_received_inr || '-');
                        $('#total_pending_aed').text(data.total_pending_aed || '-');
                        $('#total_pending_inr').text(data.total_pending_inr || '-');
                        $('#status').text(data.status);
                    }
                }
            });
        });
    </script>
</body>
</html>

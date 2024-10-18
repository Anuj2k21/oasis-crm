  <!--header start-->
  <?php include('includes/header.php');?>
  <!--header end-->
  <!--sidebar start -->
  <?php include('includes/sidebar.php');?>
  <!--sidebar end -->
    <style>
     .content-section {
        display: none;
     }
     .content-section.active {
        display: block;
     }
     .nav-tabs {
        border-bottom: none;
     }
     .nav-tabs .nav-link {
        background-color:  rgb(0, 74, 227);
        color: white;
        border: 1px solid #6699CC;
        font-weight: 600;
        border-bottom: none;
        margin-right: 5px;
        border-radius: 5px 5px 0 0;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.1s linear;
     }
     .nav-tabs .nav-link:hover {
        color: white;
        font-weight: 600;
        font-family: 'poppins';
     }
     .nav-tabs .nav-link.active {
        color: black;
        /* background-color: #131010; */
        font-weight: 600;
        border-bottom: 2px solid #ac40ac;
        box-shadow: 0 -5px 5px rgba(0, 0, 0, 0.2);
     }
     .editor-content {
        border:2px solid #00478d;
        border-radius: 0 0 5px 5px;
        min-height: 200px;
        padding: 10px;
        
     }
     .table-responsive {
        margin-top: 20px;
     }
     .align-center {
     display: flex;
     align-items: center;
     }
     .align-center h3 {
      font-size: 24px;
      margin: 0; 
     } 
     .align-center button {
      font-weight: 500;
      margin-left: 10px; 
     }
     /* Style for highlighting fields 1st tab info */
     .highlight {
       font-weight: bold;
       color: green;
    }
    .highlight-box {
       padding: 10px;
       background-color: #f0f8f0;
       border: 1px solid green;
       margin-bottom: 20px;
    }
    </style>                        
    <!-- booking Information Tab Php Code-->
    <?php include('includes/config.php');

?>













    <!--Tabs starts here-->

<main id="main" class="main">
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <h1 class="breadcrumb-item"><a href="#">Generate Bill</a></h1>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <!-- Generate Bill Horizontal Form Start Here-->
                <div class="container">
                  <div class="align-center" style="border-radius: 5px;">
                    <h3 style="font-weight: bold;">Generate Bill</h3>
                    <a href="" id="newEntryBtn" class="btn btn-danger my-3" style="margin-left: 10px;">New</a>
                  </div>       
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-section="bookingInfo">Booking Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-section="hotelInfo">Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-section="tourInfo">Tours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-section="visaInfo">Visa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-section="AirTicketInfo">Air Ticket</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#" data-section="invoiceInfo">Invoice</a>
                        </li> 
                       <li class="nav-item">
                            <a class="nav-link" href="#" data-section="supplierInfo">Supplier Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-section="receivedInfo">Received Statement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-section="payment_history">Payment History</a>
                        </li>
                    </ul>
                <!--Generate Bill Tabs Ends-->
                
 <!-- Agent form start here -->
<div id="bookingInfo" class="container content-section active table-responsive mt-4" style="margin-left:-30px">
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
</div>
    <div class="text-center">
            <button type="submit" class="btn btn-primary" id="saveNextBtn">Save & Next</button>
            </div>
        </form>
    </div>
</div>
<!-- Guest Information End here -->

<!--Hotel tab Start here-->
<div id="hotelInfo" class="content-section" style="overflow:auto">
    <div class="card-body">
        <div class="table-container mt-3">
            <table class="table" id="booking_hotel">
                <thead>
                    <tr>
                        <th class="text-center">Supplier</th>
                        <th class="text-center">Hotel</th>
                        <th class="text-center">Rooms</th>
                        <th class="text-center" style="text-wrap:nowrap">Room Type</th>
                        <th class="text-center" style="text-wrap:nowrap">Meal Type</th>
                        <th class="text-center">Check In</th>
                        <th class="text-center">Check Out</th>
                        <th class="text-center">Deadline</th>
                        <th class="text-center">Cost(AED)</th>
                        <th class="text-center">Sell(AED)</th>
                        <th class="text-center" style="text-wrap:nowrap">Gross Profit</th>
                        <th class="text-center">
                            <button class="btn btn-success btn-sm" id="addRowBtn-1">Add</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-md-3 w-auto">
                            <select class="form-select" style="width:200px;">
                                <option selected>Select Supplier</option>
                                <?php foreach ($supplier as $supplier): ?>
                                  <option value="<?= htmlspecialchars($supplier) ?>"><?= htmlspecialchars($supplier) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" style="width:180px;">
                                <option selected>Select Hotel</option>
                                <?php foreach ($hotel as $hotel): ?>
                                  <option value="<?= htmlspecialchars($hotel) ?>"><?= htmlspecialchars($hotel) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                       <td class="col-md-2"><input type="text" class="form-control" style="width:100px;"></td>
                        <td class="col-md-2">
                            <select class="form-select" style="width:200px;">
                                <option selected>Select Room Type</option>
                                <option value="">Single Room</option>
                                <option value="">Double Room</option>
                                <option value="">Standard Room</option>
                                <option value="">Connecting Room</option>
                                <option value="">Deluxe Room</option>
                            </select>
                        </td>
                        <td class="col-md-2">
                            <select class="form-select" style="width:200px;">
                                <option selected>Select Meal Type</option>
                                <?php foreach ($meal as $meal): ?>
                                  <option value="<?= htmlspecialchars($meal) ?>"><?= htmlspecialchars($meal) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="col-md-2"><input type="date" class="form-control"></td>
                        <td class="col-md-2"><input type="date" class="form-control"></td>
                        <td class="col-md-2"><input type="date" class="form-control"></td>
                        <td class="col-md-2"><input type="text" class="form-control cost-input"></td>
                        <td class="col-md-2"><input type="text" class="form-control sell-input"></td>
                        <td class="col-md-2"><input type="text" class="form-control gross-profit-input" readonly></td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm deleteRowBtn-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-sm" style="font-weight: 500;">Save & Next</button>
                <button type="button" class="btn btn-primary btn-sm" style="font-weight: 500;">Skip</button>
            </div>
        </div>
    </div>
</div>
<!--Hotel Tab End here-->

<!--Tour Information Start here-->
<div id="tourInfo" class="content-section" style="overflow:auto">
    <div class="card-body">
        <div class="table-container mt-3">
            <table class="table table-bordered" id="booking_tour">
                <thead style="font-size: 14px; white-space: nowrap;">
                    <tr>
                        <th class="text-center">Date</th>
                        <th class="text-center">Time</th>
                        <th class="text-center">Tour Type</th>
                        <th class="text-center">Tour</th>
                        <th class="text-center">Adult</th>
                        <th class="text-center">Child</th>
                        <th class="text-center">Infant</th>
                        <th class="text-center">Cost (AED)</th>
                        <th class="text-center">Total Selling (AED)</th>
                        <th class="text-center">Gross Profit</th>
                        <th class="text-center">Remark</th>
                        <th class="text-center">
                            <button class="btn btn-success btn-sm" id="addRowBtn-2">Add</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-md-2"><input type="date" class="form-control" placeholder="mm/dd/yyyy"></td>
                        <td class="col-md-1"><input type="time" class="form-control"></td>
                        <td class="col-md-3">
                            <select class="form-select" style="width:180px;">
                                <option>Select Tour Type</option>
                                <option>Sharing Transfers</option>
                                <option>Private Transfers</option>
                                <option>Ticket Only</option>
                            </select>
                        </td>
                        <td class="col-md-3">
                            <select class="form-select" style="width:150px;">
                                <option>Select Tour</option>
                                <?php foreach ($tour as $tour): ?>
                                  <option value="<?= htmlspecialchars($tour) ?>"><?= htmlspecialchars($tour) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                        <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                        <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                        <td class="col-md-1"><input type="text" class="form-control" style="width:100px;"></td>
                        <td class="col-md-1"><input type="text" class="form-control" style="width:100px;"></td>
                        <td class="col-md-1"><input type="text" class="form-control" style="width:100px;"></td>
                        <td class="col-md-2"><textarea placeholder="Remark" class="form-control" style="width:100px;"></textarea></td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm deleteRowBtn-2">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-sm" style="font-weight: 500;">Save & Next</button>
                <button type="button" class="btn btn-primary btn-sm" style="font-weight: 500;">Skip</button>
            </div>
        </div>
    </div>
</div>
<!--Tour Information End here-->

<!--Visa Start here-->
<div id="visaInfo" class="content-section" style="overflow:auto">
    <div class="card-body">
        <div class="table-container mt-3">
            <table class="table table-bordered" id="booking_visa" style="width: 100%;">   
                <thead>
                    <tr>
                        <th class="text-center">Date</th>
                        <th class="text-center">Supplier</th>
                        <th class="text-center" style="white-space: nowrap;">Visa Type Country</th>
                        <th class="text-center">Name</th>
                        <th class="text-center" style="white-space: nowrap;">Passport No</th>
                        <th class="text-center">Adult/Child</th>
                        <th class="text-center">Nationality</th>
                        <th class="text-center">ECR</th>
                        <th class="text-center">Cost (AED)</th>
                        <th class="text-center">Sell (AED)</th>
                        <th class="text-center">Cost (INR)</th>
                        <th class="text-center">Sell (INR)</th>
                        <th class="text-center">Gross Profit</th>
                        <th class="text-center">
                            <button class="btn btn-success btn-sm" id="addRowBtn-3">Add</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="date" class="form-control" name="date"></td> 
                        <td class="col-md-3 w-auto">
                            <select class="form-select" style="width:200px;">
                                <option selected>Select Supplier</option>
                                <?php foreach ($suppliers as $suppliers): ?>
                                  <option value="<?= htmlspecialchars($suppliers) ?>"><?= htmlspecialchars($suppliers) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="col-md-2">
                            <select class="form-select" name="visa_type" style="width:200px;">
                                <option>Select</option>
                                <?php foreach ($visa as $visa): ?>
                                  <option value="<?= htmlspecialchars($visa) ?>"><?= htmlspecialchars($visa) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="col-md-2"><input type="text" class="form-control" name="name" style="width:150px;"></td>
                        <td class="col-md-2"><input type="text" class="form-control" name="passport" style="width:150px;"></td>
                        <td class="col-md-2">
                            <select class="form-select" name="adult_child" style="width:100px;">
                                <option>Select</option>
                                <option>Adult</option>
                                <option>Child</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" id="country" name="country" style="width:200px;" required>
                                <option selected>Select Country</option>
                                <?php foreach ($nationality as $nationality): ?>
                                <option value="<?= htmlspecialchars($nationality) ?>"><?= htmlspecialchars($nationality) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="col-md-2">
                            <select class="form-select" name="ecr" style="width:100px;">
                                <option>Select</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control cost" name="cost_AED" id="cost_AED" style="width:70px;"></td>
                        <td><input type="text" class="form-control sell" name="sell_AED" id="sell_AED" style="width:70px;"></td>
                        <td><input type="text" class="form-control cost" name="cost_INR" id="cost_INR" style="width:70px;"></td>
                        <td><input type="text" class="form-control sell" name="sell_INR" id="sell_INR" style="width:70px;"></td>
                        <td><input type="text" class="form-control gross_profit" name="gross_profit" readonly style="width:100px"></td>
                        <td><button class="btn btn-danger btn-sm deleteRowBtn-3">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-sm" style="font-weight: 500;">Save & Next</button>
                <button type="button" class="btn btn-primary btn-sm" style="font-weight: 500;">Skip</button>
            </div>
        </div>
    </div>
</div>
<!--Visa End here-->

<!--Invoice Information start form-->
<div class="container w-[100vh]">
    <div id="invoiceInfo" class="content-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form action="#">
                        <div class="mb-3">
                            <label style="font-size:24px; font-weight:700;background-color:#f2f2f2; width:100%; padding:18px">
                                Description
                            </label>
                            <textarea name="description" id="your_summernote" class="form-control mySummernote" rows="4"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Traveller Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-2">Traveller</th>
                        <th class="col-md-2">Units</th>
                        <th class="col-md-2">Final Rate (INR)</th>
                        <th class="col-md-2">Total Amount (INR)</th>
                        <th class="col-md-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-select">
                                <option>Adult</option>
                                <option>Child</option>
                                <option>PAX</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" id="units" oninput="calculateTotal()" /></td>
                        <td><input type="text" class="form-control" id="finalRate" oninput="calculateTotal()" /></td>
                        <td><input type="text" class="form-control" id="totalAmount" readonly /></td>
                        <td>
                            <button class="btn btn-sm btn-success" id="addRowBtn-4">Add</button>
                            <button class="btn btn-sm btn-danger deleteRowBtn-4">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Financial Summary Section -->
        <div class="row mt-4 p-2">
            <div class="col-md-2">
                <label for="total" class="form-label">Total</label>
                <input type="number" id="total" class="form-control" value="0" readonly />
            </div>
            <div class="col-md-2">
                <label for="serviceCharge" class="form-label">Service Charge</label>
                <input type="number" id="serviceCharge" class="form-control" value="0" oninput="calculateGrandTotal()" />
            </div>
            <div class="col-md-2">
                <label for="vat" class="form-label">VAT(%)</label>
                <input type="number" id="vat" class="form-control" value="0" oninput="calculateGrandTotal()" />
            </div>
            <div class="col-md-3">
                <label class="form-label">GST Type</label>
                <div class="d-flex flex-wrap">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gstType" id="igst" checked />
                        <label class="form-check-label" for="igst">IGST</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gstType" id="cgstSgst" />
                        <label class="form-check-label" for="cgstSgst">CGST & SGST</label>
                    </div>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="gstType" id="tcs" />
                        <label class="form-check-label" for="tcs">TCS</label>
                    </div>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="gstType" id="tds" />
                        <label class="form-check-label" for="tds">TDS</label>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="gst" class="form-label">GST (%)</label>
                <input type="number" id="gst" class="form-control" value="18" oninput="calculateGrandTotal()" />
            </div>
            <div class="col-md-2">
                <label for="gstAmount" class="form-label">GST Amount</label>
                <input type="text" id="gstAmount" class="form-control" readonly />
            </div>
            <div class="col-md-2">
                <label for="tcsTds" class="form-label">TCS/TDS%</label>
                <input type="number" id="tcsTds" class="form-control" oninput="calculateGrandTotal()" />
            </div>
            <div class="col-md-2">
                <label for="tcsTds_amount" class="form-label">TCS/TDS Amount</label>
                <input type="text" id="tcsTds_amount" class="form-control" readonly />
            </div>
            <div class="col-md-2">
                <label for="grandTotal" class="form-label">Grand Total</label>
                <input type="number" id="grandTotal" class="form-control" readonly />
            </div>
            <div class="col-md-4 mt-4 text-end">
                <button class="btn btn-primary" style="font-weight: 500;">
                    <a href="invoice2.html" style="color:white; font-weight:700">Save Proforma Invoice</a>
                </button>
            </div>
        </div>
    </div>
</div>
<!--Invoice Information End form -->
<!-- Supplier Payment Start form-->
  <div class="container w-[100vh]">
    <div class="table-responsive mt-4" style="overflow:auto">
        <div id="supplierInfo" class="content-section">
            <form id="suplierform" class="mt-5" style="max-width:75%; margin-left:11%; background-color:#FAEBD7; padding:5px; border:5px solid lightgray">
                <h4 class="mb-3" style="font-weight:900">Supplier Payment Details</h4>
                <hr>
                <div class="row mb-3" style="display:flex; flex-direction:row; justify-content:space-around">
                    <div class="col-md-2">
                        <label for="transactionid" class="form-label" style="font-weight:700">Transaction Id</label>
                        <input type="text" class="form-control" id="transactionid" style="width:150px;font-weight:700">
                    </div>
                    <div class="col-md-2">
                        <label for="collection_date" class="form-label" style="font-weight:700">Payment Date</label>
                        <input type="date" class="form-control" id="collection_date" style="width:150px;font-weight:700">
                    </div>
                    <div class="col-md-2">
                        <label for="net_in_inr" class="form-label" style="font-weight:700">Net In INR</label>
                        <input type="number" class="form-control" id="net_in_inr" style="width:100px;font-weight:700">
                    </div>
                    <div class="col-md-2">
                        <label for="conversion_rate" class="form-label" style="font-weight:700; text-wrap:nowrap">Conversion Rate (AED)</label>
                        <input type="number" class="form-control" id="conversion_rate" style="width:100px;font-weight:700">
                    </div>
                    <div class="col-md-3">
                        <label for="collect_usd" class="form-label" style="font-weight:700">Amount (AED)</label>
                        <input type="text" class="form-control" id="collect_usd" style="width:100px;font-weight:700" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="paymentMethod" class="form-label" style="font-weight:700">Payment Method</label>
                        <select class="form-select" id="paymentMethod">
                            <option selected>Select</option>
                            <option>Cash in Hand</option>
                            <option>CDM ICICI</option>
                            <option>CDM HDFC</option>
                            <option>Cheque ICICI</option>
                            <option>Cheque HDFC</option>
                            <option>IMPS ICICI</option>
                            <option>HDFC ICICI</option>
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
                        <label for="importantNote" class="form-label" style="font-weight:700">Important Note</label>
                        <textarea class="form-control" id="importantNote"></textarea>
                    </div>
                </div>
            </form>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button class="btn btn-primary" type="submit" style="font-weight: 500;">Save</button>
                <button class="btn btn-primary" type="submit" style="font-weight: 500;">Next</button>
            </div>
        </div>
    </div>
</div>
 <!-- Supplier Payment end form-->

<!--Received Statement form Start-->
<div class="table-responsive mt-4" style="overflow:auto">
<div id="receivedInfo" class="content-section">
    <form id="PaymentForm" style="max-width:75%; align-items:center; margin-left:11%; padding:5px;">
        <h4 class="mb-3 p-3 mr-0" style="font-weight:700">Bill Details</h4>
        <hr>
        <div class="row mb-3" style="display:flex; flex-direction:row; justify-content:space-around">
            <div class="col-md-2">
                <label for="total_bill_aed" class="form-label" style="font-weight:700">Total Bill(AED)</label>
                <input type="text" class="form-control" id="total_bill_aed" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="total_bill_inr" class="form-label" style="font-weight:700">Total Bill(INR)</label>
                <input type="text" class="form-control" id="total_bill_inr" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="received_aed" class="form-label" style="font-weight:700">Received(AED)</label>
                <input type="text" class="form-control" id="received_aed" value="0" oninput="updateForm()" style="width:100px; font-weight:700; background-color:#76AD78; color:white">
            </div>
            <div class="col-md-2">
                <label for="received_inr" class="form-label" style="font-weight:700">Received(INR)</label>
                <input type="text" class="form-control" id="received_inr" value="0" oninput="updateForm()" style="width:100px; font-weight:700; background-color:#76AD78; color:white">
            </div>
            <div class="col-md-2">
                <label for="pending_aed" class="form-label" style="font-weight:700;">Pending(AED)</label>
                <input type="text" class="form-control" id="pending_aed" value="0.00" style="width:100px; font-weight:700; background-color:#E06666; color:white">
            </div>
            <div class="col-md-2">
                <label for="pending_inr" class="form-label" style="font-weight:700;">Pending(INR)</label>
                <input type="text" class="form-control" id="pending_inr" value="0.00" style="width:100px; font-weight:700; background-color:#E06666; color:white">
            </div>
        </div>
        <div class="row mb-4" style="display:flex; flex-direction:row; justify-content:space-around">
            <div class="col-md-2">
                <label for="gst_aed" class="form-label" style="font-weight:700">GST%(AED)</label>
                <input type="number" class="form-control" id="gst_aed" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="gst_inr" class="form-label" style="font-weight:700">GST%(INR)</label>
                <input type="number" class="form-control" id="gst_inr" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="vat_aed" class="form-label" style="font-weight:700">VAT%(AED)</label>
                <input type="number" class="form-control" id="vat_aed" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="vat_inr" class="form-label" style="font-weight:700">VAT%(INR)</label>
                <input type="number" class="form-control" id="vat_inr" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="service_charge_aed" class="form-label" style="font-weight:700">Service Charge(AED)</label>
                <input type="number" class="form-control" id="service_charge_aed" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
        </div>
        <div class="row mb-4" style="display:flex; flex-direction:row; justify-content:space-around">
            <div class="col-md-2">
                <label for="service_charge_inr" class="form-label" style="font-weight:700">Service Charge(INR)</label>
                <input type="number" class="form-control" id="service_charge_inr" value="0" oninput="updateForm()" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="gross_profit_aed" class="form-label" style="font-weight:700">Gross Profit(AED)</label>
                <input type="text" class="form-control" id="gross_profit_aed" value="0.00" style="width:100px">
            </div>
            <div class="col-md-2">
                <label for="gross_profit_inr" class="form-label" style="font-weight:700">Gross Profit(INR)</label>
                <input type="text" class="form-control" id="gross_profit_inr" value="0.00" style="width:100px">
            </div>
            <div class="col-md-2">
                <label for="grand_total_aed" class="form-label" style="font-weight:700">Grand Total(AED)</label>
                <input type="text" class="form-control" id="grand_total_aed" value="0.00" style="width:100px">
            </div>
            <div class="col-md-2">
                <label for="grand_total_inr" class="form-label" style="font-weight:700">Grand Total(INR)</label>
                <input type="text" class="form-control" id="grand_total_inr" value="0.00" style="width:100px">
            </div>
        </div>
    </form>
    <form class="mt-5" style="max-width:75%; margin-left:11%; padding:5px;">
        <h4 class="mb-3" style="font-weight:900">Payment Collection Details</h4>
        <hr>
        <div class="row mb-3" style="display:flex; flex-direction:row; justify-content:space-around">
            <div class="col-md-2">
                <label for="transactionid" class="form-label" style="font-weight:700">Transaction Id</label>
                <input type="text" class="form-control" id="transactionid" style="width:150px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="collection_date" class="form-label" style="font-weight:700">Collection Date</label>
                <input type="date" class="form-control" id="collection_date" style="width:150px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="net_in_inr" class="form-label" style="font-weight:700">Net In INR</label>
                <input type="number" class="form-control" id="net_in_inr" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-2">
                <label for="conversion_rate" class="form-label" style="font-weight:700;">Conversion Rate(AED)</label>
                <input type="number" class="form-control" id="conversion_rate" style="width:100px; font-weight:700">
            </div>
            <div class="col-md-3">
                <label for="collect_usd" class="form-label" style="font-weight:700">Amount(AED)</label>
                <input type="text" class="form-control" id="collect_usd" style="width:100px; font-weight:700" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2">
                <label for="payment_method" class="form-label" style="font-weight:700">Payment Method</label>
                <select class="form-select" id="payment_method">
                    <option selected>Select</option>
                    <option>Cash in Hand</option>
                    <option>CDM ICICI</option>
                    <option>CDM HDFC</option>
                    <option>NEFT</option>
                    <option>IMPS</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="payment_mode" class="form-label" style="font-weight:700">Payment Mode</label>
                <select class="form-select" id="payment_mode">
                    <option selected>Select</option>
                    <option>Full Payment</option>
                    <option>Part Payment</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="status" class="form-label" style="font-weight:700">Status</label>
                <select class="form-select" id="status">
                    <option selected>Select</option>
                    <option>Paid</option>
                    <option>Pending</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="add_payment" class="form-label" style="font-weight:700">Add Payment</label>
                <button type="button" id="add_payment" class="btn btn-primary" style="width:100px; height:38px">Add</button>
            </div>
        </div>
    </form>
</div>
<!--Received Statement form end-->

<!-- Payment History tab start -->
<div id="payment_history" class="content-section table-responsive mt-4" style="overflow:auto">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                        <div class="table-container">
                            <table class="table table-bordered table-sm" id="payment_history_table">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Bank</th>
                                        <th scope="col">Transaction Id</th>
                                        <th scope="col">Amount INR</th>
                                        <th scope="col">Amount AED</th>
                                        <th scope="col">Important Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>01/02/2023</td>
                                        <td>NEFT ICICI</td>
                                        <td>ICICI</td>
                                        <td>20247816281</td>
                                        <td>120000</td>
                                        <td>800</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tour" role="tabpanel" aria-labelledby="tour-tab">Tour Information</div>
                    <div class="tab-pane fade" id="visa" role="tabpanel" aria-labelledby="visa-tab">Visa Information</div>
                    <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">Hotel Information</div>
                    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">Payment Information</div>
                    <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">Invoice Information</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Payment History tab end-->
</section>
</main>
<!-- End #main -->

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

 <!-- Summernote JS - CDN Link -->
    
    
    <script>
// Function to handle adding a new row
function addRow(tableId, rowHTML, deleteButtonClass) {
    const table = document.getElementById(tableId).getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    newRow.innerHTML = rowHTML;

    // Attach delete event listener to the newly added delete button
    newRow.querySelector(`.${deleteButtonClass}`).addEventListener('click', function () {
        if (confirm('Are you sure you want to delete this entry?')) {
            table.deleteRow(newRow.rowIndex - 1); // Correct row deletion logic
        }
    });
}
// Add row for booking_hotel Hotel
document.getElementById('addRowBtn').addEventListener('click', function () {
    const rowHTML = `
            <td class="col-md-3 w-auto">
                <select class="form-select" style="width:200px;">
                    <option selected>Select Supplier</option>
                    <?php foreach ($supplier as $singleSupplier): ?>
                        <option value="<?= htmlspecialchars($singleSupplier) ?>"><?= htmlspecialchars($singleSupplier) ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select class="form-select" style="width:180px;">
                    <option selected>Select Hotel</option>
                    <?php foreach ($hotel as $singleHotel): ?>
                        <option value="<?= htmlspecialchars($singleHotel) ?>"><?= htmlspecialchars($singleHotel) ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="col-md-2"><input type="text" class="form-control" style="width:100px;"></td>
            <td class="col-md-2">
                <select class="form-select" style="width:200px;">
                    <option selected>Select Room Type</option>
                    <option value="">Single Room</option>
                    <option value="">Double Room</option>
                    <option value="">Standard Room</option>
                    <option value="">Connecting Room</option>
                    <option value="">Deluxe Room</option>
                </select>
            </td>
            <td class="col-md-2">
                <select class="form-select" style="width:200px;">
                    <option selected>Select Meal Type</option>
                    <?php foreach ($meal as $singleMeal): ?>
                        <option value="<?= htmlspecialchars($singleMeal) ?>"><?= htmlspecialchars($singleMeal) ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="col-md-2"><input type="date" class="form-control"></td>
            <td class="col-md-2"><input type="date" class="form-control"></td>
            <td class="col-md-2"><input type="date" class="form-control"></td>
            <td class="col-md-2"><input type="text" class="form-control cost-input"></td>
            <td class="col-md-2"><input type="text" class="form-control sell-input"></td>
            <td class="col-md-2"><input type="text" class="form-control gross-profit-input" readonly></td>
    `;
    addRow('booking_hotel', rowHTML, 'deleteRowBtn');
});


    
    // Add row for bookingTable tour 
    document.getElementById('addRowBtn-1').addEventListener('click', function () {
        const rowHTML = `
            <td class="col-md-2"><input type="date" class="form-control" placeholder="mm/dd/yyyy"></td>
                                    <td class="col-md-1"><input type="time" class="form-control"></td>
                                    <td class="col-md-3">
                                        <select class="form-select" style="width:180px;">
                                            <option>Select Tour Type</option>
                                        </select>
                                    </td>
                                    <td class="col-md-3">
                                        <select class="form-select" style="width:150px;">
                                            <option>Select Tour</option>
                                        </select>
                                    </td>
                                    <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                                    <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                                    <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                                    <td class="col-md-1"><input type="text" class="form-control" style="width:50px;"></td>
                                    <td class="col-md-1"><input type="text" class="form-control" style="width:100px;"></td>
                                    <td class="col-md-1"><input type="text" class="form-control" style="width:100px;"></td>
                                    <td class="col-md-2"><textarea placeholder="Remark" class="form-control" style="width:100px;"></textarea></td>
                                    
        `;
        addRow('booking_tour', rowHTML, 'deleteRowBtn-1');
    });

    // Add row for Visa Tab



    // Initial delete button event listeners
    document.querySelectorAll('.deleteRowBtn').forEach(button => {
        button.addEventListener('click', function () {
            const row = button.parentElement.parentElement;
            if (confirm('Are you sure you want to delete this entry?')) {
                row.parentElement.removeChild(row);
            }
        });
    });

    document.querySelectorAll('.deleteRowBtn-1').forEach(button => {
        button.addEventListener('click', function () {
            const row = button.parentElement.parentElement;
            if (confirm('Are you sure you want to delete this entry?')) {
                row.parentElement.removeChild(row);
            }
        });
    });

    document.querySelectorAll('.deleteRowBtn-2').forEach(button => {
        button.addEventListener('click', function () {
            const row = button.parentElement.parentElement;
            if (confirm('Are you sure you want to delete this entry?')) {
                row.parentElement.removeChild(row);
            }
        });
    });

    // Hotel tab value Dynamically 
     document.querySelectorAll('.cost-input, .sell-input').forEach(input => {
        input.addEventListener('input', calculateGrossProfit);
    });

    function calculateGrossProfit() {
        const rows = document.querySelectorAll('#booking_hotel tbody tr');
        rows.forEach(row => {
            const cost = parseFloat(row.querySelector('.cost-input').value) || 0;
            const sell = parseFloat(row.querySelector('.sell-input').value) || 0;
            const grossProfit = cost-sell;
            row.querySelector('.gross-profit-input').value = grossProfit.toFixed(2);
        });
    }

    // Visa tab Value Dynamically 
    document.addEventListener('input', function(e) {
    if (e.target.classList.contains('cost') || e.target.classList.contains('sell')) {
        const row = e.target.closest('tr'); // Get the closest row (tr)
        const costInput = row.querySelector('.cost').value || 0; // Get the cost value
        const sellInput = row.querySelector('.sell').value || 0; // Get the sell value
        const grossProfitInput = row.querySelector('.gross_profit'); // Get the gross profit input field

        // Calculate the gross profit
        const grossProfit =  parseFloat(costInput)-parseFloat(sellInput);
        grossProfitInput.value = isNaN(grossProfit) ? 0 : grossProfit.toFixed(2); // Set the result
    }
});
  
// Invoice tab Dynamic

function calculateTotal() {
        const units = parseFloat(document.getElementById('units').value) || 0;
        const finalRate = parseFloat(document.getElementById('finalRate').value) || 0;
        const totalAmount = units * finalRate;
        document.getElementById('totalAmount').value = totalAmount;

        // Update Total in the bottom section
        document.getElementById('total').value = totalAmount;
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
</body> 
 <?php include('includes/footer.php');?>
</html>
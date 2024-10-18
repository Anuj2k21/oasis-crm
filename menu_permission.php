 <!--start header-->
 <?php include('includes/header.php');?>
 <!-- end header-->

  <!--start sidebar-->
  <?php include('includes/sidebar.php');?>
<!--end sidebar-->
  <style>
    .form-check-input {
    border: 1px solid black;
    }
    </style>
  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <h1 class="breadcrumb-item"><a href="#">Menu Configuration</a></h1>
          <li class="breadcrumb-item active">Menu Permission</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- Horizontal Form -->
              <form name="myform" id="myForm">
                <div class="container mt-4">
            
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="font-weight: bold; color: black;">
                                    ROLES
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="selectRole" class="form-label">Select Role</label>
                                        <select class="form-select" id="selectRole">
                                            <option selected>Select Designation</option>
                                            <option>admin</option>
                                            <option>user</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="selectUserAccount" class="form-label">Select User Account</label>
                                        <select class="form-select" id="selectUserAccount">
                                            <option selected>Administrator</option>
                                            <option>Anuj </option>
                                            <option>Nitesh</option>
                                            <option>Anurag</option>
                                            <option>Abhishesk</option>
            
                                        </select>
                                    </div>
                                    <button class="btn btn-primary">Assign Permission</button>
                                    <button class="btn btn-secondary" style="margin-left: 10px;">Reset</button>
                                </div>
                            </div>
                        </div>
            
                        <!-- Right side Menu Details -->
            
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="font-weight: bold; color: black;">
                                    MENU DETAILS
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>
                                            <a href="#" class="select-all">Select all</a> | 
                                            <a href="#" class="deselect-all">Deselect all</a>
                                        </span>
                                    </div>                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dashboard" checked>
                                        <label class="form-check-label" for="dashboard">Dashboard</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="masters" checked>
                                        <label class="form-check-label" for="masters">Masters</label>
                                    </div>
                                    <div class="ms-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="tour" checked>
                                            <label class="form-check-label" for="country">Tours</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hotels" checked>
                                            <label class="form-check-label" for="vehicle">Hotels</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="visa" checked>
                                            <label class="form-check-label" for="supplier">Visa</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="stateMaster">
                                            <label class="form-check-label" for="stateMaster">Meal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="country" checked>
                                            <label class="form-check-label" for="city">Country</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="city" checked>
                                            <label class="form-check-label" for="city">City</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="supplier" checked>
                                            <label class="form-check-label" for="nationality">Supplier</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agent" checked>
                                            <label class="form-check-label" for="visaType">Agent</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="vehicle" checked>
                                            <label class="form-check-label" for="tour">Vehicle</label>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="booking" checked>
                                        <label class="form-check-label" for="booking">Booking</label>
                                        <div class="ms-4">
                                            </div>
                                        
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="bill_generate" checked>
                                                <label class="form-check-label" for="billgenerate">Generate Bill</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="tour_booking_report" checked>
                                                <label class="form-check-label" for="tour_booking_report">Tour Booking Report</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="tour_ticket_booking_report" checked>
                                                <label class="form-check-label" for="tour_booking_report">Tour Ticket Booking Report</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="hotel_booking_report" checked>
                                                <label class="form-check-label" for="tour_booking_report">Hotel Booking Report</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="visa_booking_report">
                                                <label class="form-check-label" for="tour_collection_report">Visa Booking Report</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="air_ticket_booking_report">
                                                <label class="form-check-label" for="agent_wise_booking_summary">Air Ticket Booking Report</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="tour_collection_report">
                                                <label class="form-check-label" for="package_opration_summary">Tour Collection Report</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="agent_wise_booking_summary" checked>
                                                <label class="form-check-label" for="tour_booking_report">Agent wise Booking Summary</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="payment_summary">
                                                <label class="form-check-label" for="payment_summary">Package Operation Summary</label>
                                            </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="account" checked>
                                        <label class="form-check-label" for="booking">Account</label>
                                        <div class="ms-4">
                                            </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="bill_generate" checked>
                                        <label class="form-check-label" for="billgenerate">Receive Money</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="bill_generate" checked>
                                        <label class="form-check-label" for="billgenerate">Payment Summary</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="privilege" checked>
                                        <label class="form-check-label" for="privilege">Privilege</label>
                                    </div>
                                    <div class="ms-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="user_creation" id="user_creation" checked>
                                            <label class="form-check-label" for="user_creation">User Creation</label>
                                        </div>
                                </div>
                                <div class="ms-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="user_creation" id="menu_permission" checked>
                                        <label class="form-check-label" for="menu_permission">Menu Permission</label>
                                    </div>
                                </div>
                                <div class="ms-4">
                                    <div class="form-check">
                                        <input class="form-check-input">
                                        <label class="form-check-label" for="logout">Logout</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
              </form><!-- End Horizontal Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php include('includes/footer.php');?>
</body>

</html>
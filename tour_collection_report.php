  <!--start header-->
  <?php include('includes/header.php');?>
  <!--end header-->

  <!--start sidebar-->
  <?php include('includes/sidebar.php');?>
  <!--end sidebar-->
  <style type="text/css">
th {
    white-space: nowrap;
    overflow: hidden;
    width: 100%;
    height: 25px;
}
</style>
  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <h1 class="breadcrumb-item"><a href="#">Tour Collection Report</a></h1>
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
                  <form>
                      <div class="row mb-3">
                          <div class="col-md-3">
                              <label for="fromDate" class="form-label">From Date</label>
                              <input type="date" class="form-control" id="fromDate">
                          </div>
                          <div class="col-md-3">
                              <label for="toDate" class="form-label">To Date</label>
                              <input type="date" class="form-control" id="toDate">
                          </div>
                          <div class="col-md-3">
                              <label for="bookingId" class="form-label">Booking Id</label>
                              <input type="text" class="form-control" id="bookingId" placeholder="Enter Booking Id">
                          </div>
                          <div class="col-md-3">
                              <label for="guestName" class="form-label">Guest Name</label>
                              <input type="text" class="form-control" id="guestName" placeholder="Enter Guest Name">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <div class="col-md-4">
                              <label for="referenceNumber" class="form-label">Reference Number</label>
                              <input type="text" class="form-control" id="referenceNumber" placeholder="Enter Reference No.">
                          </div>
                          <div class="col-md-4">
                              <label for="agent" class="form-label">Agent</label>
                              <select class="form-select" id="agent">
                                  <option selected>Select Agent</option>
                                  <option value="1">Agent 1</option>
                                  <option value="2">Agent 2</option>
                              </select>
                          </div>
                          <div class="col-md-2 d-flex align-items-end">
                              <button type="button" class="btn btn-primary me-2">Search</button>
                          </div>
                      </div>
                  </form>
                  <div class="container pt-5">
    <div id="btns" class="row"></div>
    <br/>
    <div class="row table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr class="tour_booking_report">
                    <th colspan="8"></th>
                    <th colspan="3" style="text-align: center;">USD</th>
                    <th colspan="2" style="text-align: center;">AED</th>
                    <th colspan="22"></th>
                </tr>
                <tr>
                    <th>Sr#</th>
                    <th>Booking Id</th>
                    <th>Reference No.</th>
                    <th>Agent</th>
                    <th>Contact</th>
                    <th>Guest Name</th>
                    <th>WhatsApp No.</th>
                    <th>Amount (INR)</th>
                    <th>Conv. Rate</th>
                    <th>Collect</th>
                    <th>Balance</th>
                    <th>Payment Date</th>
                    <th>Mode</th>
                    <th>Cash For</th>
                    <th>Dubai A/c</th>
                    <th>Cheque No.</th>
                    <th>Cheque Date</th>
                    <th>Bank Name</th>
                    <th>Transaction No.</th>
                    <th>Transaction Date</th>
                    <th>Sell By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nixon</td>
                    <td>System Architect</td>
                    <td>Garrett</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>Accountant</td>
                    <td>Winters</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm"><span class="fas fa-edit"></span></button>
                        <button type="button" class="btn btn-danger btn-sm"><span class="bi-trash"></span></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

  </main><!-- End #main -->
  
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "10%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "10%", "targets": 6 },
                { "width": "10%", "targets": 7 },
                { "width": "5%", "targets": 8 },
                { "width": "5%", "targets": 9 },
                { "width": "5%", "targets": 10 },
                { "width": "10%", "targets": 11 },
                { "width": "5%", "targets": 12 },
                { "width": "10%", "targets": 13 },
                { "width": "5%", "targets": 14 },
                { "width": "10%", "targets": 15 },
                { "width": "10%", "targets": 16 },
                { "width": "10%", "targets": 17 },
                { "width": "10%", "targets": 18 },
                { "width": "10%", "targets": 19 },
                { "width": "5%", "targets": 20 },
                { "width": "10%", "targets": 21 }
            ],
            "scrollX": true
        });
    });
</script>

<?php include('includes/footer.php');?>
</body>

</html>
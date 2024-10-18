  <!--start header-->
  <?php include('includes/header.php');?>
  <!--end header-->
  <!--start sidebar-->
  <?php include('includes/sidebar.php');?>
  <!--end sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <h1 class="breadcrumb-item"><a href="#">Package Operation Summary Report</a></h1>
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
                    <div class="search-panel">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="fromDate" class="form-label">From Date</label>
                                    <input type="date" class="form-control" id="fromDate" placeholder="mm/dd/yyyy">
                                </div>
                                <div class="col-md-3">
                                    <label for="toDate" class="form-label">To Date</label>
                                    <input type="date" class="form-control" id="toDate" placeholder="mm/dd/yyyy">
                                </div>
                                <div class="col-md-3">
                                    <label for="bookingId" class="form-label">Booking ID</label>
                                    <input type="text" class="form-control" id="bookingId" placeholder="Enter Booking Id">
                                </div>
                                <div class="col-md-3">
                                    <label for="referenceNumber" class="form-label">Reference No.</label>
                                    <input type="text" class="form-control" id="referenceNumber" placeholder="Enter Reference No.">
                                </div>
                                <div class="col-md-3">
                                    <label for="agent" class="form-label">Agent</label>
                                    <select class="form-select" id="agent">
                                        <option selected>Select Agent</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country">
                                        <option selected>Select Country</option>
                                    </select>
                                </div>
                                <div class="col-md-3 my-5">
                                    <button type="button" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
            
                    <div class="container pt-2">
        <div id="btns" class="row">
            <!-- Add Button -->
         <div class="container">
              <div class="panel panel-default">
              <div class="panel-heading">
              <div class="pull-right">
                <a href="add_order.php" class="btn btn-sm btn-info">
                    <span class="fa fa-plus" aria-hidden="true"></span> Add
                </a>
                <button class="btn btn-sm btn-info" onclick="printPDF()">
                    <span class="fa fa-print" aria-hidden="true"></span> Print PDF
                </button>
                <button class="btn btn-sm btn-success" onclick="exportToExcel()">
                    <span class="fa fa-download" aria-hidden="true"></span> Export Excel
                </button>
              </div>
            </div>
        </div>
        <br/>
        <div class="row table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr#</th>
                <th>Booking Id</th>
                <th>Reference No.</th>
                <th>Agent</th>
                <th>Guest Name</th>
                <th>Total Pax</th>
                <th>Tour</th>
                <th>Pickup Time</th>
                <th>Driver Name</th>
                <th>Guide Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>1</td>
            <td>128288</td>
            <td>278228</td>
            <td>Nitesh</td>
            <td>Rahul</td>
            <td>78</td>
            <td>dubai</td>
            <td>7:00</td>
            <td>Amzad</td>
            <td>Atul</td>
                <td class="action-buttons">
                    <button type="button" class="btn btn-primary btn-sm"><span class="fas fa-edit"></span></button>
                    <button type="button" class="btn btn-danger btn-sm"><span class="bi-trash"></span></button>
                </td>
            </tr>
        </tbody>
    </table>
          
                        

            </div>
          </div>

        </div>
      </div>
    </section>
   

  </main><!-- End #main -->
  
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
        new DataTable('#example');
    </script>

</body>
<?php include('includes/footer.php');?>
</html>
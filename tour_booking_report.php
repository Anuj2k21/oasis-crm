  <!--start header-->
  <?php include('includes/header.php');?>
  <!--end header-->

  <!--start sidebar-->
  <?php include('includes/sidebar.php')?>
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
          <h1 class="breadcrumb-item"><a href="#">Tour Booking Report</a></h1>
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
                          <label for="referenceNumber" class="form-label">Booking Id Ref-#/Invoice No.</label>
                          <input type="text" class="form-control" id="referenceNumber" placeholder="Enter Ref-Invoice">
                        </div>
                        <div class="col-md-5">
                          <label for="agent" class="form-label">Agent</label>
                          <select class="form-select" id="agent">
                              <option selected>Select Agent</option>
                              <option value="1">Agent 1</option>
                              <option value="2">Agent 2</option>
                          </select>
                      </div>
                      <div class="col-md-3">
                          <label for="fromDate" class="form-label">From Date</label>
                          <input type="date" class="form-control" id="fromDate">
                      </div>
                      <div class="col-md-3 my-3">
                          <label for="toDate" class="form-label">To Date</label>
                          <input type="date" class="form-control" id="toDate">
                      </div>
                      <div class="col-md-2 d-flex align-items-end my-3">
                          <button type="button" class="btn btn-primary me-2">Search</button>
                      </div>
                  </div>
              </form>
              <!-- Add Button -->


              <div class="container pt-5">
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
                <th>Ref. No.</th>
                <th>Invoice No.</th>
                <th>Company Name</th>
                <th>Guest Name</th>
                <th>Tour Name</th>
                <th>Tour Date</th>
                <th>Pickup Time</th>
                <th>Duration</th>
                <th>Cost AED</th>
                <th>Sale AED</th>
                <th>TAX AED</th>
                <th>Gross Profit AED</th>
                <th>Supplier</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1009</td>
                <td>560234</td>
                <td>Oasis Travellers</td>
                <td>Rahul Verma</td>
                <td>Dubai</td>
                <td>1-9-2024</td>
                <td>10:00</td>
                <td>4</td>
                <td>1200</td>
                <td>1400</td>
                <td>2900</td>
                <td>45000</td>
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
<?php include('includes/footer.php');?>
</body>

</html>
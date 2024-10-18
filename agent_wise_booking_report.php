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
          <h1 class="breadcrumb-item"><a href="#">Agent wise Booking Report</a></h1>
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
                              <label for="bookingId" class="form-label">Agent</label>
                              <select class="form-select" id="selectCompany">
                                <option selected>Select Agent</option>
                                <option value="United States">Agent 1</option>
                                <option value="Afghanistan">Agent 2</option>
                                <option value="Albania">Agent 3</option>
                                <option value="Algeria">Agent 4</option>
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
            <tr>
                <th>Sr#</th>
                <th>Agent Name</th>
                <th>Booking</th>
                <th>Booking (USD)</th>
                <th>Collect (USD)</th>
                <th>Balance (USD)</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Nitesh</td>
                <td>Dubai</td>
                <td>$2400</td>
                <td>$1600</td>
                <td>$3500</td>
                <td class="action-buttons">
                    <button type="button" class="btn btn-primary btn-sm"><span class="fas fa-edit"></span></button>
                    <button type="button" class="btn btn-danger btn-sm"><span class="bi-trash"></span></button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

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
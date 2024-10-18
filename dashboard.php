<!--start header-->
<?php 
include 'includes/header.php';
include 'includes/sidebar.php';
 ?>
<!--end header -->

 
  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <h1 class="breadcrumb-item active">Dashboard</h1>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
       <div class="col-lg-12">
          <div class="row">
    </div>
</div>              

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">
            <div class="container">
        <div class="col-lg-6">
            <div class="input-group">
 
                <select id="listsearch" class="form-select" style="width:40%">
                    <option value="0">Select Filter</option>
                    <option value="name">Visa Expired Details</option>
                    <option value="id">Today Booking Details</option>
                    <option value="birthday"></option>
                </select>
 
                <input type="text" id="myCustomSearchBox" style="width:40%;" class="form-control" placeholder="Search Anything here">
  
                <span class="input-group-btn">
                <button class="btn btn-primary">Search</button>
				      </span>
            </div>
        </div>
    </div>
    </div>
            <!-- End Customers Card -->
             <!--datatable div starts here-->
    <div style="margin-top: 30px; overflow-x:auto;">
        <table id="myTable" class="table table-hover">
            <thead>
                <tr class="bg-primary">
                    <th style="color:#fff;">Nationality</th>
                    <th style="color:#fff;">visa Type</th>
                    <th style="color:#fff;">Adult Cost</th>
                    <th style="color:#fff;">Adult Sell</th>
                    <th style="color:#fff;">Child Cost</th>
                    <th style="color:#fff;">Child Sell</th>
                    <th style="color:#fff;">Visa Expire Date</th>
                    <th style="color:#fff;">Expire Days</th>
                </tr>
            </thead>
 
            <tbody>
                <tr>
                    <td>Indian</td>
                    <td>Indian</td>
                    <td>5000</td>
                    <td>4300</td>
                    <td>3400</td>
                    <td>1700</td>
                    <td>12/07/2024</td>
                    <td>70 days</td>
                </tr>
                <tr>
                    <td>Indian</td>
                    <td>Indian</td>
                    <td>5000</td>
                    <td>4300</td>
                    <td>3400</td>
                    <td>1700</td>
                    <td>12/07/2024</td>
                    <td>70 days</td>
                </tr>
                <tr>
                    <td>Indian</td>
                    <td>Indian</td>
                    <td>5000</td>
                    <td>4300</td>
                    <td>3400</td>
                    <td>1700</td>
                    <td>12/07/2024</td>
                    <td>70 days</td>
                </tr>
            </tbody>
        </table>
    </div>


            <!--Start Bookings-->
            <div class="col-xxl-4 col-xl-12">

              
            </div>
            <!--End Bookings-->

          <!-- Booking Amount Start -->
          <div class="row text-white rounded-lg p-4 mt-0 mx-auto" style="background: linear-gradient(to right, #16700e, #4d2969);">
            <div class="col text-center ">
              <div class="h6">Total Booking Amount</div>
              <div class="h3 font-weight-bold">419.18</div>
            </div>
            <div class="col text-center">
              <div class="h6">Total Receive Amount</div>
              <div class="h3 font-weight-bold">306.85</div>
            </div>
            <div class="col text-center">
              <div class="h6">Total Balance Amount</div>
              <div class="h3 font-weight-bold">112.33</div>
            </div>
          </div>
          <!-- Booking Amount End -->
       
                      
        
            <!-- Reports -->
            <!--<div class="col-12 my-5">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>-->

                  <!-- Line Chart -->
                <!--<div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>-->
                  <!-- End Line Chart -->
             <!--</div>

              </div>
            </div>-->
            <!-- End Reports -->


            <!-- Top Selling -->
            <!--<div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                  <h5 class="card-title">Top Selling <span>| Today</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Preview</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Revenue</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
                        <td>$64</td>
                        <td class="fw-bold">124</td>
                        <td>$5,828</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-2.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>
                        <td>$46</td>
                        <td class="fw-bold">98</td>
                        <td>$4,508</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-3.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>
                        <td>$59</td>
                        <td class="fw-bold">74</td>
                        <td>$4,366</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-4.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>
                        <td>$32</td>
                        <td class="fw-bold">63</td>
                        <td>$2,016</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-5.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>
                        <td>$79</td>
                        <td class="fw-bold">41</td>
                        <td>$3,239</td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>-->
            <!-- End Top Selling -->
            </div>
        </div>
        <!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <!--<div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <a href="#" class="fw-bold text-dark">Visa Type</a>
                  </div>
                </div>-->
                <!-- End activity item-->

               <!--<div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    <a href="#"class="fw-bold text-dark">Total Hotels</a> 
                  </div>
                </div>-->
                <!-- End activity item-->

                <!--<div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                     <a href="#" class="fw-bold text-dark">Bookings</a>
                  </div>
                </div>-->
                <!-- End activity item-->

                <!--<div class="activity-item d-flex">
                  <div class="activite-label">1 day</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                   <a href="#" class="fw-bold text-dark">Complete Payment Booking</a>
                  </div>
                </div>--><!-- End activity item-->

                <!--<div class="activity-item d-flex">
                  <div class="activite-label">2 days</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    <a href="#" class="fw-bold text-dark">Pending Payment Booking</a>
                  </div>
                </div>--><!-- End activity item-->

                <!--<div class="activity-item d-flex">
                  <div class="activite-label">4 weeks</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    <a href="#" class="fw-bold text-dark">Total Receive Amount</a>
                  </div>
                </div>-->
                <!-- End activity item-->

             <!--</div>

            </div>
          </div>-->
          <!-- End Recent Activity -->

          <!-- Budget Report -->
          <!--<div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Budget Report <span>| This Month</span></h5>

              <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                      data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                      // shape: 'circle',
                      indicator: [{
                          name: 'Sales',
                          max: 6500
                        },
                        {
                          name: 'Administration',
                          max: 16000
                        },
                        {
                          name: 'Information Technology',
                          max: 30000
                        },
                        {
                          name: 'Customer Support',
                          max: 38000
                        },
                        {
                          name: 'Development',
                          max: 52000
                        },
                        {
                          name: 'Marketing',
                          max: 25000
                        }
                      ]
                    },
                    series: [{
                      name: 'Budget vs spending',
                      type: 'radar',
                      data: [{
                          value: [4200, 3000, 20000, 35000, 50000, 18000],
                          name: 'Allocated Budget'
                        },
                        {
                          value: [5000, 14000, 28000, 26000, 42000, 21000],
                          name: 'Actual Spending'
                        }
                      ]
                    }]
                  });
                });
              </script>
            </div>
          </div>-->
          <!-- End Budget Report -->

          
          
          <!-- News & Updates Traffic -->
          <!--<div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

              <div class="news">
                <div class="post-item clearfix">
                  <img src="assets/img/news-1.jpg" alt="">
                  <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                  <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-2.jpg" alt="">
                  <h4><a href="#">Quidem autem et impedit</a></h4>
                  <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-3.jpg" alt="">
                  <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-4.jpg" alt="">
                  <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                  <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-5.jpg" alt="">
                  <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                  <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                </div>

              </div>-->
              <!-- End sidebar recent posts-->

            <!--</div>
          </div>-->
          <!-- End News & Updates -->

        <!--</div>--><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  <script type="text/javascript">
    dTable = $('#myTable').DataTable({
        "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
        "lengthMenu": [4], // 4 records will be shown in the table
        "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
            } //columnDefs for align text to center
        ],
        "dom": "lrtip" //to hide default searchbox but search feature is not disabled hence customised searchbox can be made.
    });
 
    $('#myCustomSearchBox').keyup(function() {
        dTable.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
    })
</script>
  <!--footer start-->
  <?php include 'includes/footer.php';?>
  <!--footer end-->

</body>

</html>
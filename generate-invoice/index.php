<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
</head>

<body>
  <!-- Latest compiled and minified CSS -->      
<div class="tab-pane" id="invoice" role="tabpanel">
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
            <button class="btn btn-primary" id="generate-invoice-id" >Generate Invoice</button>
           
        </div>
    </div>
</div>
 <!-- Invoice Output Section (Hidden initially) -->

    <!-- new code starts here -->
  

 <!-- <div id="invoiceOutput" style="margin-top:20px;display:none" >
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

</div> -->



<!-- External JS libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="generate-invoice/getInvoice.js"></script>
<script src="generate-invoice/invoiceHelper.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
      // Function to add a new row once the DOM is fully loaded
      addNewRow();

      // Attach click event listener to the button after the DOM is ready
      document.getElementById('generate-invoice-id').addEventListener('click', generateInvoice);

      // Call other functions after the DOM is ready
      generateInvoiceNumber();
      formatDateTime();
  });
</script>

</body>
</html>
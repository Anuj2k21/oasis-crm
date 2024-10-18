// calculate Total starts
function calculateTotal() {
  const units = document.getElementById("units").value;
  const rate = document.getElementById("finalRate").value;
  const totalAmount = units * rate;
  document.getElementById("totalAmount").value = totalAmount;
  document.getElementById("total").value = totalAmount;

  const total = parseFloat(document.getElementById("total").value) || 0;
  const serviceCharge =
    parseFloat(document.getElementById("serviceCharge").value) || 0;
  const gstPercentage = parseFloat(document.getElementById("gst").value) || 0;
  const tcsTdsPercentage =
    parseFloat(document.getElementById("tcsTds").value) || 0;
  const gstAmount = (total * gstPercentage) / 100;
  document.getElementById("gstAmount").value = gstAmount;
  const tcsTdsAmount = (total * tcsTdsPercentage) / 100;
  document.getElementById("tcsTds_amount").value = tcsTdsAmount;
  const grandTotal = total + serviceCharge + gstAmount + tcsTdsAmount;
  document.getElementById("grandTotal").value = grandTotal;
}

// calculate total ends
//Invoice Tab Value Dynamic end

// Generate Invoice javascript code start

function generateInvoice() {
  const newWindow = window.open("", "_blank");

  // Fetch dynamic values from input fields
  const date = document.getElementById("dateTime").textContent; // Change to textContent to get the formatted date
  const invoiceNumber = document.getElementById("invoiceNumber").textContent; // Ensure this is correct
  const description = document.getElementById("description").value;
  const travellerType = document.getElementById("travellerType").value;
  const units = document.getElementById("units").value;
  const finalRate = document.getElementById("finalRate").value;
  const totalAmount = document.getElementById("totalAmount").value;
  const billTotal = document.getElementById("total").value; // Make sure this is defined properly
  const gstAmount = document.getElementById("gstAmount").value; // Get GST amount dynamically
  const grandTotal = document.getElementById("grandTotal").value;

  newWindow.document.write(`
   <html>
    <head>
        <title>Invoice</title>
        <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
         font-family: 'Poppins', sans-serif;
            @page {
                size: A4;
                margin: 20mm;
            }
        </style>
    </head>
    <body>
        <div id="invoiceOutput" style="margin-top: 20px; backgroundColor:white;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top">
                        <table width="720" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="border: #663366 2px solid; padding: 1px;">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
                                                    <tr>
                                                        <td align="center">
                                                            <h3 style="font-weight:900">
                                                                <span style="position: absolute;">PERFORMA INVOICE</span>
                                                            </h3>
                                                        </td>
                                                        <td style="text-align: right !important;">
                                                            <img src="http://oasistraveller.com/images/oasis.png" style="width: 300px; height: 60px;" />
                                                            <br />
                                                            <b> GSTIN: 09AAGFO2795N1ZH</b>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-left: 1px !important; border-right: 1px !important;">
                                                    <tr style="background-color: #276fae !important; font-weight: 700; color: whitesmoke !important;">
                                                        <td colspan="2" style="text-align: center; background-color: #276fae !important; color: whitesmoke !important;">
                                                            <h4 style="font-weight: 700;">Travel Partner (Agent) & Customer Information</h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="41%" style="text-align: left;" valign="bottom">
                                                            <b>Invoice No :</b> <strong>${invoiceNumber}</strong>
                                                            <hr />
                                                        </td>
                                                        <td width="59%" style="text-align: right;" valign="bottom">
                                                            <b>Invoice Date :</b> <strong>${date}</strong>
                                                            <hr />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <table width="100%" style="font-weight: bold; line-height: 1; padding: 0; margin-top: 0;">
                                                                <tr>
                                                                    <td width="30%">Booking Ref No</td>
                                                                    <td width="3%">:</td>
                                                                    <td width="67%">30858</td>
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
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <table border="0" width="100%" style="font-weight: bold;">
                                                                <tr style="background-color: white !important">
                                                                    <td width="30%">Traveller Name</td>
                                                                    <td width="5%">:</td>
                                                                    <td width="65%">Gunjankumar Nikunjkumar Patel</td>
                                                                </tr>
                                                                <tr style="background-color: white !important">
                                                                    <td>Hotel Name</td>
                                                                    <td>:</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Traveller Count</td>
                                                                    <td>:</td>
                                                                    <td>1</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Traveller Date</td>
                                                                    <td>:</td>
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
                                                <table border="1" width="100%" cellpadding="5" cellspacing="0" style="border-left: 0px !important; border-right: 0px !important; border-top: 0px !important; border-bottom: 0px !important;">
                                                    <thead>
                                                        <tr style="background: #276fae; color: whitesmoke; font-weight: 700;">
                                                            <th>Description</th>
                                                            <th>Traveller</th>
                                                            <th>Units</th>
                                                            <th>Final Rate</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background-color: white !important">
                                                            <td rowspan="1" width="50%" height="auto" style="border-right: 1px solid gray;">
                                                                <p>${description}</p>
                                                            </td>
                                                            <td style="text-align: left; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${travellerType}</span>
                                                            </td>
                                                            <td style="text-align: right; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${units}</span>
                                                            </td>
                                                            <td style="text-align: right; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${finalRate}</span>
                                                            </td>
                                                            <td style="text-align: right; vertical-align: top; border-right: 1px solid gray;">
                                                                <span>${totalAmount}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0 !important;">
                                                <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-left: 1px !important; border-right: 1px !important; border-bottom: 1px !important; background-color: #ebf2f5;">
                                                    <tr>
                                                        <td width="75%" style="text-align: center; vertical-align: middle;" valign="top">
                                                            <div>
                                                                <b>
                                                                    <h3>Thank you for your business!</h3>
                                                                </b>
                                                            </div>
                                                        </td>
                                                        <td width="25%">
                                                            <div>
                                                                <b>
                                                                    <table border="0" style="font-weight: bolder; background-color: #ebf2f5;">
                                                                        <tr>
                                                                            <td style="text-align: left;">Bill Total </td>
                                                                            <td>:</td>
                                                                            <td>${billTotal}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left;">Service Charge</td>
                                                                            <td>:</td>
                                                                            <td style="text-align: right;">0.0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left;">IGST (0%)</td>
                                                                            <td>:</td>
                                                                            <td style="text-align: right;">${gstAmount}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left;">Grand Total</td>
                                                                            <td>:</td>
                                                                            <td style="text-align: right;">${grandTotal}</td>
                                                                        </tr>
                                                                    </table>
                                                                </b>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-left: 1px !important; border-right: 1px !important; border-bottom: 1px !important;">
                                                    <tr>
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <h4 class="head" style="text-align: center !important; background:#276fae; color:whitesmoke; padding:7px">ICICI BANK DETAILS - OASIS TRAVELLER</h4>
                                                           
                                                            <div style="ml-2">
                                                                Bank Name - ICICI BANK | Account Type - CURRENT ACCOUNT<br />
                                                                Currency - INR | Account Name - OASIS TRAVELLER<br />
                                                                Account Number - 645005002895 | Branch Name - 3530<br />
                                                                IFSC Code - ICIC0003530
                                                            </div>
                                                        </td>
                                                        <td width="50%" style="text-align: left;" valign="top">
                                                            <h4 class="head" style="text-align: center !important; background:#276fae; color:whitesmoke; padding:6px">HDFC BANK DETAILS - OASIS DMC PVT LTD</h4>
                                                          
                                                            <div style="ml-2">
                                                                Bank Name - HDFC BANK | Account Type - CURRENT ACCOUNT<br />
                                                                Currency - INR | Account Name - OASIS DMC PVT LTD<br />
                                                                Account Number - 50200057126112 | Branch Name - 2623<br />
                                                                IFSC Code - HDFC0002623
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="head" align="center" style="border: 1px solid !important;  background:#276fae; color:whitesmoke; padding:7px">
                                                <strong>INR Invoice is valid for same (current) date only.</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="head" align="center" style="border: 1px solid !important;  background:#276fae; color:whitesmoke; padding:7px">
                                                <strong>Inconsistency, if any, must be informed to us in inscription within 2 days.</strong>
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
    </body>
</html>

    `);

  newWindow.document.close();
  newWindow.focus();
  newWindow.print();
}

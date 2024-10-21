const savePaymentInfo = async (data) => {
  try {
    const response = await fetch("api/booking/received-amount.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    const result = await response.json();

    if (result.status === "success") {
      alert("Data inserted successfully!");
    } else {
      alert("Error: " + result.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("There was an error saving the data.");
  }
};

const savePayment = async () => {
  const ref_no = document.getElementById("reference-display").innerText;
  const company_name = document.getElementById("company-display").innerText;
  const agentName = document.getElementById("agent-display").innerText;
  const total_aed = +document.getElementById("total_bill_aed").innerText;
  const total_inr = +document.getElementById("total_bill_inr").innerText;
  const total_received_aed = +document.getElementById("received_aed").innerText;
  const total_received_inr = +document.getElementById("received_inr").innerText;
  const total_pending_aed = +document.getElementById("pending_aed").innerText;
  const total_pending_inr = +document.getElementById("pending_inr").innerText;
  await savePaymentInfo({
    ref_no,
    company_name,
    total_aed,
    total_inr,
    total_received_aed,
    total_received_inr,
    total_pending_aed,
    total_pending_inr,
    status: "Pending",
  });
};

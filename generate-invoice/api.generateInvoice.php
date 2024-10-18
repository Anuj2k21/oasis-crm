<?php 
 include('../includes/config.php');  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if (!isset($_GET['reference_number'])) {
    echo json_encode(['status' => 'error', 'message' => 'No reference number provided!']);
    exit;
}

$reference_number = $_GET['reference_number'];
$sql = "SELECT reference_number, company_name, agent_name, address, country, city, contact, sold_by, gstin_no, guest_name, destination_country, destination_city, hotel_name, hotel_address, hotel_contact_no, room_no, whatsapp_no, emergency_no, adults, children, infants FROM agent_info WHERE reference_number = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Statement preparation failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param('s', $reference_number);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $hotelData = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['status' => 'success', 'data' => $hotelData]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records found for the provided reference number']);
}
$stmt->close();
$conn->close();
?>

<?php 
 include('../includes/config.php');  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method!']);
    exit;
}

    $required_fields = [
    'company_name', 'ref_no', 'total_aed', 'total_inr', 
    'total_received_aed', 'total_received_inr', 
    'total_pending_aed', 'total_pending_inr', 'status',
];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        echo json_encode(['status' => 'error', 'message' => "Field '$field' is required!"]);
        exit;
    }
}

$company_name = $_POST['company_name'];
$ref_no = $_POST['ref_no'];
$total_aed = $_POST['total_aed'];
$total_inr = $_POST['total_inr'];
$total_received_aed = $_POST['total_received_aed'];
$total_received_inr = $_POST['total_received_inr'];
$total_pending_aed = $_POST['total_pending_aed'];
$total_pending_inr = $_POST['total_pending_inr'];
$status = $_POST['status'];

$sql = "INSERT INTO agent_info (company_name, ref_no, total_aed, total_inr, total_received_aed, total_received_inr, total_pending_aed, total_pending_inr, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Statement preparation failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param('ssdddddds', 
    $company_name, $ref_no, $total_aed, $total_inr, 
    $total_received_aed, $total_received_inr, 
    $total_pending_aed, $total_pending_inr, $status
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data insertion failed: ' . $stmt->error]);
}
$stmt->close();
$conn->close();
?>

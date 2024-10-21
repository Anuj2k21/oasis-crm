<?php include('../../includes/config.php');  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if (!isset($conn)) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection not established.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method!']);
    exit;
}

// Get the raw POST data (JSON)
$input = file_get_contents('php://input');
$data = json_decode($input, true);




$required_fields = [
    'company_name', 'ref_no', 'total_aed', 'total_inr', 
    'total_received_aed', 'total_received_inr', 
    'total_pending_aed', 'total_pending_inr', 'status',
];

// Validate the JSON data
foreach ($required_fields as $field) {
    if (!isset($data[$field]) || (is_string($data[$field]) && trim($data[$field]) === '')) {
        echo json_encode(['status' => 'error', 'message' => "Field '$field' is required!"]);
        exit;
    }
}

$company_name = $data['company_name'];
$ref_no = $data['ref_no'];
$total_aed = $data['total_aed'];
$total_inr = $data['total_inr'];
$total_received_aed = $data['total_received_aed'];
$total_received_inr = $data['total_received_inr'];
$total_pending_aed = $data['total_pending_aed'];
$total_pending_inr = $data['total_pending_inr'];
$status = $data['status'];

$sql = "INSERT INTO payments (company_name, ref_no, total_aed, total_inr, total_received_aed, total_received_inr, total_pending_aed, total_pending_inr, status) 
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

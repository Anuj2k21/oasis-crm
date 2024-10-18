 <?php include('includes/config.php');
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || empty($data['hotelData'])) {
    die(json_encode(['status' => 'error', 'message' => 'No data received!']));
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO booking_hotel (supplier, hotel, rooms, room_type, meal_type, check_in, check_out, deadline, cost_aed, sell_aed, gross_profit, reference_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die(json_encode(['status' => 'error', 'message' => 'Statement preparation failed!']));
}

foreach ($data['hotelData'] as $row) {
    $stmt->bind_param(
        'ssisssssddds', // s: string, i: integer, d: double (decimal)
        $row['supplier'],
        $row['hotel'],
        $row['rooms'],
        $row['room_type'],
        $row['meal_type'],
        $row['check_in'],
        $row['check_out'],
        $row['deadline'],
        $row['cost_aed'],
        $row['sell_aed'],
        $row['gross_profit'],
        $row['reference_number']
    );

    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Error inserting data: ' . $stmt->error]);
        exit;
    }
}

$stmt->close();
$conn->close();

// Success response
echo json_encode(['status' => 'success', 'message' => 'Data saved successfully!']);
?>

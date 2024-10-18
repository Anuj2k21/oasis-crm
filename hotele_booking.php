<?php
$host = 'localhost';
$dbname = 'payment_collection';
$username = 'root';
$password = '';


// Handle form submission if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!empty($data['bookings'])) {
        foreach ($data['bookings'] as $booking) {
            $supplier = $conn->real_escape_string($booking['supplier']);
            $hotel = $conn->real_escape_string($booking['hotel']);
            $rooms = (int)$booking['rooms'];
            $room_type = $conn->real_escape_string($booking['room_type']);
            $meal_type = $conn->real_escape_string($booking['meal_type']);
            $check_in = $conn->real_escape_string($booking['check_in']);
            $check_out = $conn->real_escape_string($booking['check_out']);
            $deadline = $conn->real_escape_string($booking['deadline']);
            $cost = (float)$booking['cost'];
            $sell = (float)$booking['sell'];
            $gross_profit = (float)$booking['gross_profit'];

            // Insert into the database
            $sql = "INSERT INTO hotel_bookings (supplier, hotel, rooms, room_type, meal_type, check_in, check_out, deadline, cost, sell, gross_profit)
                    VALUES ('$supplier', '$hotel', $rooms, '$room_type', '$meal_type', '$check_in', '$check_out', '$deadline', $cost, $sell, $gross_profit)";

            if (!$conn->query($sql)) {
                echo json_encode(['success' => false, 'error' => $conn->error]);
                exit;
            }
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No data received']);
    }

    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5">Hotel Booking</h2>

    <form id="hotelBookingForm">
        <div class="table-container mt-3">
            <table class="table table-bordered" id="booking_hotel">
                <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Hotel</th>
                        <th>Rooms</th>
                        <th>Room Type</th>
                        <th>Meal Type</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Deadline</th>
                        <th>Cost(AED)</th>
                        <th>Sell(AED)</th>
                        <th>Gross Profit</th>
                        <th class="text-center">
                            <button class="btn btn-success btn-sm" id="addRowBtn-1">Add</button>
                        </th>
                    </tr>
                </thead>
                <tbody id="hotelBookingBody">
                    <tr>
                        <td>
                            <select class="form-select" name="supplier" style="width:200px;">
                                <option selected disabled>Select Supplier</option>
                                <!-- Replace with dynamic supplier options -->
                                <option value="Supplier 1">Supplier 1</option>
                                <option value="Supplier 2">Supplier 2</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="hotel" style="width:200px;">
                                <option selected disabled>Select Hotel</option>
                                <!-- Replace with dynamic hotel options -->
                                <option value="Hotel 1">Hotel 1</option>
                                <option value="Hotel 2">Hotel 2</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="rooms" style="width:100px;"></td>
                        <td>
                            <select class="form-select" name="room_type" style="width:200px;">
                                <option selected disabled>Select Room Type</option>
                                <!-- Replace with dynamic room type options -->
                                <option value="Room Type 1">Room Type 1</option>
                                <option value="Room Type 2">Room Type 2</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="meal_type" style="width:150px;">
                                <option selected disabled>Select Meal</option>
                                <!-- Replace with dynamic meal type options -->
                                <option value="Meal 1">Meal 1</option>
                                <option value="Meal 2">Meal 2</option>
                            </select>
                        </td>
                        <td><input type="date" class="form-control" name="check_in"></td>
                        <td><input type="date" class="form-control" name="check_out"></td>
                        <td><input type="date" class="form-control" name="deadline"></td>
                        <td><input type="text" class="form-control cost-input" name="cost"></td>
                        <td><input type="text" class="form-control sell-input" name="sell"></td>
                        <td><input type="text" class="form-control gross-profit-input" name="gross_profit" readonly></td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm deleteRowBtn-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button class="btn btn-primary" id="saveHotel" type="button">Save & Next</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hotelTableBody = document.getElementById('hotelBookingBody');
    const addRowBtn = document.getElementById('addRowBtn-1');

    // Function to calculate gross profit (Sell - Cost)
    function calculateGrossProfit() {
        const rows = document.querySelectorAll('#booking_hotel tbody tr');
        rows.forEach(row => {
            const costInput = row.querySelector('.cost-input');
            const sellInput = row.querySelector('.sell-input');
            const grossProfitInput = row.querySelector('.gross-profit-input');

            const cost = parseFloat(costInput.value) || 0;
            const sell = parseFloat(sellInput.value) || 0;
            const grossProfit = sell - cost;

            grossProfitInput.value = grossProfit.toFixed(2); // Set the calculated value
        });
    }

    // Function to dynamically add a new row
    function addRow() {
        const newRow = hotelTableBody.rows[0].cloneNode(true); // Clone the first row
        // Clear the input values in the new row
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        
        // Append the new row to the table body
        hotelTableBody.appendChild(newRow);

        // Reattach event listeners to the new row's inputs for calculation
        newRow.querySelectorAll('.sell-input, .cost-input').forEach(input => {
            input.addEventListener('input', calculateGrossProfit);
        });

        // Attach delete row functionality to the delete button
        attachDeleteListener(newRow);
    }

    // Function to delete a row
    function attachDeleteListener(row) {
        const deleteBtn = row.querySelector('.deleteRowBtn-1');
        deleteBtn.addEventListener('click', function () {
            row.remove();
        });
    }

    // Attach listeners to existing rows
    document.querySelectorAll('#hotelBookingBody tr').forEach(row => {
        row.querySelectorAll('.sell-input, .cost-input').forEach(input => {
            input.addEventListener('input', calculateGrossProfit);
        });
        attachDeleteListener(row); // Attach delete functionality
    });

    // Add new row on button click
    addRowBtn.addEventListener('click', function (e) {
        e.preventDefault();
        addRow(); // Add a new row when the "Add" button is clicked
    });

    // AJAX submission when Save & Next button is clicked
    document.getElementById('saveHotel').addEventListener('click', function () {
        const formData = [];
        const rows = document.querySelectorAll('#booking_hotel tbody tr');

        rows.forEach(row => {
            const supplier = row.querySelector('select[name="supplier"]').value;
            const hotel = row.querySelector('select[name="hotel"]').value;
            const rooms = row.querySelector('input[name="rooms"]').value;
            const roomType = row.querySelector('select[name="room_type"]').value;
            const mealType = row.querySelector('select[name="meal_type"]').value;
            const checkIn = row.querySelector('input[name="check_in"]').value;
            const checkOut = row.querySelector('input[name="check_out"]').value;
            const deadline = row.querySelector('input[name="deadline"]').value;
            const cost = row.querySelector('input[name="cost"]').value;
            const sell = row.querySelector('input[name="sell"]').value;
            const grossProfit = row.querySelector('input[name="gross_profit"]').value;

            formData.push({
                supplier: supplier,
                hotel: hotel,
                rooms: rooms,
                room_type: roomType,
                meal_type: mealType,
                check_in: checkIn,
                check_out: checkOut,
                deadline: deadline,
                cost: cost,
                sell: sell,
                gross_profit: grossProfit
            });
        });

        // Send the form data to the PHP script via AJAX
        fetch(' ', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ bookings: formData })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data saved successfully!');
                // Optionally, clear the form or redirect
            } else {
                alert('Failed to save data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>
</body>
</html>

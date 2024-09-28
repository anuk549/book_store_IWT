<?php
include '../connect.php'; // Database connection

// Get JSON input from the request body
$input = json_decode(file_get_contents('php://input'), true);

$cart_id = $input['cart_id'];
$qty = $input['qty'];

// Validate cart_id and qty
if (isset($cart_id) && isset($qty) && $qty > 0) {
    // Update the quantity in the database
    $stmt = $conn->prepare("UPDATE cart SET qty = ? WHERE cart_id = ?");
    $stmt->bind_param("ii", $qty, $cart_id);
    
    if ($stmt->execute()) {
        // Return a success response
        echo json_encode(['success' => true]);
    } else {
        // Return an error response
        echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
    }
} else {
    // Invalid request data
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>

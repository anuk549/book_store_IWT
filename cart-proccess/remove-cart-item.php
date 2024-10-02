<?php
include '../connect.php'; // Database connection

// Get JSON input from the request body
$input = json_decode(file_get_contents('php://input'), true);

$cart_id = $input['cart_id'];

// Validate cart_id
if (isset($cart_id)) {
    // Delete the item from the cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->bind_param("i", $cart_id);
    
    if ($stmt->execute()) {
        // Return a success response
        echo json_encode(['success' => true]);
    } else {
        // Return an error response
        echo json_encode(['success' => false, 'message' => 'Failed to delete item']);
    }
} else {
    // Invalid request data
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>

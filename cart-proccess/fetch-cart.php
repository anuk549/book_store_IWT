<?php
include '../connect.php';
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Get the user ID based on the email
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Fetch cart items for this user from the database
        $cartQuery = "SELECT cart.cart_id, cart.qty, books.title, books.price
                      FROM cart
                      JOIN books ON cart.books_id = books.id
                      WHERE cart.users_id = $user_id";
        $cartResult = $conn->query($cartQuery);

        $cartItems = [];

        // Fetch all cart items into an array
        while ($cartRow = $cartResult->fetch_assoc()) {
            $cartItems[] = $cartRow;
        }

        // Return the cart data as JSON
        echo json_encode($cartItems);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>

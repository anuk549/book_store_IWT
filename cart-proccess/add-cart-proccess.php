<?php
include '../connect.php';
session_start();

if (isset($_SESSION["email"])) {
    $user_email = $_SESSION['email'];
    $book_id = $_GET["book_id"];

    // Check if the book already exists in the cart
    $checkIfExist = "SELECT * FROM cart INNER JOIN users ON cart.users_id = users.id INNER JOIN books ON cart.books_id = books.id WHERE email='$user_email' AND books_id='$book_id'";
    $result1 = $conn->query($checkIfExist);

    if ($result1->num_rows > 0) {
        // Book is already in the cart
        echo json_encode(['status' => 'error', 'message' => 'Book already added to cart!']);
    } else {
        // Get user ID
        $checkUsersTable = "SELECT * FROM users WHERE email='$user_email'";
        $result2 = $conn->query($checkUsersTable);
        $row2 = $result2->fetch_assoc();
        $u_id = $row2['id'];

        // Add book to the cart
        $addBookSql = "INSERT INTO cart (users_id, books_id, qty) VALUES ('$u_id', '$book_id', '1')";
        if ($conn->query($addBookSql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Book added to cart successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add book to cart!']);
        }
    }
} else {
    // User not logged in
    echo json_encode(['status' => 'error', 'message' => 'Please sign in first.']);
}
?>

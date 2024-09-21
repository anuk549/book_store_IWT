<?php
session_start();
include("../connect.php");

// Check if the form was submitted
if (isset($_POST['submitReview']) && isset($_SESSION['email'])) {
    // Ensure the book ID is valid
    $bookId = intval($_POST['book_id']);
    if ($bookId <= 0) {
        die("Error: Invalid book ID.");
    }

    // Sanitize the review and rating inputs
    $review = mysqli_real_escape_string($conn, trim($_POST['review']));
    $rating = intval($_POST['rating']);

    if (empty($review)) {
        die("Error: Review cannot be empty.");
    }

    if ($rating < 1 || $rating > 5) {
        die("Error: Invalid rating.");
    }

    $userEmail = $_SESSION['email'];

    // Get user ID from email
    $userQuery = "SELECT id FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $userQuery);
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
    $userResult = mysqli_stmt_get_result($stmt);
    
    if (!$userResult) {
        die("Database query failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($userResult);
    
    if ($user) {
        $userId = $user['id'];

        // Check if the book exists
        $bookQuery = "SELECT id FROM books WHERE id=?";
        $stmt = mysqli_prepare($conn, $bookQuery);
        mysqli_stmt_bind_param($stmt, "i", $bookId);
        mysqli_stmt_execute($stmt);
        $bookResult = mysqli_stmt_get_result($stmt);
        
        if (!$bookResult || mysqli_num_rows($bookResult) == 0) {
            die("Error: Book ID does not exist.");
        }

        // Insert review into the database with rating
        $insertReviewQuery = "INSERT INTO user_reviews (user_id, book_id, review, rating) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertReviewQuery);
        mysqli_stmt_bind_param($stmt, "iisi", $userId, $bookId, $review, $rating);
        
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the review page with a success message
            header("Location: review.php?book_id=$bookId&message=Review submitted successfully");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: User not found.";
    }
} else {
    // Display error message if the user is not logged in
    if (!isset($_SESSION['email'])) {
        echo "Error: You must be logged in to submit a review.";
    }
}
?>

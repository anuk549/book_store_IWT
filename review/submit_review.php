<?php
session_start();
include("../connect.php");

if (isset($_POST['submitReview']) && isset($_SESSION['email'])) {
    $bookId = $_POST['book_id'];
    $review = $_POST['review'];
    $userEmail = $_SESSION['email'];

    // Get user id from email
    $userQuery = "SELECT id FROM users WHERE email='$userEmail'";
    $userResult = mysqli_query($conn, $userQuery);
    $user = mysqli_fetch_assoc($userResult);
    $userId = $user['id'];

    // Insert review into the database
    $insertReviewQuery = "INSERT INTO user_reviews (user_id, book_id, review) VALUES ('$userId', '$bookId', '$review')";
    if (mysqli_query($conn, $insertReviewQuery)) {
        header("Location: ../homepage.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

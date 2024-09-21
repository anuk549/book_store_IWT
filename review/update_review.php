<?php
session_start();
include("../connect.php");

if (isset($_POST['updateReview']) && isset($_SESSION['email'])) {
    $review_id = intval($_POST['review_id']);
    $new_review = mysqli_real_escape_string($conn, trim($_POST['review']));
    $new_rating = intval($_POST['rating']);
    $user_email = $_SESSION['email'];

    // Get the user id from the session's email
    $userQuery = "SELECT id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $userQuery);
    mysqli_stmt_bind_param($stmt, "s", $user_email);
    mysqli_stmt_execute($stmt);
    $userResult = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($userResult);

    if ($user) {
        $user_id = $user['id'];

        // Check if the review belongs to the logged-in user
        $query = "SELECT book_id FROM user_reviews WHERE id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $review_id, $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $bookId = $row['book_id'];

            // Update the review in the database
            $updateQuery = "UPDATE user_reviews SET review = ?, rating = ? WHERE id = ?";
            $updateStmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "sii", $new_review, $new_rating, $review_id);

            if (mysqli_stmt_execute($updateStmt)) {
                // Redirect back to the book's review page
                header("Location: review.php?book_id=$bookId&message=Review updated successfully");
                exit();
            } else {
                echo "Error updating review: " . mysqli_error($conn);
            }
        } else {
            echo "You are not authorized to edit this review.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request or session.";
}
?>

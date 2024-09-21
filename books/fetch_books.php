<?php
// Include database connection
include("connect.php");

// Fetch books
$booksQuery = "SELECT * FROM books";
$booksResult = mysqli_query($conn, $booksQuery);
$books = [];
if ($booksResult) {
    while ($row = mysqli_fetch_assoc($booksResult)) {
        $books[] = $row;
    }
}

// Fetch user reviews with ratings
$reviewsQuery = "SELECT user_reviews.book_id, user_reviews.review, user_reviews.rating, users.firstName, users.lastName 
                 FROM user_reviews 
                 JOIN users ON user_reviews.user_id = users.id";
$reviewsResult = mysqli_query($conn, $reviewsQuery);

$reviews = [];
if ($reviewsResult) {
    while ($row = mysqli_fetch_assoc($reviewsResult)) {
        $reviews[] = $row;
    }
}
?>

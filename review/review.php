<?php
session_start();
include("../connect.php");

// Fetch book details including image
$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;
$bookQuery = "SELECT title, author, image FROM books WHERE id = $book_id";
$bookResult = mysqli_query($conn, $bookQuery);
$book = mysqli_fetch_assoc($bookResult);

// Fetch reviews for the book, including rating
$reviewsQuery = "SELECT user_reviews.id, user_reviews.review, user_reviews.rating, users.firstName, users.lastName, users.email AS user_email
                 FROM user_reviews 
                 JOIN users ON user_reviews.user_id = users.id 
                 WHERE user_reviews.book_id = $book_id";
$reviewsResult = mysqli_query($conn, $reviewsQuery);
$reviews = [];
if ($reviewsResult) {
    while ($row = mysqli_fetch_assoc($reviewsResult)) {
        $reviews[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews for <?php echo htmlspecialchars($book['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <a href="../homepage.php" class="back-button">Back</a>
        <h2>Reviews for <?php echo htmlspecialchars($book['title']); ?> by
            <?php echo htmlspecialchars($book['author']); ?></h2>
        <img src="<?php echo htmlspecialchars('../' . $book['image']); ?>"
            alt="<?php echo htmlspecialchars($book['title']); ?>" class="book-image">
        <div class="reviews">
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <p><strong><?php echo htmlspecialchars($review['firstName']) . " " . htmlspecialchars($review['lastName']); ?>:</strong>
                        <?php echo htmlspecialchars($review['review']); ?></p>
                    <p>Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</p>
                    <?php if (isset($_SESSION['email']) && $_SESSION['email'] == $review['user_email']): ?>
                        <form action='edit_review.php' method='POST' class="inline-form">
                            <input type='hidden' name='review_id' value='<?php echo htmlspecialchars($review['id']); ?>'>
                            <input type='submit' name='editReview' value='Edit' class='edit-button'>
                        </form>
                        <form action='delete_review.php' method='POST' class="inline-form"
                            onsubmit='return confirm("Are you sure you want to delete this review?");'>
                            <input type='hidden' name='review_id' value='<?php echo htmlspecialchars($review['id']); ?>'>
                            <input type='submit' name='deleteReview' value='Delete' class='delete-button'>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($_SESSION['email'])): ?>
            <div class="review-form">
                <form action='submit_review.php' method='POST'>
                    <input type='hidden' name='book_id' value='<?php echo htmlspecialchars($book_id); ?>' />
                    <label>What's your experience:</label>
                    <input type='text' name='review' placeholder='Write your review...' class="review-input">
                    <div class="rating">
                        <label>Rating:</label>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <label>
                                <input type="radio" name="rating" value="<?php echo $i; ?>" required>
                                <?php echo $i; ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                    <input type='submit' name='submitReview' value='Submit Review' class='submit-button'>
                </form>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>
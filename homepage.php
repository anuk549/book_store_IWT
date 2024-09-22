<?php
session_start();
include("books/fetch_books.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="header">
        <?php include("login/header.php"); ?>
    </div>

    <div class="main-content">
        <h2 class="welcome-message">Welcome to Our Bookstore</h2>
        <div class="books">
            <?php
            foreach ($books as $book) {
                echo "<div class='book'>";
                echo "<img src='img/" . htmlspecialchars($book['image']) . "' alt='" . htmlspecialchars($book['title']) . "' class='book-image' />";
                echo "<p class='book-title'><strong>" . htmlspecialchars($book['title']) . "</strong></p>";
                echo "<p class='book-author'>by " . htmlspecialchars($book['author']) . "</p>";
                echo "<p class='book-description'>" . htmlspecialchars($book['description']) . "</p>";
                echo "<a href='review/review.php?book_id=" . htmlspecialchars($book['id']) . "' class='show-review-button'>Show Reviews</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>

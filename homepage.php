<?php
session_start();
include("books/fetch_books.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book store Homepage</title>
    <style>
        .book {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            width: 30%;
            vertical-align: top;
        }
        .book img {
            width: 100px;
            height: 150px;
        }
        .book p {
            font-size: 18px;
        }
        .review {
            border-top: 1px solid #ddd;
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
        }
        .review-form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div style="text-align:center; padding:5%;">
        <?php include("login/header.php"); ?>
    </div>

    <div style="text-align:center; padding:2%;">
        <h2>Welcome to Our Bookstore</h2>
        <div class="books">
            <?php
            foreach ($books as $book) {
                echo "<div class='book'>";
                echo "<img src='" . $book['image'] . "' alt='" . $book['title'] . "' />";
                echo "<p><strong>" . $book['title'] . "</strong></p>";
                echo "<p>by " . $book['author'] . "</p>";

                // Display recent reviews for this book
                echo "<div class='reviews'>";
                foreach ($reviews as $review) {
                    if ($review['book_id'] == $book['id']) {
                        echo "<div class='review'>";
                        echo "<p><strong>" . $review['firstName'] . " " . $review['lastName'] . ":</strong> " . $review['review'] . "</p>";
                        echo "</div>";
                    }
                }
                echo "</div>";

                // Review form for logged-in users
                if (isset($_SESSION['email'])) {
                    echo "<div class='review-form'>";
                    echo "<form action='review/submit_review.php' method='POST'>";
                    echo "<input type='hidden' name='book_id' value='" . $book['id'] . "' />";
                    echo "<textarea name='review' rows='4' cols='50' placeholder='Write your review...'></textarea><br>";
                    echo "<input type='submit' name='submitReview' value='Submit Review'>";
                    echo "</form>";
                    echo "</div>";
                }

                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>

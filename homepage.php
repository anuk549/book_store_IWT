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
    <script>
        function addToCart(bookId) {
            fetch('cart-proccess/add-cart-proccess.php?book_id=' + bookId)
                .then(response => response.json())
                .then(data => {
                    // Display popup message
                    const messageBox = document.getElementById('message-box');
                    messageBox.textContent = data.message;
                    messageBox.style.display = 'block';

                    // Automatically hide the message after 3 seconds
                    setTimeout(() => {
                        messageBox.style.display = 'none';
                    }, 3000);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</head>

<body>
    <div class="header">
        <?php include("header.php"); ?>
    </div>

    <!-- Popup Message Box -->
    <div id="message-box" class="message-box" style="display:none;"></div>

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
                echo "<button onclick='addToCart(" . htmlspecialchars($book['id']) . ")' class='add-cart-button'>Add Cart</button>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <?php include("footer.php"); ?>

    <!-- Styles for the message box -->
    <style>
        .message-box {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #28a745;
            /* Success green */
            color: #fff;
            border-radius: 5px;
            z-index: 1000;
            font-size: 16px;
            border: 1px solid #1e7e34;
            /* Darker green for the border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            /* 3D shadow effect */
            transition: all 0.3s ease-in-out;
            /* Smooth transition */
        }

        .message-box.error {
            background-color: #dc3545;
            /* Error red */
            border: 1px solid #b02a37;
            /* Darker red for the border */
        }

        .message-box:before {
            content: '';
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            border-radius: 8px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.5), rgba(0, 0, 0, 0.1));
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
            z-index: -1;
            /* Behind the message box */
        }
    </style>
</body>

</html>
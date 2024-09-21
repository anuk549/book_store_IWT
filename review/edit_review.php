<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <?php
        session_start();
        include("../connect.php");

        if (isset($_POST['editReview']) && isset($_SESSION['email'])) {
            $review_id = $_POST['review_id'];
            $user_email = $_SESSION['email'];

            // Get the user id from the session's email
            $userQuery = "SELECT id FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $userQuery);
            mysqli_stmt_bind_param($stmt, "s", $user_email);
            mysqli_stmt_execute($stmt);
            $userResult = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($userResult);
            $user_id = $user['id'];

            // Fetch the review content to display in the form
            $query = "SELECT review, rating FROM user_reviews WHERE id = ? AND user_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ii", $review_id, $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($review = mysqli_fetch_assoc($result)) {
                echo "<a href='../homepage.php' class='back-button'>Back</a>";

                // Display the edit form
                echo "<form action='update_review.php' method='POST' class='edit-review-form'>";
                echo "<h2>Edit Review</h2>";
                echo "<input type='hidden' name='review_id' value='" . htmlspecialchars($review_id) . "'>";
                echo "<textarea name='review' rows='4'>" . htmlspecialchars($review['review']) . "</textarea>";

                // Add rating selection
                echo "<label for='rating'>Rating:</label>";
                echo "<select name='rating' required>";
                for ($i = 1; $i <= 5; $i++) {
                    $selected = ($i == $review['rating']) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                echo "</select>";

                echo "<input type='submit' name='updateReview' value='Update Review'>";
                echo "</form>";
            } else {
                echo "You are not authorized to edit this review.";
            }
        } else {
            echo "Invalid request or session.";
        }
        ?>
    </div>
</body>

</html>
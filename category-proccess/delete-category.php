<?php
// Ensure the script only runs if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../connect.php");

    // Get the category ID from the request
    $categoryId = isset($_POST['categoryId']) ? intval($_POST['categoryId']) : 0;

    if ($categoryId > 0) {
        // SQL query to fetch the category details
        $query = "SELECT category_img FROM categories WHERE category_id = ?";
        
        // Prepare the SQL statement
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $categoryId); // Bind the category ID to the query

            // Execute the statement
            $stmt->execute();
            $stmt->bind_result($categoryImage);
            $stmt->fetch();
            $stmt->close();

            if ($categoryImage) {
                // Path to the image in the project folder
                $imagePath = $categoryImage;

                // Delete the image from the server if it exists
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }
            }

            // SQL query to delete the category from the database
            $queryDelete = "DELETE FROM categories WHERE category_id = ?";
            
            // Prepare the SQL statement
            if ($stmtDelete = $conn->prepare($queryDelete)) {
                $stmtDelete->bind_param("i", $categoryId); // Bind the category ID to the query

                if ($stmtDelete->execute()) {
                    // Send a success response if deletion was successful
                    echo json_encode(['success' => true]);
                } else {
                    // Send a failure response if deletion failed
                    echo json_encode(['success' => false, 'error' => 'Failed to delete category.']);
                }

                $stmtDelete->close();
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to prepare SQL statement for deletion.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to prepare SQL statement to fetch category details.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid category ID.']);
    }

    // Close the database connection
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>

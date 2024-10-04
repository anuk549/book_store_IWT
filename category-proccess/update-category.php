<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("../connect.php");

    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['categoryName'];
    $categoryImage = $_FILES['categoryImage']['name'];

    // If a new image is uploaded
    if ($categoryImage) {
        $imageTmp = $_FILES['categoryImage']['tmp_name'];
        $imagePath = "../img/category-img/" . basename($categoryImage);
        move_uploaded_file($imageTmp, $imagePath); // Move the uploaded image to the directory
    } else {
        $imagePath = $_POST['currentImage']; // If no new image, use the existing image
    }

    // Update the category in the database
    $query = "UPDATE categories SET category_name = ?, category_img = ? WHERE category_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $categoryName, $imagePath, $categoryId);
    $stmt->execute();

    // Redirect back to the categories page after success
    if ($stmt->affected_rows > 0) {
        header("Location: ../admin/dashboard.php");
    } else {
        echo "Error updating category.";
    }
}
?>

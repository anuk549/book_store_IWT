<?php
include("../connect.php");

if (isset($_POST['submitCategory'])) {
    $categoryName = $_POST['categoryName'];

    // Handle image upload
    $target_dir = "../img/category-img/";
    $imageFileType = strtolower(pathinfo(basename($_FILES["categoryImage"]["name"]), PATHINFO_EXTENSION));
    $target_file = $target_dir . uniqid() . "." . $imageFileType; // Unique name for the uploaded file

    // Check if the image file is a valid image
    $check = getimagesize($_FILES["categoryImage"]["tmp_name"]);
    if ($check !== false) {
        // Check if the file already exists
        if (file_exists($target_file)) {
            echo "file_exists";
            exit();
        }

        // Allow only certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "invalid_format";
            exit();
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $target_file)) {
            // Insert the category name and image filename into the database
            $sql = "INSERT INTO categories (category_name, category_img) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $categoryName, $target_file);

            if ($stmt->execute()) {
                // Return success response to the frontend
                echo "success";
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                echo "db_error";
            }
        } else {
            echo "upload_error";
        }
    } else {
        echo "not_image";
    }
} else {
    echo "invalid_request";
}
?>

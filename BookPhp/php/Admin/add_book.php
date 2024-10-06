<?php
session_start();
require "config.php";

if (isset($_POST["submit"])) {
    // Retrieve input values
    $book_name = $_POST["book_name"];
    $author = $_POST["author"];
    $publisher = $_POST["publisher"];
    $publication_date = $_POST["publication_date"];
    $isbn = $_POST["isbn"];
    $genre = $_POST["genre"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    // Handle image upload
    $fileName = $_FILES['image']['name'];
    $fileTempName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];
    $fileExt = explode(".", $fileName);
    $realFile = strtolower(end($fileExt));

    $target_dir = "../../images/";
    $target_file = $target_dir . time() . "-" . basename($_FILES["image"]["name"]);

    if (isset($_FILES["image"])) {
        $allowed = array('png', 'jpg', 'jpeg');

        if (in_array($realFile, $allowed)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "<script>alert('The file " . basename($_FILES["image"]["name"]) . " has been uploaded.');</script>";

                // SQL query to insert book data
                $sql = "INSERT INTO books (book_name, author, publisher, publication_date, ISBN, genre, price, quantity, description, image)
                        VALUES ('$book_name', '$author', '$publisher', '$publication_date', '$isbn', '$genre', '$price', '$quantity', '$description', '$target_file')"; 

                if ($con->query($sql)) {
                    $_SESSION['book_added'] = true;
                    header("Location: ./viewBook.php");
                    exit();
                } else {
                    echo '<script>alert("Error: Could not add the book. Please try again.");</script>';
                }

            } else {
                echo "Error while uploading your file.";
            }
        } else {
            echo '<script>alert("Wrong file type. Please re-enter details and upload a valid image.");</script>';
        }
    } else {
        echo "File not available";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="../../css/Admin/admin.css">
    <link rel="stylesheet" href="../../css/Admin/aditional.css">
</head>
<body>

<nav>
    <div id="logbtn">
        <a href="logout.php"><button class="log">Logout</button></a>
    </div>
</nav>

<div id="verticalnav">
    <div id="adminbanner">
        <img id="logo" src="../../images/logo1.png">
    </div>

    <ul>
        <li class="list"><a href="./dashboard.php"><img id="img1" src="../../images/homeicon.png"> Dashboard</a></li>                             
        <li class="list"><a href="./viewBook.php"><img id="img1" src="../../images/inventoryicon.png"> Administrators</a></li>
    </ul>
</div>

<form id="recipe" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div id="formdiv">

        <label class="formele">Book Name:</label><br><br>
        <input type="text" class="formele" id="book_name" name="book_name" required><br><br>

        <label class="formele">Author:</label><br><br>
        <input type="text" class="formele" id="author" name="author" required><br><br>

        <label class="formele">Publisher:</label><br><br>
        <input type="text" class="formele" id="publisher" name="publisher" required><br><br>

        <label class="formele">Publication Date:</label><br><br>
        <input type="date" class="formele" id="publication_date" name="publication_date" required><br><br>

        <label class="formele">ISBN:</label><br><br>
        <input type="text" class="formele" id="isbn" name="isbn" required><br><br>

        <label class="formele">Genre:</label><br><br>
        <input type="text" class="formele" id="genre" name="genre" required><br><br>

        <label class="formele">Price:</label><br><br>
        <input type="number" step="0.01" class="formele" id="price" name="price" required><br><br>

        <label class="formele">Quantity:</label><br><br>
        <input type="number" class="formele" id="quantity" name="quantity" required><br><br>

        <label class="formele">Description:</label><br><br>
        <textarea class="formele" id="description" name="description" required></textarea><br><br>

        <label class="formele">Book Cover Image:</label><br><br>
        <input type="file" id="img" name="image" required><br><br>

        <input type="submit" id="submit" name="submit" value="Add Book">
    </div>
</form>

<script src="../../js/bookAddedPopup.js"></script>
</body>
</html>
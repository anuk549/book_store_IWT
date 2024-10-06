

<?php
require "config.php";
$ID = $_GET["id"];

if(isset($_GET["id"])){
    $ID = $_GET["id"];
    $sql = "SELECT * FROM `books` WHERE `ID` = $ID";
    $res = $con->query($sql);
    if($res->num_rows > 0)
    {
        $row = $res->fetch_assoc();
        $book_name = $row['book_name'];
        $author = $row['author'];
        $publisher = $row['publisher'];
        $publication_date = $row['publication_date'];
        $isbn = $row['ISBN'];
        $genre = $row['genre'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $description = $row['description'];
        $url = $row['image'];
        $con->close();
    }
    else {
        header("Location: ./view_books.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../../css/Admin/admin.css">
    <link rel="stylesheet" href="../../css/Admin/aditional.css">
</head>
<body>

<nav>
    <div id="logbtn">
        <p id="note">Upate Book Details </p>
        <a href="logout.php"><button class="log">Logout</button></a>
    </div>
</nav>

<div id="verticalnav">
    <div id="adminbanner">
        <img id="logo" src="../../images/logo1.png">
    </div>

    <ul>
        <li class="list"><a href="./dashboard.php"><img id="img1" src="../../images/homeicon.png"> Dashboard</a></li>                             
        <li class="list"><a href="./viewBook.php"><img id="img1" src="../../images/inventoryicon.png"> View Books</a></li>
    </ul>
</div>

<form id="recipe" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$ID"; ?>">
    <div id="formdiv">
        <label class="formele">Book Name:</label><br><br>
        <input type="text" class="formele" id="book_name" name="book_name" required value="<?php echo $book_name; ?>"><br><br>

        <label class="formele">Author:</label><br><br>
        <input type="text" class="formele" id="author" name="author" required value="<?php echo $author; ?>"><br><br>

        <label class="formele">Publisher:</label><br><br>
        <input type="text" class="formele" id="publisher" name="publisher" required value="<?php echo $publisher; ?>"><br><br>

        <label class="formele">Publication Date:</label><br><br>
        <input type="date" class="formele" id="publication_date" name="publication_date" required value="<?php echo $publication_date; ?>"><br><br>

        <label class="formele">ISBN:</label><br><br>
        <input type="text" class="formele" id="isbn" name="isbn" required value="<?php echo $isbn; ?>"><br><br>

        <label class="formele">Genre:</label><br><br>
        <input type="text" class="formele" id="genre" name="genre" required value="<?php echo $genre; ?>"><br><br>

        <label class="formele">Price:</label><br><br>
        <input type="number" step="0.01" class="formele" id="price" name="price" required value="<?php echo $price; ?>"><br><br>

        <label class="formele">Quantity:</label><br><br>
        <input type="number" class="formele" id="quantity" name="quantity" required value="<?php echo $quantity; ?>"><br><br>

        <label class="formele">Description:</label><br><br>
        <textarea class="formele" id="description" name="description" required><?php echo $description; ?></textarea><br><br>

        <img src="<?php echo $url ?>" alt="Book Image" style="width:100px;height:125px;"><br><br>
        <input type="hidden" name="exurl" value="<?php echo $url; ?>"><br><br>
        
        <label class="formele">Change Book Cover Image:</label><br><br>
        <input type="file" id="img" name="image"><br><br>

        <input type="submit" id="submit" name="submit" value="Update Book">
    </div>
</form>

</body>

<?php
require "config.php";

if (isset($_POST["submit"])) {
    $book_name = $_POST["book_name"];
    $author = $_POST["author"];
    $publisher = $_POST["publisher"];
    $publication_date = $_POST["publication_date"];
    $isbn = $_POST["isbn"];
    $genre = $_POST["genre"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $exurl = $_POST["exurl"];

    // Handle image upload
    $fileName = $_FILES['image']['name'];
    $fileTempName = $_FILES['image']['tmp_name'];
    $fileExt = explode(".", $fileName);
    $realFile = strtolower(end($fileExt));

    $target_dir = "../../images/";
    $target_file = $target_dir . time() . "-" . basename($_FILES["image"]["name"]);

    if ($fileName) {
        $allowed = array('png', 'jpg', 'jpeg');
        if (in_array($realFile, $allowed)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Delete the old image
                unlink($exurl);
                $image_url = $target_file;
            } else {
                echo "Error uploading your file.";
                exit;
            }
        } else {
            echo '<script>alert("Invalid file type. Please upload PNG, JPG, or JPEG.");</script>';
            exit;
        }
    } else {
        $image_url = $exurl; // Use existing image if not changed
    }

    $sql = "UPDATE `books` SET 
                `book_name` = '$book_name',
                `author` = '$author',
                `publisher` = '$publisher',
                `publication_date` = '$publication_date',
                `ISBN` = '$isbn',
                `genre` = '$genre',
                `price` = '$price',
                `quantity` = '$quantity',
                `description` = '$description',
                `image` = '$image_url'
            WHERE `ID` = $ID";

    if ($con->query($sql)) {
        header("Location: ./viewBook.php");
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
}

?>

</html>

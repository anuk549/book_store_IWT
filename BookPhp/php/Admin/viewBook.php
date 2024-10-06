

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Inventory</title>
    <link rel="stylesheet" href="../../css/Admin/admin.css">
</head>

<body>

<nav>
    <img id="logo" src="../images/logo1.png">
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
        <li class="list"><a href="./viewBook.php"><img id="img1" src="../../images/inventoryicon.png"> Inventory</a></li>
    </ul>
</div>

<div class="topic">
    <h3>Book Inventory</h3>
    <hr>
</div>

<a id="new_recipe_btn" href="./add_book.php">Add Book</a>

<?php
include "config.php"; // Ensure this file connects to your database

$sql = "SELECT * FROM books"; // Fetching from the books table
$result = $con->query($sql);

echo("<table cellpadding='1' class='admintable' border='1'>");
echo("<tr>");
echo("<th>ID</th>");
echo("<th>Image</th>");
echo("<th>Book Name</th>");
echo("<th>Author</th>");
echo("<th>Publisher</th>");
echo("<th>Publication Date</th>");
echo("<th>ISBN</th>");
echo("<th>Genre</th>");
echo("<th>Price</th>");
echo("<th>Quantity</th>");
echo("<th>Description</th>");
echo("<th>Action</th>");
echo("</tr>");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $img = $row["image"]; // Adjust based on your column name
        echo("<tr>");
        echo("<td>".$row["id"]."</td>");
        echo("<td><img src='".$img."' height='125' width='100'></td>");
        echo("<td>".$row["book_name"]."</td>");
        echo("<td>".$row["author"]."</td>");
        echo("<td>".$row["publisher"]."</td>");
        echo("<td>".$row["publication_date"]."</td>");
        echo("<td>".$row["ISBN"]."</td>");
        echo("<td>".$row["genre"]."</td>");
        echo("<td>".$row["price"]."</td>");
        echo("<td>".$row["quantity"]."</td>");
        echo("<td>".$row["description"]."</td>");
        // echo("<td><a id='deletelink' href='./deleteBook.php?id=".$row['id']."'>Delete</a>  <a id='editlink' href='./editBook.php?id=".$row['id']."'>Edit</a></td>");
        echo("<td><div class='button-container'><a id='deletelink' href='./deleteBook.php?id=".$row['id']."'>Delete</a><a id='editlink' href='./editBook.php?id=".$row['id']."'>Edit</a></div></td>");
        echo("</tr>");
    }
    echo("</table>");
} else {
    echo("<tr><td colspan='12'>No books found</td></tr>");
}

$con->close();
?>
</body>
</html>

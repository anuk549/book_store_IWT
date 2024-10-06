<?php
include "config.php";

// Query to count the total number of books
$sql = "SELECT COUNT(*) AS bookcount FROM books";
$result = $con->query($sql);
$bookCount = ($result->num_rows > 0) ? $result->fetch_assoc()['bookcount'] : 0;

// Query to count the total number of unique authors
$sql = "SELECT COUNT(DISTINCT author) AS authorcount FROM books";
$result = $con->query($sql);
$authorCount = ($result->num_rows > 0) ? $result->fetch_assoc()['authorcount'] : 0;

// Query to get the price range and total quantity
$sql = "SELECT MIN(price) AS min_price, MAX(price) AS max_price, SUM(quantity) AS total_quantity, AVG(price) AS average_price FROM books";
$result = $con->query($sql);
$priceData = $result->fetch_assoc();

$minPrice = $priceData['min_price'] ? number_format((float)$priceData['min_price'], 2, '.', '') : 0.00;
$maxPrice = $priceData['max_price'] ? number_format((float)$priceData['max_price'], 2, '.', '') : 0.00;
$totalQuantity = $priceData['total_quantity'] ? $priceData['total_quantity'] : 0;
$averagePrice = $priceData['average_price'] ? number_format((float)$priceData['average_price'], 2, '.', '') : 0.00;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Dashboard</title>
    <link rel="stylesheet" href="../../css/Admin/admin.css">

</head>

<body>
    <nav>
        <div id="logbtn">
            <a href="logout.php"><button class="log">Logout</button></a>
        </div>
    </nav>

    <div id="verticalnav">
        <div id="adminbanner">
            <img id="logo" src="../../images/logo1.png" alt="Logo">
        </div>
        
        <ul>
            <li class="list"><a href="./dashboard.php"><img id="img1" src="../../images/homeicon.png" > Dashboard</a></li>                             
            <li class="list"><a href="./viewBook.php"><img id="img1" src="../../images/inventoryicon.png" > Inventory</a></li>
        </ul>
    </div> 

    <div id="dash">
        <div id="usercount" class="dash-card">
            <div class="card-content">
                <h2><?php echo $bookCount; ?></h2>
                <p>Total Books</p>
            </div>
            <div class="card-icon">
                <img src="../../images/bookicon.png" alt="Book Icon">
            </div>
        </div>

        <div id="nutricount" class="dash-card">
            <div class="card-content">
                <h2><?php echo $authorCount; ?></h2>
                <p>Unique Authors</p>
            </div>
            <div class="card-icon">
                <img src="../../images/authoricon.png" alt="Author Icon">
            </div>
        </div>

        <div id="admincount" class="dash-card">
            <div class="card-content">
                <h2>$<?php echo $minPrice; ?> - $<?php echo $maxPrice; ?></h2>
                <p>Price Range</p>
            </div>
            <div class="card-icon">
                <img src="../../images/priceicon.png" alt="Price Icon">
            </div>
        </div>

        <div id="officercount" class="dash-card">
            <div class="card-content">
                <h2><?php echo $totalQuantity; ?></h2>
                <p>Total Quantity</p>
            </div>
            <div class="card-icon">
                <img src="../../images/quantityicon.png" alt="Quantity Icon">
            </div>
        </div>

        <div id="nutricount" class="dash-card">
            <div class="card-content">
                <h2>15</h2>
                <p>New Arrival</p>
            </div>
            <div class="card-icon">
                <img src="../../images/averagepriceicon.png" alt="Average Price Icon">
            </div>



            
        </div>


        <div id="contacts" class="dash-card">
            <div class="card-content">
                <h2>3</h2>
                <p>OUT OF Stock</p>
            </div>
            <div class="card-icon">
                <img src="../../images/quantityicon.png" alt="Average Price Icon">
            </div>



            
        </div>

        <div id="officercount" class="dash-card">
            <div class="card-content">
                <h2>Fiction</h2>
                <p>Top Genure</p>
            </div>
            <div class="card-icon">
                <img src="../../images/averagepriceicon.png" alt="Average Price Icon">
            </div>



            
        </div>

        <div id="contacts" class="dash-card">
            <div class="card-content">
                <h2>$1234</h2>
                <p>This month sales</p>
            </div>
            <div class="card-icon">
                <img src="../../images/averagepriceicon.png" alt="Average Price Icon">
            </div>



            
        </div>


    </div>
</body>
</html>
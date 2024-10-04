<?php
require("./connect.php");

$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);
$categories = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
}
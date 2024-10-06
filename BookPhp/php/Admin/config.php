<?php

$con=new mysqli("localhost","root","","bookstore");
if($con->connect_error){
die("Connection failed: " . $con->connect_error);
}

?>
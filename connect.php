<?php

$host="localhost";
$user="root";
$pass="1234";
$db="login";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo "Failed to connezct DB".$conn->connect_error;
}
?>
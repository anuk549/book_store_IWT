<?php
require "config.php";

$ID =$_GET['id'];

if(isset($ID)){

    $sql="DELETE FROM `books` WHERE $ID=`ID`";
   

    if($con->query($sql)){
        echo 'Deleted Sucsessful';
    }

    else{
        echo "Error :".$con->error;
    }

    header("Location:./viewBook.php");
    exit();

}


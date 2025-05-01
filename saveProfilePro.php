<?php

require "connection.php";
session_start();

if (isset($_SESSION["customer"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];

    if(empty($fname)){
        echo "Please enter a First Name";
    }else if(empty($lname)){
        echo "Please enter a Last Name";
    }else if(empty($mobile)){
        echo "Please enter a Contact Number";
    }else{
        Database::iud("UPDATE `customer` SET `fname` = '".$fname."' , `lname` = '".$lname."' , `contact` = '".$mobile."'");
        echo "1";
    }
    
}else{
    header("Location: login.php");
}

?>
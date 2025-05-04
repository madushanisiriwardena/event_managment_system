<?php

require "../../connection.php";

session_start();

$manager = $_SESSION["manager"]["id"];

$id = $_POST["id"];
$comment = $_POST["comment"];

if(empty($comment)){
    echo "Please enter a Reply";
}else{
    Database::iud("UPDATE `feedback` SET `reply`= '".$comment."', `staff_id`='".$manager."' WHERE `quotation_id`='" . $id . "'");

    echo ("1");
}

    
?>
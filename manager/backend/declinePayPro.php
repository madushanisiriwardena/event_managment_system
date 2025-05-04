<?php

require "../../connection.php";

$id = $_POST["id"];
$comment = $_POST["comment"];

if(empty($comment)){
    echo "Please enter a Comment";
}else{
    Database::iud("UPDATE `slip_upload` SET `slip_status_id`= '3', `comment`='".$comment."' WHERE `id`='" . $id . "'");

    echo ("1");
}

    
?>
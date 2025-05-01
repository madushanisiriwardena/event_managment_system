<?php

require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];
$vc = $_POST["v"];

if(empty($email)){
    echo ("Missing Email Address");
}else if(empty ($np)){
    echo ("Please type a New Password");
}else if(strlen($np) < 5 || strlen($np) > 20){
    echo ("Invalid New Password");
}else if(empty($rnp)){
    echo ("Please Retype your Password");
}else if($np != $rnp){
    echo ("Password does not matched");
}else if(empty($vc)){
    echo ("Please enter your Verification Code");
}else{

    $rs = Database::search("SELECT * FROM `customer` WHERE 
    `email`='".$email."' AND `verify_code`='".$vc."'");
    $n = $rs->num_rows;

    $rs2 = Database::search("SELECT * FROM `vendors` WHERE 
    `email`='".$email."' AND `verify_code`='".$vc."'");
    $n2 = $rs2->num_rows;

    $rs3 = Database::search("SELECT * FROM `staff` WHERE 
    `email`='".$email."' AND `verify_code`='".$vc."'");
    $n3 = $rs3->num_rows;

    if($n == 1){

        Database::iud("UPDATE `customer` SET `password`='".$np."' WHERE 
        `email`='".$email."'");
        echo ("success");
    }else if($n2 == 1){
        Database::iud("UPDATE `vendors` SET `password`='".$np."' WHERE 
        `email`='".$email."'");
        echo ("success");

    }else if($n3 == 1){
        Database::iud("UPDATE `staff` SET `password`='".$np."' WHERE 
        `email`='".$email."'");
        echo ("success");
    

    }else{

        echo ("Invalid Email or Verification Code");

    }

}

?>
<?php

require "../../connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$cpw = $_POST["cpw"];
$npw = $_POST["npw"];
$id = $_POST["id"];

if (empty($fname)) {
    echo ("Please enter First Name");
} else if (empty($lname)) {
    echo ("Please enter Last Name");
} else if (empty($email)) {
    echo ("Please enter email");
} else if (empty($mobile)) {
    echo ("Please enter mobile");
} else if (empty($cpw)) {
    echo ("Please enter Current Password");
} else if (empty($npw)) {
    echo ("Please enter New Password");
} else {

    $hash_cpw= md5($cpw);

    $rs3 = Database::search("SELECT * FROM `staff` WHERE `id` = '".$id."'");
    $n3 = $rs3->num_rows;

        $data = $rs3->fetch_assoc();

        if($data["password"] == $hash_cpw){

            $hash_password= md5($npw);


            Database::iud("UPDATE `vendors` SET `fname`= '" . $fname . "',`lname`= '" . $lname . "',`email`='".$email."',
            `contact`='".$mobile."',`password`='".$hash_password."' WHERE `id`='" . $id . "'");
        
            echo ("1");

        }else{
            echo "Your Current Password is Incorrect !";
        }
    
}

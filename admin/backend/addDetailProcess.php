<?php
require "../../connection.php";
session_start();

if (isset($_SESSION["admin"])) {

    $staff_id = $_SESSION["admin"]["id"];

    $name = $_POST["name"];
    $age = $_POST["age"];


    if (empty($name)) {
        echo "Please Enter Your Name to Continue";
    } else if (empty($age)) {
        echo "Please Enter Your Age to Continue";
    } else {






            Database::iud("INSERT INTO `custom`(`name`,`age`,`status`,`staff_id`)
            VALUES ('" . $name . "','" . $age . "','1','$staff_id')");





            echo "1";

    }
} else {
    header("Location: ../login.php");
}

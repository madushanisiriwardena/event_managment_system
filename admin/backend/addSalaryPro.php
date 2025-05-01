<?php
require "../../connection.php";
session_start();

if (isset($_SESSION["admin"])) {

    $staff_id = $_POST["id"];

    $b = $_POST["b"];
    $a = $_POST["a"];
    $i = $_POST["i"];

    if (empty($b)) {
        echo "Please Enter a Basic Salary";
    } else if (empty($a)) {
        echo "Please Enter Allowances";
    } else if (empty($i)) {
        echo "Please Enter Incentive";
    } else {

        $rs2 = Database::search("SELECT * FROM `salary` WHERE `staff_id` = '" . $staff_id . "'");
        $n2 = $rs2->num_rows;

        $tot = $b + $a + $i;

        if ($n2 > 0) {

        Database::iud("UPDATE `salary` SET `basic`= '" . $b . "',`allowances`= '" . $a . "',`incentive`='".$i."',`total`='".$tot."' WHERE `staff_id`='" . $staff_id . "'");

        } else {

            Database::iud("INSERT INTO `salary`(`basic`,`allowances`,`incentive`,`total`,`staff_id`)
    VALUES ('" . $b . "','" . $a . "','" . $i . "','" . $tot . "','".$staff_id."')");

            
        }
        echo "1";
    }
} else {
    header("Location: ../login.php");
}

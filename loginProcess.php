<?php
session_start();
require "connection.php";

$u = $_POST["email"];
$p = $_POST["password"];
//validations
if (empty($u)) {
    echo ("Please enter an email address");
} else if (strlen($u) > 100) {
    echo ("Email must have less than 100 characters.");
} else if (!filter_var($u, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address");
} else if (empty($p)) {
    echo ("Please enter your Password.");
} else {
//password encryption
    $hash_password= md5($p);
//Is admin?
    $rs1 = Database::search("SELECT * FROM `staff` WHERE `email`='" . $u . "' AND `password`='" . $hash_password . "' AND `staff_type_id`='1'");
    $n1 = $rs1->num_rows;
    $admin = $rs1->fetch_assoc();
//Is customer?
    $rs2 = Database::search("SELECT * FROM `customer` WHERE `email`='" . $u . "' AND `password`='" . $hash_password . "'");
    $n2 = $rs2->num_rows;
    $customer = $rs2->fetch_assoc();
//Is vendor?
    $rs3 = Database::search("SELECT * FROM `vendors` WHERE `email`='" . $u . "' AND `password`='" . $hash_password . "'");
    $n3 = $rs3->num_rows;
    $vendor = $rs3->fetch_assoc();
//Manager?
    $rs4 = Database::search("SELECT * FROM `staff` WHERE `email`='" . $u . "' AND `password`='" . $hash_password . "' AND `staff_type_id`='2' AND `status`='1'");
    $n4 = $rs4->num_rows;
    $manager = $rs4->fetch_assoc();
//Coordinator?
    $rs5 = Database::search("SELECT * FROM `staff` WHERE `email`='" . $u . "' AND `password`='" . $hash_password . "' AND `staff_type_id`='3' AND `status`='1'");
    $n5 = $rs5->num_rows;
    $coordinator = $rs5->fetch_assoc();

    if ($n1 == 1) {

        $_SESSION["admin"] = $admin;
        echo "1";
    } else if ($n2 == 1) {

        if ($customer["status"] == 1) {
            $_SESSION["customer"] = $customer;

            echo "2";
        } else {
            echo "6";
        }
    } else if ($n3 == 1) {
        if ($vendor["status"] == 1) {
            $_SESSION["vendor"] = $vendor;

            echo "3";
        } else {
            echo "6";
        }
    } else if ($n4 == 1) {
        if ($manager["status"] == 1) {
            $_SESSION["manager"] = $manager;

            echo "4";
        } else {
            echo "Your Account is Deactivated - Contact System Admin";
        }
    } else if ($n5 == 1) {
        if ($coordinator["status"] == 1) {
            $_SESSION["coordinator"] = $coordinator;

            echo "5";
        } else {
            echo "Your Account is Deactivated - Contact System Admin";
        }
    } else {
        echo "Invalid Login Credentials";
    }
}

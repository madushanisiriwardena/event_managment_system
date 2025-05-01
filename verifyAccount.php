<?php
session_start();
require "connection.php";

$u = $_POST["email"];
$p = $_POST["verify"];

if (empty($u)) {
    echo ("Please enter an email address");
} else if (strlen($u) > 100) {
    echo ("Email must have less than 100 characters.");
} else if (!filter_var($u, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address");
} else if (empty($p)) {
    echo ("Please enter your Verification Code");
} else {

    $rs2 = Database::search("SELECT * FROM `customer` WHERE `email`='" . $u . "' AND `verify_code`='" . $p . "'");
    $n2 = $rs2->num_rows;
    $customer = $rs2->fetch_assoc();

    $rs3 = Database::search("SELECT * FROM `vendors` WHERE `email`='" . $u . "' AND `verify_code`='" . $p . "'");
    $n3 = $rs3->num_rows;
    $vendor = $rs3->fetch_assoc();

    if ($n2 == 1) {

        Database::iud("UPDATE `customer` SET `status`='1' WHERE `email`='".$u."'");

        $_SESSION["customer"] = $customer;

        echo "1";
        
    } else if ($n3 == 1) {

        Database::iud("UPDATE `vendors` SET `status`='1' WHERE `email`='".$u."'");

        $_SESSION["vendor"] = $vendor;

        echo "2";

    } else {
        echo "Invalid Login Credentials";
    }
}

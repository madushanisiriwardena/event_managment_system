<?php
require "../../connection.php";
session_start();

if (isset($_SESSION["admin"])) {

    $staff_id = $_SESSION["admin"]["id"];

    $name = $_POST["name"];
    $amount = $_POST["amount"];
    $type = $_POST["type"];
    $date = $_POST["date"];

    if (empty($name)) {
        echo "Please Enter a Payment Name to Continue";
    } else if (empty($amount)) {
        echo "Please Enter a Payment Amount to Continue";
    }else if ($amount<=0) {
        echo "Please Enter a valid Amount to Continue";
    }
    else if ($type == "0") {
        echo "Please select a Utillity Type";
    } else if (empty($date)) {
        echo "Please select a Payment Date to Continue";
    } else {

        if (isset($_FILES["img"])) {

            $imageFile = $_FILES["img"];
            $file_is = uniqid() . ".png";
            $fileName = "../../uploads/utility/" . $file_is;
            move_uploaded_file($imageFile["tmp_name"], $fileName);

            Database::iud("INSERT INTO `utility`(`name`,`cost`,`payment_date`,`bill_img`,`staff_id`,`utility_type_id`,`slip_status_id`)
            VALUES ('" . $name . "','" . $amount . "','" . $date . "','" . $file_is . "','$staff_id','" . $type . "','1')");

            echo "1";

        } else {
            echo "Please select an image";
        }
    }
} else {
    header("Location: ../login.php");
}

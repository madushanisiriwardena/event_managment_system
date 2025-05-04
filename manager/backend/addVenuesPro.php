<?php
require "../../connection.php";
session_start();

if (isset($_SESSION["manager"])) {

    $staff_id = $_SESSION["manager"]["id"];

    $category = $_POST["category"];
    $district = $_POST["district"];
    $type = $_POST["type"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $participants = $_POST["participants"];
    $pp_cost = $_POST["pp_cost"];
    $pp_sale = $_POST["pp_sale"];

    if ($category == 0) {
        echo "Please select a Category";
    } else if ($district == 0) {
        echo "Please select a District";
    } else if ($type == 0) {
        echo "Please select a Location Type";
    } else if (empty($name)) {
        echo "Please Enter a Name";
    } else if (empty($address)) {
        echo "Please Enter a Address";
    } else if (empty($participants)) {
        echo "Please Enter Max number of participants";
    } else if (empty($pp_cost)) {
        echo "Please Enter Per person cost price";
    } else if (empty($pp_sale)) {
        echo "Please Enter Per person sale price";
    } else {

        $rs = Database::search("SELECT * FROM `venues` WHERE `name`='" . $name . "'");

        $n = $rs->num_rows;

        if ($n > 0) {
            echo ("Already exists.");
        } else {

            if (isset($_FILES["img"])) {

                $imageFile = $_FILES["img"];

                $file_is = uniqid() . ".png";
                $fileName = "../../uploads/venues/" . $file_is;
                move_uploaded_file($imageFile["tmp_name"], $fileName);

                Database::iud("INSERT INTO `venues`
                (`name`,`address`,`participants`,`img`,`pp_cost`,`pp_sale`,`status`,`districts_id`,`location_type_id`,`categories_id`)
                VALUES ('" . $name . "','" . $address . "','" . $participants . "','" . $file_is . "','" . $pp_cost . "','" . $pp_sale . "','1','" . $district . "','" . $type . "','" . $category . "')");

                echo "1";

            } else {
                echo "Please select an image";
            }
        }
    }
} else {
    header("Location: ../login.php");
}
?>
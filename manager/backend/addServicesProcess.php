<?php
require "../../connection.php";

session_start();


if (isset($_SESSION["manager"])) {

    $staff = $_SESSION["manager"]["id"];


    $name = $_POST["name"];
    $pp_cost = $_POST["pp_cost"];
    $pp_sale = $_POST["pp_sale"];
    $pp_ad = $_POST["pp_ad"];
    $description = $_POST["description"];
    $category = $_POST["category"];


    if (empty($name)) {
        echo ("Please enter Service Name.");
    } else if (strlen($name) > 45) {
        echo ("Name must have less than 45 characters.");
    } else if (empty($pp_cost)) {
        echo ("Please add the per person cost.");
    } else if (empty($pp_sale)) {
        echo ("Please add the per person sale.");
    } else if (empty($pp_ad)) {
        echo ("Please add the per person additional price.");
    } else if (empty($description)) {
        echo ("Please add the Description.");
    } else if ($category == "0") {
        echo ("Please select the category.");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `services`
            (`name`,`date_time`,`status`,`pp_cost`,`pp_sale`,`pp_ad`,`description`,`categories_id`,`staff_id`)
            VALUES ('" . $name . "','" . $date . "','1','" . $pp_cost . "','" . $pp_sale . "','" . $pp_ad . "','" . $description . "','" . $category . "','" . $staff . "')");

        echo ("1");
    }
} else {
    header("Location: ../login.php");
}

?>
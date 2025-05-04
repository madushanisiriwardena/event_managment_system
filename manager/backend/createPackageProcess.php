<?php
require "../../connection.php";

session_start();

if (isset($_SESSION["manager"])) {

    $staff = $_SESSION["manager"]["id"];

    $s = $_POST["category"];
    $v = $_POST["name"];

    if ($s == 0) {
        echo ("Please select a Category");
    } else if (empty($v)) {
        echo ("Please enter a Package Name");
    } else {

        $rs = Database::search("SELECT * FROM `packages` WHERE `name`='" . $v . "' AND `categories_id` = '".$s."'");

        $n = $rs->num_rows;

        if ($n > 0) {
            echo ("Already exists");
        } else {
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `packages`(`name`,`date_time`,`status`,`categories_id`,`staff_id`)
            VALUES ('" . $v . "','" . $date . "','0','" . $s . "','" . $staff . "')");

            echo ("1");
        }
    }
} else {
    header("Location: ../login.php");
}

<?php

require "connection.php";
session_start();

if (isset($_SESSION["customer"])) {

    $customer = $_SESSION["customer"]["id"];

    $msg = $_POST["msg"];
    $id = $_POST["id"];

    if (empty($msg)) {
        echo "Please enter a Message";
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `chat`
        (`description`,`date_time`,`customer_id`,`staff_id`,`quotation_id`,`status`)
        VALUES ('" . $msg . "','" . $date . "','" . $customer . "','2','" . $id . "','1')");
        echo "1";
    }
} else {
    header("Location: login.php");
}
?>
<?php

require "connection.php";
session_start();

if (isset($_SESSION["customer"])) {

    $customer = $_SESSION["customer"]["id"];

    $feedback = $_POST["feed"];
    $rate = $_POST["r"];
    $id = $_POST["id"];

    if (empty($feedback)) {
        echo "Please enter a Feedback";
    } else if ($rate == 0) {
        echo "Please select a Rate Value";
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `feedback`
        (`description`,`date_time`,`rating`,`customer_id`,`staff_id`,`quotation_id`)
        VALUES ('" . $feedback . "','" . $date . "','" . $rate . "','" . $customer . "','2','" . $id . "')");
        echo "1";

        Database::iud("UPDATE `quotation` SET `quotation_status_id`= '6' WHERE `id`='" . $id . "'");
    }
} else {
    header("Location: login.php");
}
?>
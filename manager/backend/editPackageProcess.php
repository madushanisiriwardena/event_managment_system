<?php

require "../../connection.php";

$id = $_POST["id"];
$name = $_POST["name"];
$cat = $_POST["cat"];


if (empty($name)) {
    echo ("Please enter a Category Name.");
} else if (strlen($name) > 45) {
    echo ("Name must have less than 45 characters.");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("UPDATE `packages` SET `name`= '" . $name . "',`categories_id`= '" . $cat . "',`date_time`= '" . $date . "' WHERE `id`='" . $id . "'");

    echo ("1");
}

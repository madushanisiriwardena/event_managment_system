<?php

require "../../connection.php";

$name = $_POST["name"];
$pp_cost = $_POST["pp_cost"];
$pp_sale = $_POST["pp_sale"];
$pp_ad = $_POST["pp_ad"];
$description = $_POST["description"];
$category = $_POST["category"];
$id= $_POST["id"];

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

    Database::iud("UPDATE `services` SET `name`= '" . $name . "',`date_time`= '" . $date . "',`pp_cost`='".$pp_cost."',
    `pp_sale`='".$pp_sale."',`pp_ad`='".$pp_ad."',`description`='".$description."',`categories_id`='".$category."'
     WHERE `id`='" . $id . "'");

    echo ("1");
}

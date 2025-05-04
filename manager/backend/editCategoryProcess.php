<?php

require "../../connection.php";

$category = $_POST["category"];
$nc = $_POST["nc"];
$ncs = $_POST["ncs"];


if (empty($nc)) {
    echo ("Please enter a Category Name.");
} else if (strlen($nc) > 45) {
    echo ("Name must have less than 45 characters.");
} else if(empty($ncs)) {
    echo ("Please enter a Category Description.");
} else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("UPDATE `categories` SET `name`= '" . $nc . "',`description`= '" . $ncs . "',`date_time`= '" . $date . "' WHERE `id`='" . $category . "'");


        echo ("1");
}
?>
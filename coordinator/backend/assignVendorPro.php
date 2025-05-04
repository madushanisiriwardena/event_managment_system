<?php

require "../../connection.php";

$id = $_POST["id"];
$vendor = $_POST["vendor"];
$date = $_POST["date"];

if ($vendor == 0) {
    echo "Please Select a Vendor";
} else {







    // $resultset = Database::search("SELECT * FROM `quote_services` WHERE `vendors_id`='" . $vendor . "' AND `appointment_date`='" . $date . "'");

    // $n = $resultset->num_rows;

    // if ($n > 0) {
    //     echo "This Vendor has Already Assigned to another Event on this Date. Please choose another Vendor";
    // } else {
        Database::iud("UPDATE `quote_services` SET `vendors_id`= '" . $vendor . "',`vendor_status_id`= '6' WHERE `id`='" . $id . "'");

        echo "1";
    // }
}
?>
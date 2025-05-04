<?php

require "../../connection.php";

$id = $_POST["id"];

$rs = Database::search("SELECT * FROM `slip_upload` WHERE `id`='" . $id . "'");
$p = $rs->fetch_assoc();

Database::iud("UPDATE `slip_upload` SET `slip_status_id`= '2' WHERE `id`='" . $id . "'");

Database::iud("UPDATE `quotation` SET `quotation_status_id`= '4' WHERE `id`='" . $p['quotation_id'] . "'");

$rs3 = Database::search("SELECT * FROM `quotation` WHERE `id`='" . $p['quotation_id'] . "'");
$p3 = $rs3->fetch_assoc();

$rs2 = Database::search("SELECT * FROM `assigned_services` WHERE `packages_id`='" . $p3['packages_id'] . "'");
$n = $rs2->num_rows;

$rs4 = Database::search("SELECT * FROM `slip_upload` WHERE `quotation_id`='" . $p['quotation_id'] . "'");
$p4 = $rs4->num_rows;

$balance = $p3["balance"];
$paid = $p["price"];

$new_balance = $balance - $paid;

Database::iud("UPDATE `quotation` SET `balance`= '".$new_balance."' WHERE `id`='" . $p['quotation_id'] . "'");

if($p4 == 1){
    
    for ($x = 0; $x < $n; $x++) {
        $p2 = $rs2->fetch_assoc();
        Database::iud("INSERT INTO `quote_services`(`services_id`,`quotation_id`,`vendors_id`,`appointment_date`,`vendor_status_id`)
            VALUES ('" . $p2["services_id"] . "','" . $p["quotation_id"] . "','1','" . $p3["date_time"] . "','1')");
    }
    
    echo "1";
}else{
    echo "1";
}

?>
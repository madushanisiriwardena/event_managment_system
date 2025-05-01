<?php

require "connection.php";
session_start();

if (isset($_SESSION["customer"])) {

    $cus_id = $_SESSION["customer"]["id"];
    $qid = $_POST["qid"];

    $rs = Database::search("SELECT * FROM `wedding` WHERE `quotation_id`='" . $qid . "'");
    $n = $rs->num_rows;

    $rs3 = Database::search("SELECT * FROM `birthday` WHERE `quotation_id`='" . $qid . "'");
    $n3 = $rs3->num_rows;

    $rs4 = Database::search("SELECT * FROM `additional_services` WHERE `quotation_id`='" . $qid . "'");
    $n4 = $rs4->num_rows;

    if($n4 > 0){

        Database::iud("DELETE FROM `additional_services` WHERE `quotation_id`='" . $qid . "'");

    }

    if($n > 0){

        Database::iud("DELETE FROM `wedding` WHERE `quotation_id`='" . $qid . "'");

    }

    if($n3 > 0){

        Database::iud("DELETE FROM `birthday` WHERE `quotation_id`='" . $qid . "'");

    }

    $rs2 = Database::search("SELECT * FROM `location` WHERE `quotation_id`='" . $qid . "'");
    $n2 = $rs2->num_rows;

    if($n2 > 0){

        Database::iud("DELETE FROM `location` WHERE `quotation_id`='" . $qid . "'");

    }

    Database::iud("DELETE FROM `quotation` WHERE `id`='" . $qid . "'");
    echo "1";
}

?>
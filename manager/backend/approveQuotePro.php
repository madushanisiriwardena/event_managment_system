<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["manager"])) {

$staff_id = $_SESSION["manager"]["id"];

$comment = $_POST["c"];
$ad = $_POST["ad"];
$qid = $_POST["qid"];
$cid = $_POST["cid"];

if (empty($comment)) {
    echo ("Please enter a Comment");
} else if ($ad=='') {
    echo ("Please enter a Additional Price");
} else {

    $rs3 = Database::search("SELECT * FROM `quotation` WHERE `id` = '" . $qid . "'");
    $d = $rs3->fetch_assoc();

    $tot = $d["quote_total"];
    $bal = $d["balance"];

    $newtot = $tot + $ad;
    $newbal = $bal + $ad;

    Database::iud("UPDATE `quotation` SET `quotation_status_id`='2',`quote_total`='".$newtot."',`balance`='".$newbal."' WHERE `id`='" . $qid . "'");

    Database::iud("INSERT INTO `comment`(`description`,`additionl_price`,`quotation_id`,`customer_id`,`staff_id`) VALUES ('" . $comment . "','".$ad."','" . $qid . "','" . $cid . "','" . $staff_id . "')");

    echo "1";    
}

} else {
    header("Location: ../login.php");
}

<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["manager"])) {

$staff_id = $_SESSION["manager"]["id"];

$comment = $_POST["c"];
$qid = $_POST["qid"];
$cid = $_POST["cid"];

if (empty($comment)) {
    echo ("Please enter a Comment");
} else {

    Database::iud("UPDATE `quotation` SET `quotation_status_id`='3' WHERE `id`='" . $qid . "'");

    Database::iud("INSERT INTO `comment`(`description`,`quotation_id`,`customer_id`,`staff_id`) VALUES ('" . $comment . "','" . $qid . "','" . $cid . "','" . $staff_id . "')");

    echo "1";    
}

} else {
    header("Location: ../login.php");
}

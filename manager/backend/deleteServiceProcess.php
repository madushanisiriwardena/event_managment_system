<?php


require "../../connection.php";

$cs2 = $_POST["service"];



Database::iud("UPDATE `services` SET `status`='0' WHERE `id`='" . $cs2 . "'");
echo "1";

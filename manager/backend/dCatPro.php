<?php
require "../../connection.php";

$id = $_POST["id"];

Database::iud("UPDATE `categories` SET `status`='0' WHERE `id`='" . $id . "'");
echo "1";

?>
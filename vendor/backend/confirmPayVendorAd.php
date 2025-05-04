<?php

require "../../connection.php";

$id = $_POST["id"];

Database::iud("UPDATE `additional_services` SET `vendor_status_id`= '9' WHERE `id`='" . $id . "'");

echo "1";

?>
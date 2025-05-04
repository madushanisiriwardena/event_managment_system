<?php

require "../../connection.php";

$id = $_POST["id"];

Database::iud("UPDATE `quote_services` SET `vendor_status_id`= '7' WHERE `id`='" . $id . "'");

echo "1";

?>
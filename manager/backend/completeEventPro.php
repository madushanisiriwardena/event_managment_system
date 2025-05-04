<?php

require "../../connection.php";

$id = $_POST["id"];

Database::iud("UPDATE `quotation` SET `quotation_status_id`= '5' WHERE `id`='" . $id . "'");

echo "1";

?>
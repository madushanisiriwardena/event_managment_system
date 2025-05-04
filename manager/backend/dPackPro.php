<?php
require "../../connection.php";

$id = $_POST["id"];

Database::iud("UPDATE `packages` SET `status`='0' WHERE `id`='" . $id . "'");
echo "1";

?>
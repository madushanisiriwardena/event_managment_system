<?php

require "../../connection.php";

$id = $_POST["id"];

Database::iud("DELETE FROM `utility` WHERE `id`='" . $id . "'");

echo "1";

?>
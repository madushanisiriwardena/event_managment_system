<?php

require "connection.php";

$v = $_POST["loc"];

$rs = Database::search("SELECT * FROM `venues` WHERE `id`='" . $v . "'");

$data = $rs->fetch_assoc();

echo $data["pp_sale"];

?>
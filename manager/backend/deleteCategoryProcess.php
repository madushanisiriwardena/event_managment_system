<?php

require "../../connection.php";

$category = $_POST["category"];

Database::iud("UPDATE `categories` SET `status`='0' WHERE `id`='" . $category . "'");
echo "1";

?>
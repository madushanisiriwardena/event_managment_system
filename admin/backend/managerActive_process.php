<?php
session_start();

require "../../connection.php";

$manager = $_POST["manager"];

if(isset($_SESSION["admin"])){

        Database::iud("UPDATE `staff` SET `status`='1' WHERE `id`='".$manager."'");
        echo "1";

}

?>
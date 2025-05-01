<?php
session_start();

require "../../connection.php";

$coordinator = $_POST["coordinator"];

if(isset($_SESSION["admin"])){

        Database::iud("UPDATE `staff` SET `status`='0' WHERE `id`='".$coordinator."'");
        echo "1";

}

?>
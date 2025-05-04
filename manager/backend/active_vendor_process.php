<?php
session_start();

require "../../connection.php";

$vendor = $_POST["vendor"];

if(isset($_SESSION["manager"])){

        Database::iud("UPDATE `vendors` SET `status`='1' WHERE `id`='".$vendor."'");
        echo "1";
                                                     
}

?>
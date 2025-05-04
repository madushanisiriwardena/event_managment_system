<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["manager"])) {

    $staff_id = $_SESSION["manager"]["id"];

    $type = $_POST["type"];


    if (empty($type)) {
        echo ("Please enter Category Type.");
    }   else {




                Database::iud("INSERT INTO `type`
            (`type`)
            VALUES ('" . $type . "')");

                echo "1";



    }

} else {
    header("Location: ../login.php");
}

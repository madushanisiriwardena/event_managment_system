<?php
require "../../connection.php";
session_start();

if (isset($_SESSION["manager"])) {

    $id = $_POST["id"];
    $payment = $_POST["pay"];

        if (isset($_FILES["img"])) {

            $imageFile = $_FILES["img"];
            $file_is = uniqid() . ".png";
            $fileName = "../../uploads/vendor_payments/" . $file_is;
            move_uploaded_file($imageFile["tmp_name"], $fileName);

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("UPDATE `quote_services` SET `paid_date`= '" . $date . "',`slip`= '" . $file_is . "',`payment`= '" . $payment. "',`vendor_status_id`= '8' WHERE `id`='" . $id . "'");

            echo "1";
        } else {
            echo "Please select an image";
        }

} else {
    header("Location: ../login.php");
}

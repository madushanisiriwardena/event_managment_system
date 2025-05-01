<?php
require "connection.php";
session_start();

if (isset($_SESSION["customer"])) {

    $cus_id = $_SESSION["customer"]["id"];

    $info = $_POST["info"];
    $price = $_POST["price"];
    $qid = $_POST["id"];
    $status = $_POST["status"];

    if (empty($info)) {
        echo "Please Enter a Payment Info to Continue";
    } else if (empty($price)) {
        echo "Please Enter a Payment Amount to Continue";
    } else {

        if (isset($_FILES["img"])) {

            $imageFile = $_FILES["img"];
                $file_is = uniqid() . ".png";
                $fileName = "uploads/payslips/" . $file_is;
                move_uploaded_file($imageFile["tmp_name"], $fileName);
    
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");
    
                if($status == 1){

                    Database::iud("INSERT INTO `slip_upload`
                    (`slip_txt`,`slip_url`,`price`,`date`,`slip_status_id`,`quotation_id`,`customer_id`,`comment`,`status`)
                    VALUES ('" . $info . "','" . $file_is . "','" . $price . "','" . $date . "','1','" . $qid . "','" . $cus_id . "','Payment Submission','1')");
                
                }else{

                    Database::iud("UPDATE `slip_upload` SET `status`= '0' WHERE `id`='" . $status . "'");

                    Database::iud("INSERT INTO `slip_upload`
                    (`slip_txt`,`slip_url`,`price`,`date`,`slip_status_id`,`quotation_id`,`customer_id`,`comment`,`status`)
                    VALUES ('" . $info . "','" . $file_is . "','" . $price . "','" . $date . "','1','" . $qid . "','" . $cus_id . "','Re-Submission','1')");
                
                }

                echo "1";
                
        } else {
            echo "Please select an image";
        }
    }
} else {
    header("Location: ../login.php");
}

<?php
require "../../connection.php";
session_start();

if (isset($_SESSION["admin"])) {

    $salary = $_POST["id"];
    $staff = $_POST["staff"];
    $month = $_POST["month"];
    $date1 = $_POST["date"];


    if ($month == "0") {
        echo "Please select a Month";
    } else if (empty($date1)) {
        echo "Please select a Payment Date to Continue";
    }
    else {

        if (isset($_FILES["img"])) {

            $imageFile = $_FILES["img"];
            $file_is = uniqid() . ".png";
            $fileName = "../../uploads/salary_slips/" . $file_is;
            move_uploaded_file($imageFile["tmp_name"], $fileName);

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $s212 = Database::search("SELECT * FROM `salary` WHERE `staff_id`='" . $staff . "' ");
            $srow212 = $s212->fetch_assoc();

            Database::iud("INSERT INTO `pay_salary`(`staff_id`,`salary_id`,`slip`,`date_time`,`month_id`,`payment`,`date`)
            VALUES ('" . $staff . "','" . $salary . "','" . $file_is . "','" . $date . "','$month','" . $srow212["total"] . "','" . $date1 . "')");


            echo "1";
        } else {
            echo "Please select an image";
        }
    }
} else {
    header("Location: ../login.php");
}

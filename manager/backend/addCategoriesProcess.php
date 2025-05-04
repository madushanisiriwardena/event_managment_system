<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["manager"])) {
//Get ID by current login user
$staff_id = $_SESSION["manager"]["id"];

$name = $_POST["name"];
$des = $_POST["des"];

if (empty($name)) {
    echo ("Please enter Category Name.");
} else if (strlen($name) > 45) {
    echo ("Name must have less than 45 characters.");
} else if (empty($des)) {
    echo ("Please enter a Description");
} else {
//Check whether new category already exist
    $rs = Database::search("SELECT * FROM `categories` WHERE `name`='" . $name . "'");

    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("Already exists.");
    } else {
//Take the current date
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        if (isset($_FILES["img"])) {

            $imageFile = $_FILES["img"];
//image save
            $file_is = uniqid() . ".png";
            $fileName = "../../uploads/categories/" . $file_is;
            move_uploaded_file($imageFile["tmp_name"], $fileName);

            Database::iud("INSERT INTO `categories`
            (`name`,`date_time`,`img`,`description`,`status`,`staff_id`)
            VALUES ('" . $name . "','" . $date . "','" . $file_is . "','" . $des . "','0','" . $staff_id . "')");

            echo "1";

        } else {
            echo "Please select an image";
        }
    }
}

} else {
    header("Location: ../login.php");
}

<?php
require "../../connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$password = $_POST["password"];

if (empty($fname)) {
    echo "Please add your First Name.";
} else if (empty($lname)) {
    echo "Please add your Last Name.";
} else if (strlen($fname) > 50) {
    echo "Name must have less than 45 characters.";
} else if (strlen($lname) > 50) {
    echo "Name must have less than 45 characters.";
} else if (empty($mobile)) {
    echo "Please add your Mobile Number.";
} else if (strlen($mobile) != 10) {
    echo ("Mobile number must contain 10 characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Invalid Mobile Number.");
} else if (empty($email)) {
    echo ("Please enter your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address");
} else if (empty($password)) {
    echo ("Please enter your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password length must be between 5 - 20 characters.");
} else{

    $rs1 = Database::search("SELECT * FROM `staff` WHERE `email`='" . $email . "' OR `contact`='" . $mobile . "'");
    $n1 = $rs1->num_rows;

    if ($n1 > 0) {
        echo ("User with the same Mobile Number or Email already exists.");
    }else{
        $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

        $hash_password= md5($password);

        Database::iud("INSERT INTO `staff`
                (`fname`,`lname`,`email`,`contact`,`password`,`status`,`staff_type_id`,`reg_date`)
                VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $mobile . "','" . $hash_password . "','1','2','" . $date . "')");

            echo ("1");
    }

}

?>
<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$category = $_POST["category"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$password = $_POST["password"];
$password2 = $_POST["password2"];

if ($category == "0") {
    echo "Please Select Your user type.";
} else if (empty($fname)) {
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
} else if ($password != $password2) {
    echo ("Your Passwords does not Match");
} else {

    $code = uniqid();

    if ($category == "1") {
//email is exist in customer table
        $rs1 = Database::search("SELECT * FROM `customer` WHERE `email`='" . $email . "'");

        $n1 = $rs1->num_rows;
        $customer = $rs1->fetch_assoc();
//Email is exist in vendor table
        $rs2 = Database::search("SELECT * FROM `vendors` WHERE `email`='" . $email . "'");

        $n2 = $rs2->num_rows;
        $vendor = $rs2->fetch_assoc();


        if ($n1 > 0) {
            echo ("User with the same Email already exists.");
        } else if ($n2 > 0) {
            echo ("User with the same Email already exists.");
        } else {

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $hash_password= md5($password);
//register user as a customer

            Database::iud("INSERT INTO `customer`
                (`fname`,`lname`,`contact`,`email`,`password`,`reg_date`,`status`,`verify_code`)
                VALUES ('" . $fname . "','" . $lname . "','" . $mobile . "','" . $email . "','" . $hash_password . "','" . $date . "','0','" . $code . "')");
//start send email
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pavi.siriwardena@gmail.com';
            $mail->Password = 'gvkr azbf ffsm psiy';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('pavi.siriwardena@gmail.com', 'Minushi Events');
            $mail->addReplyTo('pavi.siriwardena@gmail.com', 'Minushi Events');

            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Event Management System - Please Verify Your Email Address';
            $bodyContent = '<p>Your verification code is ' . $code . '</p>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo '1';
            }
        }
    } else {

        if ($category == "2") {

            $rs3 = Database::search("SELECT * FROM `vendors` WHERE `email`='" . $email . "' OR
        `contact`='" . $mobile . "'");

            $n3 = $rs3->num_rows;
            $vendor = $rs3->fetch_assoc();

            $rs4 = Database::search("SELECT * FROM `customer` WHERE `email`='" . $email . "' OR
        `contact`='" . $mobile . "'");

            $n4 = $rs4->num_rows;
            $customer = $rs4->fetch_assoc();

            if ($n3 > 0) {
                echo ("User with the same Mobile Number or Email already exists.");
            } else if ($n4 > 0) {
                echo ("User with the same Mobile Number or Email already exists.");
            } else {
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                $hash_password2= md5($password2);

                Database::iud("INSERT INTO `vendors`
                (`fname`,`lname`,`contact`,`email`,`password`,`reg_date`,`status`,`verify_code`)
                VALUES ('" . $fname . "','" . $lname . "','" . $mobile . "','" . $email . "','" . $hash_password2 . "','" . $date . "','0','" . $code . "')");

                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pavi.siriwardena@gmail.com';
                $mail->Password = 'gvkr azbf ffsm psiy';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('pavi.siriwardena@gmail.com', 'Reset Password');
                $mail->addReplyTo('pavi.siriwardena@gmail.com', 'Reset Password');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Event Management System - Please Verify Your Email Address';
                $bodyContent = '<p>Your verification code is ' . $code . '</p>';
                $mail->Body    = $bodyContent;

                if (!$mail->send()) {
                    echo 'Verification code sending failed';
                } else {
                    echo '1';
                }
            }
        }
    }
}

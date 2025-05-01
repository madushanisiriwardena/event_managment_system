<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])){
    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `customer` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    $rs2 = Database::search("SELECT * FROM `vendors` WHERE `email`='".$email."'");
    $n2 = $rs2->num_rows;

    $rs3 = Database::search("SELECT * FROM `staff` WHERE `email`='".$email."'");
    $n3 = $rs3->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `customer` SET `verify_code`='".$code."' WHERE `email`='".$email."'");
        
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
            $mail->Subject = 'Event Management System - Password Reset Request';
            $bodyContent = '<p>Your Verification Code to Reset your Password is '.$code.'</p>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

        }else if($n2 == 1){

            $code = uniqid();

        Database::iud("UPDATE `vendors` SET `verify_code`='".$code."' WHERE `email`='".$email."'");
        
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
            $mail->Subject = 'Event Management System Forgot password Verification Code';
            $bodyContent = '<h1 style="color:green;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
        }else if($n3 == 1){
            $code = uniqid();

        Database::iud("UPDATE `staff` SET `verify_code`='".$code."' WHERE `email`='".$email."'");
        
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
            $mail->Subject = 'Event Management System Forgot password Verification Code';
            $bodyContent = '<h1 style="color:green;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

        
    }else{
        echo ("Invalid Email Address");
    }
}

?>
<?php

    require "../../connection.php";

    $m1 = $_POST["m1"];
    $m2 = $_POST["m2"];

    $a;
    $b;
    $c;
    $d;
//Sum of the accepted payment slips of the customer, between given date range
    $rs1 = Database::search("SELECT SUM(`price`) AS total_price FROM `slip_upload` WHERE `slip_status_id` = '2' AND `date` BETWEEN '".$m1."' AND '".$m2."';");

    $d1 = $rs1->fetch_assoc();
    
    if($d1["total_price"]==null){
        $a = 0;
    }else{
        $a = $d1["total_price"];
    }
//Sum of the accepted payment slips of the employee, between given date range
    $rs2 = Database::search("SELECT SUM(`payment`) AS total_price FROM `pay_salary` WHERE `date_time` BETWEEN '".$m1."' AND '".$m2."';");

    $d2 = $rs2->fetch_assoc();
    
    if($d2["total_price"]==null){
        $b = 0;
    }else{
        $b = $d2["total_price"];
    }
//Sum of the accepted payment slips of the vendor, between given date range
    $rs3 = Database::search("SELECT SUM(`payment`) AS total_price FROM `quote_services` WHERE `vendor_status_id` = '9' AND `paid_date` BETWEEN '".$m1."' AND '".$m2."';");

    $d3 = $rs3->fetch_assoc();
    
    if($d3["total_price"]==null){
        $c = 0;
    }else{
        $c = $d3["total_price"];
    }
//Sum of the accepted payment slips of the utility, between given date range
    $rs4 = Database::search("SELECT SUM(`cost`) AS total_price FROM `utility` WHERE `payment_date` BETWEEN '".$m1."' AND '".$m2."';");

    $d4 = $rs4->fetch_assoc();
    
    if($d4["total_price"]==null){
        $d = 0;
    }else{
        $d = $d4["total_price"];
    }

    $total = $b + $c + $d;

    $profit = $a - $total;

    $response = array(
        "a" => $a,
        "b" => $b,
        "c" => $c,
        "d" => $d,
        "total" => $total,
        "profit" => $profit
    );
    
    echo json_encode($response);

?>
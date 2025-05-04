<?php
require "../../connection.php";

$p = $_POST["package"];
$s = $_POST["service"];

if ($p == 0){
    echo ("Please Select a Package");
}else if($s == 0){
    echo ("Please Select a Service");
}else{ 

    $rs = Database::search("SELECT * FROM `assigned_services` WHERE `packages_id`='".$p."' AND `services_id`='".$s."'");
    
    $n = $rs->num_rows;
    
    if($n > 0){
        echo ("Already exists");
    }else{
    
            Database::iud("INSERT INTO `assigned_services`(`packages_id`,`services_id`)
            VALUES ('".$p."','".$s."')");

            $rs2 = Database::search("SELECT * FROM `packages` WHERE `id` = '" . $p . "'");
            $n2 = $rs2->fetch_assoc();

            $rs3 = Database::search("SELECT * FROM `services` WHERE `id` = '" . $s . "'");
            $n3 = $rs3->fetch_assoc();

            $tot;

            if(empty($n2["price"])){
                $tot = 0;
            }else{
                $tot = $n2["price"];
            }

            $tot = $tot + $n3["pp_sale"]; 

            Database::iud("UPDATE `packages` SET `price` = '".$tot."' WHERE `id` = '" . $p . "'");
    
            echo "1";
    
        }    
    }
?>
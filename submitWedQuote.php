<?php
require "connection.php";

session_start();

if (isset($_SESSION["customer"])) {

    $cus = $_SESSION["customer"]["id"];

    $bride = $_POST["bride"];
    $groom = $_POST["groom"];
    $date_time = $_POST["date_time"];
    $participants = $_POST["participants"];
    $type = $_POST["type"];
    $lpp = $_POST["lpp"];
    $loc = $_POST["loc"];
    $location = $_POST["location"];
    $ad = $_POST["ad"];
    $pid = $_POST["pid"];
    $tot = $_POST["tot"];
    $selected_services = json_decode($_POST["selected_services"], true);

    if (empty($bride)) {
        echo ("Please enter a Bride Name");
    } else if (empty($groom)) {
        echo ("Please enter a Groom Name");
    } else if (empty($date_time)) {
        echo ("Please select a Date and Time");
    } else if (empty($participants)) {
        echo ("Please enter number of participants");
    } else if ($type == "0") {
        echo ("Please select a Preffered Location");
    } else if (empty($tot)) {
        echo ("Quotation Total is Required. Try Again !!!");
    } else {

        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $date_time);

        $mysqlDateTime = $dateTime->format('Y-m-d H:i:s');

        if ($type == "1") {

            if ($lpp == "0") {
                echo ("Please select Location type");
            } else if (empty($loc)) {
                echo ("Please enter a Location");
            } else {

                $rs = Database::search("SELECT * FROM `packages` WHERE `id`='" . $pid . "'");

                $n = $rs->num_rows;

                if ($n > 0) {

                    $result = $rs->fetch_assoc();

                    if (empty($result["price"])) {

                        echo ("This Package does not have a Price and you can't place a Quotation for it.");
                    } else {

                        try {
                            // Start transaction
                            Database::$connection->begin_transaction();
                        
                            // Insert into `quotation`
                            $quotationQuery = "INSERT INTO `quotation`
                                               (`date_time`, `additional_details`, `customer_id`, `packages_id`, `quote_total`, `balance`, `participants`, `quotation_status_id`, `location_type`)
                                               VALUES ('$mysqlDateTime', '$ad', '$cus', '$pid', '$tot', '$tot', '$participants', '1', 'custom')";
                            Database::iud($quotationQuery);
                            $last_id = Database::$connection->insert_id;
                        
                            if ($last_id === false) {
                                throw new Exception("Error inserting into quotation: " . Database::$connection->error);
                            }
                        
                            // Insert into `wedding`
                            $weddingQuery = "INSERT INTO `wedding`
                                             (`bride`, `groom`, `location_type`, `quotation_id`, `location_name`)
                                             VALUES ('$bride', '$groom', '$lpp', '$last_id', '$loc')";
                            Database::iud($weddingQuery);
                        
                            if (Database::$connection->affected_rows === 0) {
                                throw new Exception("Error inserting into wedding: " . Database::$connection->error);
                            }
                        
                            // Insert into `additional_services`
                            foreach ($selected_services as $service_id) {
                                $serviceQuery = "INSERT INTO `additional_services`(`quotation_id`, `services_id`, `vendors_id`, `appointment_date`, `vendor_status_id`)
                                                 VALUES ('$last_id', '$service_id', '1', '$mysqlDateTime', '1')";
                                Database::iud($serviceQuery);
                        
                                if (Database::$connection->affected_rows === 0) {
                                    throw new Exception("Error inserting into additional_services: " . Database::$connection->error);
                                }
                            }
                        
                            // Commit transaction
                            Database::$connection->commit();
                            echo "1";
                        } catch (Exception $e) {
                            // Rollback transaction
                            Database::$connection->rollback();
                            echo "An error occurred: " . $e->getMessage();
                        }
                        
                    }
                }
            }
        } else if ($type == "2") {

            if ($location == "0") {
                echo ("Please select a Location");
            } else {

                $rs2 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $pid . "'");

                $n2 = $rs2->num_rows;

                if ($n2 > 0) {

                    $result2 = $rs2->fetch_assoc();

                    if (empty($result2["price"])) {

                        echo ("This Package does not have a Price and you can't place a Quotation for it.");
                    } else {

                        try {
                            // Start transaction
                            Database::begin_transaction();
                        
                            // Insert into `quotation`
                            $quotationQuery = "INSERT INTO `quotation`
                                               (`date_time`, `additional_details`, `customer_id`, `packages_id`, `quote_total`, `balance`, `participants`, `quotation_status_id`, `location_type`)
                                               VALUES ('$mysqlDateTime', '$ad', '$cus', '$pid', '$tot', '$tot', '$participants', '1', 'auto')";
                            Database::iud($quotationQuery);
                            $last_id2 = Database::$connection->insert_id;
                        
                            if ($last_id2 === false) {
                                throw new Exception("Error inserting into quotation: " . Database::$connection->error);
                            }
                        
                            // Insert into `wedding`
                            $weddingQuery = "INSERT INTO `wedding`
                                             (`bride`, `groom`, `location_type`, `quotation_id`, `location_name`)
                                             VALUES ('$bride', '$groom', 'N/A', '$last_id2', 'N/A')";
                            Database::iud($weddingQuery);
                        
                            if (Database::$connection->affected_rows === 0) {
                                throw new Exception("Error inserting into wedding: " . Database::$connection->error);
                            }
                        
                            // Insert into `location`
                            $locationQuery = "INSERT INTO `location` (`venues_id`, `quotation_id`) VALUES ('$location', '$last_id2')";
                            Database::iud($locationQuery);
                        
                            if (Database::$connection->affected_rows === 0) {
                                throw new Exception("Error inserting into location: " . Database::$connection->error);
                            }
                        
                            // Insert into `additional_services`
                            foreach ($selected_services as $service_id) {
                                $serviceQuery = "INSERT INTO `additional_services`
                                                 (`quotation_id`, `services_id`, `vendors_id`, `appointment_date`, `vendor_status_id`)
                                                 VALUES ('$last_id2', '$service_id', '1', '$mysqlDateTime', '1')";
                                Database::iud($serviceQuery);
                        
                                if (Database::$connection->affected_rows === 0) {
                                    throw new Exception("Error inserting into additional_services: " . Database::$connection->error);
                                }
                            }
                        
                            // Commit transaction
                            Database::commit();
                            echo "1";
                        } catch (Exception $e) {
                            // Rollback transaction
                            Database::rollback();
                            echo "An error occurred: " . $e->getMessage();
                        }
                    }
                }
            }
        } else {
            echo ("Please Select a Preffered Location");
        }
    }
} else {
    echo ("2");
}

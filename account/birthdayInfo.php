<?php

session_start();

require "../connection.php";

if (isset($_SESSION["customer"])) {

    if (isset($_GET["id"])) {

        $id = $_GET["id"];

        $product = Database::search("SELECT * FROM `quotation` WHERE `id` = '" . $id . "'");
        $product_rows = $product->num_rows;

        if ($product_rows == 1) {
            $pdata = $product->fetch_assoc();
        }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Event Managment System - My Ongoing Events</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.svg" />

            <!-- ========================= CSS here ========================= -->
            <link rel="stylesheet" href="../assets2/css/bootstrap.min.css" />
            <link rel="stylesheet" href="../assets2/css/LineIcons.3.0.css" />
            <link rel="stylesheet" href="../assets2/css/animate.css" />
            <link rel="stylesheet" href="../assets2/css/tiny-slider.css" />
            <link rel="stylesheet" href="../assets2/css/glightbox.min.css" />
            <link rel="stylesheet" href="../assets2/css/main.css" />


            <style type="text/css">
                body {
                    background: #f5f5f5;
                }

                .ui-w-80 {
                    width: 80px !important;
                    height: auto;
                }

                .btn-default {
                    border-color: rgba(24, 28, 33, 0.1);
                    background: rgba(0, 0, 0, 0);
                    color: #4E5155;
                }

                label.btn {
                    margin-bottom: 0;
                }

                .btn-outline-primary {
                    border-color: #26B4FF;
                    background: transparent;
                    color: #26B4FF;
                }

                .btn {
                    cursor: pointer;
                }

                .text-light {
                    color: #babbbc !important;
                }

                .btn-facebook {
                    border-color: rgba(0, 0, 0, 0);
                    background: #3B5998;
                    color: #fff;
                }

                .btn-instagram {
                    border-color: rgba(0, 0, 0, 0);
                    background: #000;
                    color: #fff;
                }

                .card {
                    background-clip: padding-box;
                    box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
                }

                .row-bordered {
                    overflow: hidden;
                }

                .account-settings-fileinput {
                    position: absolute;
                    visibility: hidden;
                    width: 1px;
                    height: 1px;
                    opacity: 0;
                }

                .account-settings-links .list-group-item.active {
                    font-weight: bold !important;
                }

                html:not(.dark-style) .account-settings-links .list-group-item.active {
                    background: transparent !important;
                }

                .account-settings-multiselect~.select2-container {
                    width: 100% !important;
                }

                .light-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(24, 28, 33, 0.03) !important;
                }

                .light-style .account-settings-links .list-group-item.active {
                    color: #4e5155 !important;
                }

                .material-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(24, 28, 33, 0.03) !important;
                }

                .material-style .account-settings-links .list-group-item.active {
                    color: #4e5155 !important;
                }

                .dark-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(255, 255, 255, 0.03) !important;
                }

                .dark-style .account-settings-links .list-group-item.active {
                    color: #fff !important;
                }

                .light-style .account-settings-links .list-group-item.active {
                    color: #4E5155 !important;
                }

                .light-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(24, 28, 33, 0.03) !important;
                }
            </style>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </head>

        <body>
            <?php
            require "../includes/site_header2.php";
            ?>

            <!-- Start Breadcrumbs -->
            <div class="breadcrumbs">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                            <div class="breadcrumbs-content">
                                <h1 class="page-title">More Event Details</h1>
                                <ul class="breadcrumb-nav">
                                    <li><a href="../index.php">Home</a></li>
                                    <li>More Event Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumbs -->

            <div class="container light-style flex-grow-1 container-p-y" style="margin-bottom: 50px;">
                <div class="card overflow-hidden mt-5">
                    <div class="row no-gutters row-bordered row-border-light pt-5 pb-5">
                        <div class="col-md-3 pt-0">
                            <?php
                            require "../includes/myAccountSidebar.php";
                            ?>
                        </div>
                        <div class="col-md-9 ">
                            <div class="tab-content">
                                <div class="tab-pane fade active show">
                                    <h1 class="h3 mb-2 text-gray-800">Event Details</h1>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <?php

                                            $r = Database::search("SELECT * FROM `birthday` WHERE `quotation_id`='" . $id . "'");
                                            $aa = $r->fetch_assoc();

                                            if ($aa["location_type"] == "N/A") {
                                            ?>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Birthday Boy/Girl Name</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Max Participants</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultset2 = Database::search("SELECT * FROM `birthday` WHERE `quotation_id`='" . $id . "'");
                                                    $a2 = $resultset2->fetch_assoc();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $a2["name"]; ?></td>
                                                        <td><?php
                                                            $resultset24 = Database::search("SELECT * FROM `location` WHERE `quotation_id`='" . $id . "'");
                                                            $a24 = $resultset24->fetch_assoc();

                                                            $resultset25 = Database::search("SELECT * FROM `venues` WHERE `id`='" . $a24["venues_id"] . "'");
                                                            $a25 = $resultset25->fetch_assoc();
                                                            echo $a25["name"];
                                                            echo " in ";
                                                            echo $a25["address"];
                                                            ?></td>
                                                        <td><?php echo $a25["participants"]; ?></td>
                                                    </tr>
                                                </tbody>
                                            <?php
                                            } else {
                                            ?>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Birthday Boy/Girl Name</th>
                                                        <th scope="col">Location Type</th>
                                                        <th scope="col">Location Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultset23 = Database::search("SELECT * FROM `birthday` WHERE `quotation_id`='" . $id . "'");
                                                    $a3 = $resultset23->fetch_assoc();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $a3["name"]; ?></td>
                                                        <td><?php echo $a3["location_type"]; ?></td>
                                                        <td><?php echo $a3["location_name"]; ?></td>
                                                    </tr>
                                                </tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <h1 class="h3 mb-2 text-gray-800">Requested Services</h1>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Service Name</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Vendor</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset = Database::search("SELECT * FROM `quote_services` WHERE `quotation_id`='" . $id . "'");
                                                $n = $resultset->num_rows;
                                                if ($n > 0) {
                                                for ($x = 0; $x < $n; $x++) {
                                                    $a = $resultset->fetch_assoc();
                                                ?>
                                                    <tr>
                                                        <td><?php echo $x + 1; ?></td>
                                                        <td>
                                                            <?php
                                                            $s2 = Database::search("SELECT * FROM `services` WHERE `id`='" . $a["services_id"] . "' ");
                                                            $srow2 = $s2->fetch_assoc();
                                                            echo $srow2["name"];
                                                            ?>
                                                        </td>
                                                        <td id="date<?php echo $a["id"]; ?>"><?php echo $a["appointment_date"]; ?></td>
                                                        <td>
                                                            <?php
                                                            $s234 = Database::search("SELECT * FROM `vendor_status` WHERE `id`='" . $a["vendor_status_id"] . "' ");
                                                            $srow234 = $s234->fetch_assoc();
                                                            if ($srow234['id'] == 6 || $srow234['id'] == 7) {
                                                                echo "Processing";
                                                            } else if($srow234['id'] == 5 || $srow234['id'] == 8 || $srow234['id'] == 9){
                                                                echo "Completed";
                                                            } else {
                                                                echo $srow234["name"];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $s23 = Database::search("SELECT * FROM `vendors` WHERE `id`='" . $a["vendors_id"] . "' ");
                                                            $srow23 = $s23->fetch_assoc();
                                                            echo $srow23["fname"];
                                                            echo " ";
                                                            echo $srow23["lname"];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No Data Found</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h1 class="h3 mb-2 text-gray-800">Requested Additional Services</h1>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Service Name</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Vendor</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset2 = Database::search("SELECT * FROM `additional_services` WHERE `quotation_id`='" . $id . "'");
                                                $n2 = $resultset2->num_rows;
                                                if ($n2 > 0) {
                                                    for ($x = 0; $x < $n2; $x++) {
                                                        $a2 = $resultset2->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><?php echo $x + 1; ?></td>
                                                            <td>
                                                                <?php
                                                                $s22 = Database::search("SELECT * FROM `services` WHERE `id`='" . $a2["services_id"] . "' ");
                                                                $srow22 = $s22->fetch_assoc();
                                                                echo $srow22["name"];
                                                                ?>
                                                            </td>
                                                            <td><?php echo $a2["appointment_date"]; ?></td>
                                                            <td>
                                                            <?php
                                                            $s234 = Database::search("SELECT * FROM `vendor_status` WHERE `id`='" . $a2["vendor_status_id"] . "' ");
                                                            $srow234 = $s234->fetch_assoc();
                                                            if ($srow234['id'] == 6 || $srow234['id'] == 7) {
                                                                echo "Processing";
                                                            } else if($srow234['id'] == 5 || $srow234['id'] == 8 || $srow234['id'] == 9){
                                                                echo "Completed";
                                                            } else {
                                                                echo $srow234["name"];
                                                            }
                                                            ?>
                                                        </td>
                                                            <td>
                                                                <?php
                                                                $s23 = Database::search("SELECT * FROM `vendors` WHERE `id`='" . $a2["vendors_id"] . "' ");
                                                                $srow23 = $s23->fetch_assoc();
                                                                echo $srow23["fname"];
                                                                echo " ";
                                                                echo $srow23["lname"];
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No Data Found</td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h1 class="h3 mb-2 text-gray-800">Additional Details</h1>
                                    <p><?php echo $pdata["additional_details"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- footer  -->

            <?php
            require "../includes/site_footer.php";
            ?>
            <script src="../script2.js"></script>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>

        </html>

<?php
    } else {
        header("Location : index.php");
    }
} else {
    header("Location: ../login.php");
}

?>
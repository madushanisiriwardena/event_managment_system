<?php
session_start();
require "../connection.php";
if (isset($_SESSION["coordinator"])) {

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

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Event Managment System - Assign Vendors</title>

            <!-- Custom fonts for this template -->
            <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

            <!-- Custom styles for this page -->
            <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </head>

        <body id="page-top">

            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Sidebar -->
                <?php require "../includes/coordinator_sidebar.php"; ?>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        <?php require "../includes/topbar.php"; ?>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Event Details</h1>
                                <div class="d-none d-sm-inline-block">
                                    <a href="coordinatorChat.php?id=<?php echo $pdata["id"]; ?>" class="btn btn-info">Open Chat</a>
                                </div>
                            </div>

                            <div class="card shadow mb-4">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <?php

                                            $r = Database::search("SELECT * FROM `wedding` WHERE `quotation_id`='" . $id . "'");
                                            $aa = $r->fetch_assoc();

                                            if ($aa["location_type"] == "N/A") {
                                            ?>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Bride Name</th>
                                                        <th scope="col">Groom Name</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Max Participants</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultset2 = Database::search("SELECT * FROM `wedding` WHERE `quotation_id`='" . $id . "'");
                                                    $a2 = $resultset2->fetch_assoc();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $a2["bride"]; ?></td>
                                                        <td><?php echo $a2["groom"]; ?></td>
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
                                                        <th scope="col">Bride Name</th>
                                                        <th scope="col">Groom Name</th>
                                                        <th scope="col">Location Type</th>
                                                        <th scope="col">Location Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultset23 = Database::search("SELECT * FROM `wedding` WHERE `quotation_id`='" . $id . "'");
                                                    $a3 = $resultset23->fetch_assoc();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $a3["bride"]; ?></td>
                                                        <td><?php echo $a3["groom"]; ?></td>
                                                        <td><?php echo $a3["location_type"]; ?></td>
                                                        <td><?php echo $a3["location_name"]; ?></td>
                                                    </tr>
                                                </tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Quote No.</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">Package</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Event Date</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Balance</th>
                                                    <th scope="col">Participants</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>Quotation #<?php echo $pdata["id"]; ?></td>
                                                <td>
                                                    <?php
                                                    $s2 = Database::search("SELECT * FROM `customer` WHERE `id`='" . $pdata["customer_id"] . "' ");
                                                    $srow2 = $s2->fetch_assoc();
                                                    echo $srow2["fname"];
                                                    echo " ";
                                                    echo $srow2["lname"];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $s21 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $pdata["packages_id"] . "' ");
                                                    $srow21 = $s21->fetch_assoc();
                                                    echo $srow21["name"];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $s22 = Database::search("SELECT * FROM `categories` WHERE `id`='" . $srow21["categories_id"] . "' ");
                                                    $srow22 = $s22->fetch_assoc();
                                                    echo $srow22["name"];
                                                    ?>
                                                </td>
                                                <td><?php echo $pdata["date_time"]; ?></td>
                                                <td>Rs.<?php echo $pdata["quote_total"]; ?>.00</td>
                                                <td>Rs.<?php echo $pdata["balance"]; ?>.00</td>
                                                <td><?php echo $pdata["participants"]; ?></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800">Assign Vendors to Suitable Services</h1>

                            <div class="card shadow mb-4">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Service Name</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Select Vendor</th>
                                                    <th scope="col">Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset = Database::search("SELECT * FROM `quote_services` WHERE `quotation_id`='" . $id . "' ORDER BY `id` DESC");
                                                $n = $resultset->num_rows;
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
                                                        <td id="date<?php echo $a["id"];?>"><?php echo $a["appointment_date"]; ?></td>
                                                        <td>
                                                            <?php
                                                            $s234 = Database::search("SELECT * FROM `vendor_status` WHERE `id`='" . $a["vendor_status_id"] . "' ");
                                                            $srow234 = $s234->fetch_assoc();
                                                            echo $srow234["name"];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($a["vendors_id"] == 1) {
                                                            ?>
                                                                <select class="form-control" id="vendor<?php echo $a["id"];?>">
                                                                    <option selected value="0">Select a Vendor</option>
                                                                    <?php

                                                                    $rs3 = Database::search("SELECT * FROM `vendors` WHERE `id`='" . $a["services_id"] . "' ");
                                                                    $n3 = $rs3->num_rows;

                                                                    for ($i = 1; $i <= $n3; $i++) {
                                                                        $mod = $rs3->fetch_assoc();
                                                                    ?>
                                                                        <option value="<?php echo $mod["id"] ?>"><?php echo $mod["fname"] ?><?php echo " " ?><?php echo $mod["lname"] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            <?php
                                                            } else {
                                                            if($a["vendor_status_id"] == 3){
                                                                ?>
                                                                <select class="form-control" id="vendor<?php echo $a["id"];?>">
                                                                    <option selected value="0">Select a Vendor</option>
                                                                    <?php

                                                                    $rs3 = Database::search("SELECT * FROM `vendors` WHERE `status` = '1' AND `id` != '1'");
                                                                    $n3 = $rs3->num_rows;

                                                                    for ($i = 1; $i <= $n3; $i++) {
                                                                        $mod = $rs3->fetch_assoc();
                                                                    ?>
                                                                        <option value="<?php echo $mod["id"] ?>"><?php echo $mod["fname"] ?><?php echo " " ?><?php echo $mod["lname"] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            <?php
                                                            }else{
                                                                $s23 = Database::search("SELECT * FROM `vendors` WHERE `id`='" . $a["vendors_id"] . "' ");
                                                            $srow23 = $s23->fetch_assoc();
                                                            echo $srow23["fname"];
                                                            echo " ";
                                                            echo $srow23["lname"];
                                                            }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if($a["vendor_status_id"] == 1){
                                                                ?>
                                                                <button class="btn btn-success" onclick="assign_vendor(<?php echo $a['id'];?>);">Assign</button>
                                                                <?php
                                                            }else if($a["vendor_status_id"] == 3){
                                                                ?>
                                                                <button class="btn btn-warning" onclick="assign_vendor(<?php echo $a['id'];?>);">Re-Assign</button>
                                                                <?php
                                                            }else if($a["vendor_status_id"] == 5){
                                                                ?>
                                                                <button class="btn btn-primary" disabled>Finished</button>
                                                                <?php
                                                            }else if($a["vendor_status_id"] == 7){
                                                                ?>
                                                                <button class="btn btn-primary" onclick="finished(<?php echo $a['id'];?>);">Mark Finished</button>
                                                                <?php
                                                            }else {
                                                                ?>
                                                                <button class="btn btn-secondary" disabled>Await</button>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h3 mb-2 text-gray-800">Assign Vendors to Suitable Additional Services</h1>

                            <div class="card shadow mb-4">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Service Name</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Select Vendor</th>
                                                    <th scope="col">Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset = Database::search("SELECT * FROM `additional_services` WHERE `quotation_id`='" . $id . "' ORDER BY `id` DESC");
                                                $n = $resultset->num_rows;
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
                                                        <td id="date<?php echo $a["id"];?>"><?php echo $a["appointment_date"]; ?></td>
                                                        <td>
                                                            <?php
                                                            $s234 = Database::search("SELECT * FROM `vendor_status` WHERE `id`='" . $a["vendor_status_id"] . "' ");
                                                            $srow234 = $s234->fetch_assoc();
                                                            echo $srow234["name"];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($a["vendors_id"] == 1) {
                                                            ?>
                                                                <select class="form-control" id="vendor<?php echo $a["id"];?>">
                                                                    <option selected value="0">Select a Vendor</option>
                                                                    <?php

                                                                    $rs3 = Database::search("SELECT * FROM `vendors` WHERE `status` = '1' AND `id` != '1'");
                                                                    $n3 = $rs3->num_rows;

                                                                    for ($i = 1; $i <= $n3; $i++) {
                                                                        $mod = $rs3->fetch_assoc();
                                                                    ?>
                                                                        <option value="<?php echo $mod["id"] ?>"><?php echo $mod["fname"] ?><?php echo " " ?><?php echo $mod["lname"] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            <?php
                                                            } else {
                                                            if($a["vendor_status_id"] == 3){
                                                                ?>
                                                                <select class="form-control" id="vendor<?php echo $a["id"];?>">
                                                                    <option selected value="0">Select a Vendor</option>
                                                                    <?php

                                                                    $rs3 = Database::search("SELECT * FROM `vendors` WHERE `status` = '1' AND `id` != '1'");
                                                                    $n3 = $rs3->num_rows;

                                                                    for ($i = 1; $i <= $n3; $i++) {
                                                                        $mod = $rs3->fetch_assoc();
                                                                    ?>
                                                                        <option value="<?php echo $mod["id"] ?>"><?php echo $mod["fname"] ?><?php echo " " ?><?php echo $mod["lname"] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            <?php
                                                            }else{
                                                                $s23 = Database::search("SELECT * FROM `vendors` WHERE `id`='" . $a["vendors_id"] . "' ");
                                                            $srow23 = $s23->fetch_assoc();
                                                            echo $srow23["fname"];
                                                            echo " ";
                                                            echo $srow23["lname"];
                                                            }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if($a["vendor_status_id"] == 1){
                                                                ?>
                                                                <button class="btn btn-success" onclick="assign_vendor_ad(<?php echo $a['id'];?>);">Assign</button>
                                                                <?php
                                                            }else if($a["vendor_status_id"] == 3){
                                                                ?>
                                                                <button class="btn btn-warning" onclick="assign_vendor_ad(<?php echo $a['id'];?>);">Re-Assign</button>
                                                                <?php
                                                            }else if($a["vendor_status_id"] == 5){
                                                                ?>
                                                                <button class="btn btn-primary" disabled>Finished</button>
                                                                <?php
                                                            }else if($a["vendor_status_id"] == 7){
                                                                ?>
                                                                <button class="btn btn-primary" onclick="finished_ad(<?php echo $a['id'];?>);">Mark Finished</button>
                                                                <?php
                                                            }else {
                                                                ?>
                                                                <button class="btn btn-secondary" disabled>Await</button>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <select class="form-control" id="service">
                                        <option selected value="0">Select a vendor</option>
                                        <?php

                                        $rs3 = Database::search("SELECT * FROM `vendors` WHERE `services_id`='" . "$service" . "'");
                                        $n3 = $rs3->num_rows;

                                        for ($i = 1; $i <= $n3; $i++) {
                                            $mod = $rs3->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $mod["id"] ?>"><?php echo $mod["name"] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>

                            <h1 class="h3 mb-2 text-gray-800">Additional Details</h1>
                            <div class="card shadow mb-4">

                                <div class="card-body">
                                    <p><?php echo $pdata["additional_details"]; ?></p>
                                </div>
                            </div>

                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->

                        <!-- Footer -->
                        <?php require "../includes/footer.php" ?>
                        <!-- End of Footer -->

                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- edit Modal -->



                <!-- edit Modal -->
                <script src="script.js"></script>
                <!-- Bootstrap core JavaScript-->
                <script src="../assets/vendor/jquery/jquery.min.js"></script>
                <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="../assets/js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../assets/js/demo/datatables-demo.js"></script>

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
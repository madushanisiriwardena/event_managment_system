<?php
session_start();
require "../connection.php";
if (isset($_SESSION["manager"])) {

    if (isset($_GET["id"], $_GET["cus"])) {

        $id = $_GET["id"];
        $cus = $_GET["cus"];

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

            <title>Event Managment System - Event Details</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

            <!-- Custom fonts for this template -->
            <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

            <!-- Custom styles for this page -->
            <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
</style>
        </head>

        <body id="page-top">

            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Sidebar -->
                <?php require "../includes/manager_sidebar.php"; ?>
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
                                <h1 class="h3 mb-0 text-gray-800">Requested Event Details</h1>
                                <div class="d-none d-sm-inline-block">
                                    <?php
                                    if ($pdata["quotation_status_id"] == 1) {
                                    ?>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $id; ?>">Approve</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $id; ?>">Decline</button>
                                    <?php
                                    } else if ($pdata["quotation_status_id"] == 2) {
                                    ?>
                                        <button class="btn btn-success" disabled>Quotation Approved</button>
                                    <?php
                                    } else if ($pdata["quotation_status_id"] == 3) {
                                    ?>
                                        <button class="btn btn-danger" disabled>Quotation Rejected</button>
                                    <?php
                                    }
                                    ?>
                                    <a href="managerChat.php?id=<?php echo $pdata["id"]; ?>" class="btn btn-info">Open Chat</a>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Approve Quotation</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label">Enter a Comment</label>
                                                    <input type="text" class="form-control form-control-user" id="comment<?php echo $id; ?>">
                                                </div>
                                                <div class="col-12 mt-4">
                                                    <label class="form-label">Enter Additional Price (If not available enter 0)</label>
                                                    <input type="number" class="form-control form-control-user" id="ad<?php echo $id; ?>" oninput="validity.valid||(value='');">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="approve_quote(<?php echo $id; ?>,<?php echo $cus; ?>);">Approve</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal2<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Decline Quotation</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label">Enter a Comment</label>
                                                    <input type="text" class="form-control form-control-user" id="comment2<?php echo $id; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger" onclick="decline_quote(<?php echo $id; ?>,<?php echo $cus; ?>);">Decline</button>
                                        </div>
                                    </div>
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
                            <h1 class="h3 mb-2 text-gray-800">Requested Services</h1>

                            <div class="card shadow mb-4">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Service Name</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset = Database::search("SELECT * FROM `assigned_services` WHERE `packages_id`='" . $pdata['packages_id'] . "'");
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
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h3 mb-2 text-gray-800">Requested Additional Services</h1>

                            <div class="card shadow mb-4">

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Service Name</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset2 = Database::search("SELECT * FROM `additional_services` WHERE `quotation_id`='" . $id . "'");
                                                $n2 = $resultset2->num_rows;
                                                if($n2>0){
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
                                                        </tr>
                                                    <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <tr>
                                                        <td colspan="2" class="text-center">No Data Found</td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
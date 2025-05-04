<?php
session_start();
require "../connection.php";
if (isset($_SESSION["manager"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Event Managment System - Events in Progress</title>

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
                        <h1 class="h3 mb-2 text-gray-800">Check Paid and Finished Events</h1>

                        <div class="card shadow mb-4">

                        <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Quote No.</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Package</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Event Date</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Participants</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resultset = Database::search("SELECT * FROM `quotation` WHERE `quotation_status_id` ='4' AND `balance` <= '0' ORDER BY `id` DESC");
                                            $n = $resultset->num_rows;
                                            for ($x = 0; $x < $n; $x++) {
                                                $a = $resultset->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <td><?php echo $x + 1; ?></td>
                                                    <td>Quotation #<?php echo $a["id"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $s2 = Database::search("SELECT * FROM `customer` WHERE `id`='" . $a["customer_id"] . "' ");
                                                        $srow2 = $s2->fetch_assoc();
                                                        echo $srow2["fname"];
                                                        echo " ";
                                                        echo $srow2["lname"];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $s21 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $a["packages_id"] . "' ");
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
                                                    <td><?php echo $a["date_time"]; ?></td>
                                                    <td>Rs.<?php echo $a["quote_total"]; ?>.00</td>
                                                    <td>Rs.<?php echo $a["balance"]; ?>.00</td>
                                                    <td><?php echo $a["participants"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $s2234 = Database::search("SELECT * FROM `quote_services` WHERE `quotation_id` = '" . $a["id"] . "' AND `vendor_status_id` IN (5, 6, 7, 8, 9);");
                                                        $rr = Database::search("SELECT COUNT(`quotation_id`) AS `value` FROM `quote_services` WHERE `quotation_id`='" . $a["id"] . "'");
                                                        $datarr = $rr->fetch_assoc();
                                                        $n2234 = $s2234->num_rows;
                                                        if($n2234 == $datarr["value"]){
                                                            ?>
                                                            <button class="btn btn-primary" onclick="complete_event(<?php echo $a['id']; ?>);">Complete Event</button>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <button class="btn btn-warning" disabled>Event in Progress</button>
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
    header("Location: ../login.php");
}
?>
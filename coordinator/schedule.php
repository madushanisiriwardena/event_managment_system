<?php
session_start();
require "../connection.php";
if (isset($_SESSION["coordinator"])) {
    if (isset($_GET["from"], $_GET["to"])) {

        $m1 = $_GET["from"];
        $m2 = $_GET["to"];
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Event Managment System - Schedule</title>

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
                                <h1 class="h3 mb-0 text-gray-800">Schedule</h1>
                                <!-- <button onclick="printDiv();" class="btn btn-sm btn-primary d-none" id="printbtn"><i
                                class="fas fa-download fa-sm text-white-50"></i> Print Report</button> -->
                            </div>
                            <!-- Content Row -->

                            <!-- Content Row -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Generate Schedule</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label class="form-label">Select From Date</label>
                                            <input type="date" id="m1" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="form-label">Select To Date</label>
                                            <input type="date" id="m2" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2">
                                            <button class="btn btn-primary btn-user btn-block mt-4" onclick="schedule();">
                                                View Schedule
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Schedule from <?php echo $m1; ?> to <?php echo $m2; ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Service Name</th>
                                                    <th scope="col">Appointment Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Vendor</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset = Database::search("SELECT * FROM `quote_services` WHERE `appointment_date` BETWEEN '" . $m1 . "' AND '" . $m2 . "'");
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
                                                                echo $srow234["name"];
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
                                                            <td>
                                                                <?php
                                                                $s237 = Database::search("SELECT * FROM `quotation` WHERE `id`='" . $a["quotation_id"] . "' ");
                                                                $srow237 = $s237->fetch_assoc();
                                                                $s21 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $srow237["packages_id"] . "' ");
                                                                $srow21 = $s21->fetch_assoc();
                                                                $s228 = Database::search("SELECT * FROM `categories` WHERE `id`='" . $srow21["categories_id"] . "' ");
                                                                $srow228 = $s228->fetch_assoc();
                                                                if ($srow228["id"] == 5) {
                                                                ?>
                                                                    <a href="assignVendors.php?id=<?php echo $srow237["id"]; ?>" class="btn btn-secondary">Manage</a>
                                                                <?php
                                                                } else if ($srow228["id"] == 6) {
                                                                ?>
                                                                    <a href="assignVendors2.php?id=<?php echo $srow237["id"]; ?>" class="btn btn-secondary">Manage</a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No data Found</td>
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

            <script>
                function printDiv() {
                    var restorepage = document.body.innerHTML;
                    var page = document.getElementById("report").innerHTML;
                    document.body.innerHTML = page;
                    window.print();
                    document.body.innerHTML = restorepage;
                }
            </script>
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
    ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Event Managment System - Schedule</title>

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
                                <h1 class="h3 mb-0 text-gray-800">Schedule</h1>
                                <!-- <button onclick="printDiv();" class="btn btn-sm btn-primary d-none" id="printbtn"><i
                                class="fas fa-download fa-sm text-white-50"></i> Print Report</button> -->
                            </div>
                            <!-- Content Row -->

                            <!-- Content Row -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Generate Schedule</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label class="form-label">Select From Date</label>
                                            <input type="date" id="m1" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="form-label">Select To Date</label>
                                            <input type="date" id="m2" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2">
                                            <button class="btn btn-primary btn-user btn-block mt-4" onclick="schedule();">
                                                View Schedule
                                            </button>
                                        </div>
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

            <script>
                function printDiv() {
                    var restorepage = document.body.innerHTML;
                    var page = document.getElementById("report").innerHTML;
                    document.body.innerHTML = page;
                    window.print();
                    document.body.innerHTML = restorepage;
                }
            </script>
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
    }
} else {
    header("Location: ../login.php");
}
?>
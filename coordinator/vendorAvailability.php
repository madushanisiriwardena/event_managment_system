<?php
session_start();
require "../connection.php";
if (isset($_SESSION["coordinator"])) {

    if (isset($_GET["date"])) {

        $date = $_GET["date"];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Event Managment System - Finance Report</title>

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
                            <h1 class="h3 mb-0 text-gray-800">Vendor Availability</h1>
                            <!-- <button onclick="printDiv();" class="btn btn-sm btn-primary d-none" id="printbtn"><i
                                class="fas fa-download fa-sm text-white-50"></i> Print Report</button> -->
                        </div>
                        <!-- Content Row -->
                        <!-- Content Row -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Check Availability</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-3 offset-md-3">
                                        <label class="form-label">Select Date</label>
                                        <input type="date" id="date" class="form-control" value="<?php echo $date; ?>">
                                    </div>
                                    <div class="col-12 col-md-3 mt-2">
                                        <button class="btn btn-primary btn-user btn-block mt-4" onclick="checkV();">
                                            Check
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Availability of Vendors on <?php echo $date; ?></h1>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Available Vendors</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Name</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultset = Database::search("SELECT DISTINCT v.id, v.fname, v.lname
FROM vendors v
LEFT JOIN quote_services qs ON v.id = qs.vendors_id AND qs.appointment_date = '".$date."'
WHERE qs.vendors_id IS NULL AND v.id != '1';");
                                                    $n = $resultset->num_rows;
                                                    if($n>0){
                                                        for ($x = 0; $x < $n; $x++) {
                                                            $a = $resultset->fetch_assoc();
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $x + 1; ?></td>
                                                                <td>
                                                                    <?php
                                                                    echo $a["fname"];
                                                                    echo " ";
                                                                    echo $a["lname"];
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }else{
                                                        ?>
                                                        <td colspan="2" class="text-center">No data Found</td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Not Available Vendors</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Assigned To</th>
                                                        <th scope="col">Service</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $resultset = Database::search("SELECT * FROM `quote_services` WHERE `appointment_date` = '".$date."' AND `vendors_id` != '1'");
                                                    $n = $resultset->num_rows;
                                                    if($n>0){
                                                    for ($x = 0; $x < $n; $x++) {
                                                        $a = $resultset->fetch_assoc();
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $x + 1; ?></td>
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
                                                                Quote #<?php echo $a["quotation_id"]; ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                $s234 = Database::search("SELECT * FROM `services` WHERE `id`='" . $a["services_id"] . "' ");
                                                                $srow234 = $s234->fetch_assoc();
                                                                echo $srow234["name"];
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <td colspan="2" class="text-center">No data Found</td>
                                                    <?php
                                                }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
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
    }else{
        ?>

            <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Event Managment System - Finance Report</title>

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
                            <h1 class="h3 mb-0 text-gray-800">Vendor Availability</h1>
                            <!-- <button onclick="printDiv();" class="btn btn-sm btn-primary d-none" id="printbtn"><i
                                class="fas fa-download fa-sm text-white-50"></i> Print Report</button> -->
                        </div>
                        <!-- Content Row -->

                        <!-- Content Row -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Check Availability</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-3 offset-md-3">
                                        <label class="form-label">Select Date</label>
                                        <input type="date" id="date" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-3 mt-2">
                                        <button class="btn btn-primary btn-user btn-block mt-4" onclick="checkV();">
                                            Check
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
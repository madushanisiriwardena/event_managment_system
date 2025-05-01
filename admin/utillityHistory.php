<?php
session_start();
require "../connection.php";
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Event Managment System - Utility Payment History</title>

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
            <?php require "../includes/sidebar.php"; ?>
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
                        <h1 class="h3 mb-2 text-gray-800">Utility Payment History</h1>

                        <div class="card shadow mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Payment Name</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Utility Type</th>
                                                <th>View</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rs2 = Database::search("SELECT * FROM `utility`");
                                            $n2 = $rs2->num_rows;

                                            for ($x = 0; $x < $n2; $x++) {
                                                $category = $rs2->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <td><?php echo $x + 1; ?></td>
                                                    <td><?php echo $category["name"]; ?></td>
                                                    <td>Rs.<?php echo $category["cost"]; ?>.00</td>
                                                    <td><?php echo $category["payment_date"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $s21 = Database::search("SELECT * FROM `utility_type` WHERE `id`='" . $category["utility_type_id"] . "' ");
                                                        $srow21 = $s21->fetch_assoc();
                                                        echo $srow21["name"];
                                                        ?>
                                                    </td>
                                                    <td><a href="../uploads/utility/<?php echo $category["bill_img"]; ?>" class="btn btn-secondary">View Slip</a></td>
                                                    <td><button class="btn btn-danger" onclick="delete_uslip(<?php echo $category['id']; ?>);">Delete</button></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
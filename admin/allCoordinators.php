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

        <title>Event Managment System - All Coordinators</title>

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
                        <h1 class="h3 mb-2 text-gray-800">All Registered Coordinators</h1>

                        <div class="card shadow mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Mobile No.</th>
                                                <th>Reg. Date</th>
                                                <th>Total Salary</th>
                                                <th>Manage Salary</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rs2 = Database::search("SELECT * FROM `staff` WHERE  `staff_type_id` = '3'");
                                            $n2 = $rs2->num_rows;

                                            for ($x = 0; $x < $n2; $x++) {
                                                $category = $rs2->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <td><?php echo $x + 1; ?></td>
                                                    <td><?php echo $category["fname"]; ?></td>
                                                    <td><?php echo $category["lname"]; ?></td>
                                                    <td><?php echo $category["email"]; ?></td>
                                                    <td><?php echo $category["contact"]; ?></td>
                                                    <td><?php echo $category["reg_date"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $s2 = Database::search("SELECT * FROM `salary` WHERE `staff_id`='" . $category["id"] . "' ");
                                                        $row = $s2->num_rows;
                                                        if ($row > 0) {
                                                            $srow2 = $s2->fetch_assoc();
                                                            echo "Rs.";
                                                            echo $srow2["total"];
                                                            echo ".00";
                                                        } else {
                                                            echo "N/A";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><button class="btn btn-secondary" data-toggle="modal" data-target="#editModal<?php echo $category['id'] ?>">Add / Edit Salary</button></td>

                                                    <td>
                                                        <?php
                                                        if ($category["status"] == 1) {
                                                        ?>
                                                            <button class="btn btn-danger" onclick="remove_coordinator(<?php echo $category['id'] ?>)">Deactivate</button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="btn btn-success" onclick="active_coordinator(<?php echo $category['id'] ?>)">Activate</button>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="editModal<?php echo $category['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add / Edit Salary</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label class="form-label">Enter Basic Salary</label>
                                                                        <input type="number" class="form-control " id="b<?php echo $category['id'] ?>">
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <label class="form-label">Enter Allowences</label>
                                                                        <input type="number" class="form-control " id="a<?php echo $category['id'] ?>">
                                                                    </div>
                                                                    <div class="col-12 mt-3">
                                                                        <label class="form-label">Enter Incentive</label>
                                                                        <input type="number" class="form-control " id="i<?php echo $category['id'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <a class="btn btn-primary" onclick="add_salary(<?php echo $category['id'] ?>);">Save Changes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
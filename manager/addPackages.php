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

        <title>Event Managment System - Add Packages</title>

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
                        <h1 class="h3 mb-2 text-gray-800">Add Packages</h1>
                        <!-- Content Row -->

                        <!-- Content Row -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Create a New Package</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6 p-3">
                                        <label class="form-label">Select the Package Category</label>
                                        <select class="form-control" id="category">
                                            <option selected value="0">Select a Category</option>
                                            <?php

                                            $rs3 = Database::search("SELECT * FROM `categories` WHERE `status` = '1'");
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
                                    <div class="col-12 col-md-6 p-3">
                                        <label class="form-label">Enter a Suitable Package Name</label>
                                        <input type="text" class="form-control form-control-user" id="name" placeholder="Package Name....">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 offset-3 p-3">
                                        <button class="btn btn-primary btn-user btn-block" onclick="create_package();">
                                            Create Package
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">View All Packages</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Package Name</th>
                                                <th scope="col">Created Date</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resultset = Database::search("SELECT * FROM `packages` ORDER BY `id` DESC");
                                            $n = $resultset->num_rows;
                                            for ($x = 0; $x < $n; $x++) {
                                                $a = $resultset->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <td><?php echo $a["id"]; ?></td>
                                                    <td><?php
                                                        $s = Database::search("SELECT * FROM `categories` WHERE `id`='" . $a["categories_id"] . "' ");
                                                        $srow = $s->fetch_assoc();
                                                        echo $srow["name"];
                                                        ?></td>
                                                    <td><?php echo $a["name"]; ?></td>
                                                    <td><?php echo $a["date_time"]; ?></td>
                                                    <td><button class="btn btn-secondary" href="#" data-toggle="modal" data-target="#editModal<?php echo $a['id'] ?>">Edit</button></td>
                                                    <td>
                                                        <?php
                                                        if ($a["status"] == 1) {
                                                        ?>
                                                            <button class="btn btn-warning" onclick="deactivate_p(<?php echo $a['id']; ?>);">Deactivate</button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="btn btn-success" onclick="activate_p(<?php echo $a['id']; ?>);">Activate</button>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="editModal<?php echo $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ready to Edit?</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Edit Package Name : </div>
                                                            <div class="col-12">
                                                                <input type="text" class="form-control" id="name<?php echo $a['id']; ?>" value="<?php echo $a["name"]; ?>">
                                                            </div>

                                                            <div class="modal-body">Edit Category : </div>
                                                            <div class="col-12 mb-4">
                                                                <select class="form-control" id="category<?php echo $a['id']; ?>">
                                                                    <option selected value="<?php echo $a['categories_id']; ?>">
                                                                    <?php
                                                                    $rs32 = Database::search("SELECT * FROM `categories` WHERE `id` = '".$a['categories_id']."'");
                                                                    
                                                                    $mod2 = $rs32->fetch_assoc();
                                                                    echo $mod2["name"];
                                                                    ?>
                                                                    </option>
                                                                    <?php

                                                                    $rs3 = Database::search("SELECT * FROM `categories` WHERE `status` = '1'");
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

                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <a class="btn btn-primary" onclick="save_package_changes(<?php echo $a['id'] ?>);">Save Changes</a>
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
} else {
    header("Location: ../login.php");
}
?>
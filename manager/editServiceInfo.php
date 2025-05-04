<?php

require "../connection.php";

session_start();
if (isset($_SESSION["manager"])) {
    if (isset($_GET["id"])) {

        $id = $_GET["id"];

        $product = Database::search("SELECT * FROM `services` WHERE `id` = '" . $id . "'");
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

            <title>Event Managment System - Event Manager Panel</title>

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
                            <h1 class="h3 mb-2 text-gray-800">Edit Service Details</h1>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Service Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-6 p-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Service Name</label>
                                            </div>
                                            <input type="text" class="form-control form-control-user" id="name" placeholder="Add Service Name..." value="<?php echo $pdata['name'] ?>">
                                        </div>
                                        <div class="col-6 p-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Per Person Cost</label>
                                            </div>
                                            <div class="input-group ">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="number" class="form-control" id="pp_cost" min="0" oninput="validity.valid||(value='');" value="<?php echo $pdata['pp_cost'] ?>" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        <div class="col-6 p-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Per Person Sale</label>
                                            </div>
                                            <div class="input-group ">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="number" class="form-control" id="pp_sale" min="0" oninput="validity.valid||(value='');" value="<?php echo $pdata['pp_sale'] ?>" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        <div class="col-6 p-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Per Person Additional Price</label>
                                            </div>
                                            <div class="input-group ">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="number" class="form-control" id="pp_ad" min="0" oninput="validity.valid||(value='');" value="<?php echo $pdata['pp_ad'] ?>" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        <div class="col-8 p-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Description</label>
                                            </div>
                                            <input type="text" class="form-control form-control-user" id="description" placeholder="Add Service Name..." value="<?php echo $pdata['description'] ?>">
                                        </div>

                                        <div class="col-4 p-3">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Category</label>
                                            </div>


                                            <select class="form-control" id="category">
                                                <option selected value="<?php echo $pdata['categories_id']; ?>">
                                                    <?php
                                                    $rs32 = Database::search("SELECT * FROM `categories` WHERE `id` = '" . $pdata['categories_id'] . "'");

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
                                        <div class="col-4 offset-4 p-3">
                                            <button class="btn btn-primary btn-user btn-block" onclick="save_changes(<?php echo $pdata['id'] ?>);">
                                                Update Service
                                            </button>
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
        header("Location : index.php");
    }
} else {
    header("Location: ../login.php");
}
?>
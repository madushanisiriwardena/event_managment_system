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

        <title>Event Managment System - Pay Salaries</title>

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
                        <h1 class="h3 mb-2 text-gray-800">Pay Salaries</h1>

                        <div class="card shadow mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Mobile No.</th>
                                                <th>Basic Salary</th>
                                                <th>Allowances</th>
                                                <th>Incentive</th>
                                                <th>Total Salary</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rs2 = Database::search("SELECT * FROM `salary`");
                                            $n2 = $rs2->num_rows;

                                            for ($x = 0; $x < $n2; $x++) {
                                                $category = $rs2->fetch_assoc();
                                            ?>
                                                <?php
                                                $s212 = Database::search("SELECT * FROM `staff` WHERE `id`='" . $category["staff_id"] . "' ");
                                                $srow212 = $s212->fetch_assoc();
                                                ?>
                                                <tr>
                                                    <td><?php echo $x + 1; ?></td>

                                                    <td><?php echo $srow212["fname"]; ?></td>
                                                    <td><?php echo $srow212["lname"]; ?></td>
                                                    <td><?php echo $srow212["contact"]; ?></td>
                                                    <td>Rs.<?php echo $category["basic"]; ?>.00</td>
                                                    <td>Rs.<?php echo $category["allowances"]; ?>.00</td>
                                                    <td>Rs.<?php echo $category["incentive"]; ?>.00</td>
                                                    <td>Rs.<?php echo $category["total"]; ?>.00</td>
                                                    <td><button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $category['id'] ?>">Pay Salary</button></td>
                                                </tr>

                                                <div class="modal fade" id="editModal<?php echo $category['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Pay Salary</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label class="form-label">Select Month</label>
                                                                        <select class="form-control" id="month<?php echo $category['id'] ?>">
                                                                            <option selected value="0">Select a Month</option>
                                                                            <?php

                                                                            $rs3 = Database::search("SELECT * FROM `month`");
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
                                                                    <div class="col-6">
                                                                        <label class="form-label">Select Payment Date</label>
                                                                        <input type="date" class="form-control " id="date">

                                                                    </div>
                                                                    <div class="offset-lg-3 col-12 col-lg-6 mt-4">
                                                                        <div class="row">
                                                                            <div class="col-12 border border-primary rounded text-center">
                                                                                <img src="../assets/img/addproductimg.svg" class="img-fluid" style="width: 250px;" id="prev<?php echo $category['id'] ?>" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 offset-md-4 col-md-4 p-3">
                                                                        <input type="file" class="d-none" id="imageuploader<?php echo $category['id'] ?>" accept="image/*" />
                                                                        <label for="imageuploader<?php echo $category['id'] ?>" class="col-12 btn btn-success" onclick="changeImage(<?php echo $category['id'] ?>);">Upload Image</label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <a class="btn btn-primary" onclick="pay_salary(<?php echo $category['id'] ?>,<?php echo $srow212['id']; ?>);">Pay Now</a>
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
            <script>
                function changeImage(id) {
                    var image = document.getElementById("imageuploader"+id); //file chooser
                    var view = document.getElementById("prev"+id); //image tag

                    image.onchange = function() {
                        var file = this.files[0]; //image eka thiyana file path eka
                        var url = window.URL.createObjectURL(file); //file location eka tempary url ekak lesa sakasima

                        view.src = url; //img tag eke src ekata url eka laba dima
                    };
                }
            </script>
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
<?php
session_start();
require "../connection.php";
if(isset($_SESSION["admin"])){
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Event Managment System - Add Utillity</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Utillity Payments</h1>
                    <!-- Content Row -->

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Utillity Payments</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-3 p-3">
                                    <label class="form-label">Enter Utillity Payment Name</label>
                                    <input type="text" class="form-control " id="name" placeholder="Enter Utillity Payment Name">
                                </div>
                                <div class="col-12 col-md-3 p-3">
                                    <label class="form-label">Enter Payment Amount</label>
                                    <input type="number" class="form-control " id="amount" placeholder="Enter Payment Amount">
                                </div>
                                <div class="col-12 col-md-3 p-3">
                                    <label class="form-label">Select Utillity Type</label>
                                    <select class="form-control" id="type">
                                        <option selected value="0">Select a Utillity Type</option>
                                        <?php

                                        $rs3 = Database::search("SELECT * FROM `utility_type`");
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
                                <div class="col-12 col-md-3 p-3">
                                    <label class="form-label">Select Payment Date</label>
                                    <input type="date" class="form-control " id="date">
                                </div>
                                <div class="offset-lg-3 col-12 col-lg-6 mt-4">
                                    <div class="row">
                                        <div class="col-12 border border-primary rounded text-center">
                                            <img src="../assets/img/addproductimg.svg" class="img-fluid" style="width: 250px;" id="prev" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 offset-md-4 col-md-4 p-3">
                                    <input type="file" class="d-none" id="imageuploader" accept="image/*" />
                                    <label for="imageuploader" class="col-12 btn btn-success" onclick="changeImage();">Upload image</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 offset-3 p-3">
                                    <button class="btn btn-primary btn-user btn-block" onclick="add_utillity();">
                                        Add Payment
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
    <script>
            function changeImage() {
                var image = document.getElementById("imageuploader"); //file chooser
                var view = document.getElementById("prev"); //image tag

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
}else{
    header("Location: ../login.php");
}
?>
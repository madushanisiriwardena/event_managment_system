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
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Finance Report</h1>
                        <button onclick="printDiv();" class="btn btn-sm btn-primary d-none" id="printbtn"><i
                                class="fas fa-download fa-sm text-white-50"></i> Print Report</button>
                    </div>
                        <!-- Content Row -->

                        <!--1st UI of the report  -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Generate Finance Report</h6>
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
                                        <button class="btn btn-primary btn-user btn-block mt-4" onclick="">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow mb-4 d-none" id="report">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="text-center mt-3">Minushi Events</h1>
                                        <h3 class="text-center mt-3"><u>Finance Report</u></h3>
                                        <br>
                                        <p>Finance Report from <span id="from" class="text-primary"></span> to <span id="to" class="text-primary"></span></p>
                                    </div>
                                    <div class="col-md-10 offset-md-1 col-12 mt-3">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <tr>
                                                <th colspan="2" class="text-center bg-info text-light">Earnings</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Customer Payments</td>
                                                <td class="text-center">Rs.<span id="cus"></span></td>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="text-center bg-info text-light">Expenses</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Employee Salary</td>
                                                <td class="text-center">Rs.<span id="emp"></span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Vendor Payments</td>
                                                <td class="text-center">Rs.<span id="ven"></span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Utillity Payments</td>
                                                <td class="text-center">Rs.<span id="ut"></span></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center bg-primary text-light">Total</th>
                                                <th class="text-center bg-primary text-light">Rs.<span id="tot"></span></th>
                                            </tr>
                                            <tr>
                                                <th class="text-center bg-success text-light">Net Profit</th>
                                                <th class="text-center bg-success text-light">Rs.<span id="net"></span></th>
                                            </tr>
                                        </table>
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
<!--Print Report-->
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
    header("Location: ../login.php");
}
?>
<?php
session_start();
require "../connection.php";
if (isset($_SESSION["manager"])) {
    if (isset($_GET["id"])) {

        $id = $_GET["id"];

        $product = Database::search("SELECT * FROM `slip_upload` WHERE `id` = '" . $id . "'");
        $product_rows = $product->num_rows;

        if ($product_rows == 1) {
            $a = $product->fetch_assoc();
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

            <title>Event Managment System - Payment Report</title>

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
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Payment Report</h1>
                                <button onclick="printDiv();" class="btn btn-sm btn-primary" id="printbtn"><i class="fas fa-download fa-sm text-white-50"></i> Print Report</button>
                            </div>

                            <div class="card shadow mb-4" id="report">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1 class="text-center mt-3">Minushi Events</h1>
                                            <h3 class="text-center mt-3"><u>Payment Report</u></h3>
                                            <br>
                                            <p>Date : <?php echo $a["date"]; ?></p>
                                        </div>
                                        <div class="col-md-10 offset-md-1 col-12 mt-3">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <tr>
                                                    <th class="text-center bg-info text-light">Quote</th>
                                                    <th class="text-center bg-info text-light">Package</th>
                                                    <th class="text-center bg-info text-light">Info</th>
                                                    <th class="text-center bg-info text-light">Paid Amount</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">Quotation #<?php 
                                                    $s22 = Database::search("SELECT * FROM `quotation` WHERE `id`='" . $a["quotation_id"] . "' ");
                                                    $srow22 = $s22->fetch_assoc();
                                                    $s23 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $srow22["packages_id"] . "' ");
                                                    $srow23 = $s23->fetch_assoc();
                                                    $s24 = Database::search("SELECT * FROM `categories` WHERE `id`='" . $srow23["categories_id"] . "' ");
                                                    $srow24 = $s24->fetch_assoc();
                                                    echo $srow22["id"]; 
                                                    ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        echo $srow24["name"];
                                                        echo " ";
                                                        echo $srow23["name"];
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?php echo $a["slip_txt"]; ?></td>
                                                    <td class="text-center">Rs.<?php echo $a["price"]; ?>.00</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-center bg-primary text-light">Total Amount for the Event</th>
                                                    <th class="text-center bg-primary text-light">Rs.<?php echo $srow22["quote_total"]; ?>.00</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-center bg-success text-light">Remaining Balance to be Paid</th>
                                                    <th class="text-center bg-success text-light">Rs.<?php echo $srow22["balance"]; ?>.00</th>
                                                </tr>
                                            </table>
                                        </div>
                                       <div class="col-12 text-center">
                                       <p>Your Payment has Received - Thank you...</p>
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
    } else {
        header("Location : index.php");
    }
} else {
    header("Location: ../login.php");
}
?>
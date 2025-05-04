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

        <title>Event Managment System - Completed Payments</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                        <h1 class="h3 mb-2 text-gray-800">Completed Vendor Service Payments</h1>

                        <div class="card shadow mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Service Name</th>
                                                <th scope="col">Quotation</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Appointment Date</th>
                                                <th scope="col">Vendor</th>
                                                <th scope="col">Payment Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resultset = Database::search("SELECT * FROM `quote_services` WHERE `vendor_status_id` = '8' OR `vendor_status_id` = '9' ORDER BY `id` DESC");
                                            $n = $resultset->num_rows;
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
                                                    <td>Quotation #
                                                        <?php
                                                        $s234 = Database::search("SELECT * FROM `quotation` WHERE `id`='" . $a["quotation_id"] . "' ");
                                                        $srow234 = $s234->fetch_assoc();
                                                        echo $srow234["id"];
                                                        ?>
                                                    </td>
                                                    <td>Rs.<?php echo $a["payment"]; ?>.00</td>
                                                    <td id="date<?php echo $a["id"]; ?>"><?php echo $a["appointment_date"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $s23 = Database::search("SELECT * FROM `vendors` WHERE `id`='" . $a["vendors_id"] . "' ");
                                                        $srow23 = $s23->fetch_assoc();
                                                        echo $srow23["fname"];
                                                        echo " ";
                                                        echo $srow23["lname"];
                                                        ?>
                                                    </td>
                                                    <td><?php echo $a["paid_date"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $s5 = Database::search("SELECT * FROM `vendor_status` WHERE `id`='" . $a["vendor_status_id"] . "' ");
                                                        $srow5 = $s5->fetch_assoc();
                                                        echo $srow5["name"];
                                                        ?>
                                                    </td>
                                                    <td><a href="../uploads/vendor_payments/<?php echo $a["slip"]; ?>" class="btn btn-secondary">View Slip</a></td>
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
            <script>
                function changeImage(id) {
                    var image = document.getElementById("imageuploader" + id); //file chooser
                    var view = document.getElementById("prev" + id); //image tag

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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

            <!-- Page level custom scripts -->
            <script src="../assets/js/demo/datatables-demo.js"></script>

    </body>

    </html>
<?php
} else {
    header("Location: ../login.php");
}
?>
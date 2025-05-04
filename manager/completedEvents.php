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

        <title>Event Managment System - Completed Events</title>
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
                        <h1 class="h3 mb-2 text-gray-800">Completed Events</h1>

                        <div class="card shadow mb-4">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Quote No.</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Package</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Event Date</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Participants</th>
                                                <th scope="col">Feedback</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resultset = Database::search("SELECT * FROM `quotation` WHERE `quotation_status_id` ='5' OR `quotation_status_id` ='6' ORDER BY `id` DESC");
                                            $n = $resultset->num_rows;
                                            for ($x = 0; $x < $n; $x++) {
                                                $a = $resultset->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <td><?php echo $x + 1; ?></td>
                                                    <td>Quotation #<?php echo $a["id"]; ?></td>
                                                    <td>
                                                        <?php
                                                        $s2 = Database::search("SELECT * FROM `customer` WHERE `id`='" . $a["customer_id"] . "' ");
                                                        $srow2 = $s2->fetch_assoc();
                                                        echo $srow2["fname"];
                                                        echo " ";
                                                        echo $srow2["lname"];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $s21 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $a["packages_id"] . "' ");
                                                        $srow21 = $s21->fetch_assoc();
                                                        echo $srow21["name"];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $s22 = Database::search("SELECT * FROM `categories` WHERE `id`='" . $srow21["categories_id"] . "' ");
                                                        $srow22 = $s22->fetch_assoc();
                                                        echo $srow22["name"];
                                                        ?>
                                                    </td>
                                                    <td><?php echo $a["date_time"]; ?></td>
                                                    <td>Rs.<?php echo $a["quote_total"]; ?>.00</td>
                                                    <td>Rs.<?php echo $a["balance"]; ?>.00</td>
                                                    <td><?php echo $a["participants"]; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($a["quotation_status_id"] == 5) {
                                                        ?>
                                                            <button class="btn btn-secondary" disabled>Feedback Pending</button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#feedback<?php echo $a["id"]; ?>">View Feedback</button>

                                                            <div class="modal fade" id="feedback<?php echo $a['id']; ?>" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="feedbackLabel">Provide Feedback</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body p-4">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <label class="form-label">Feedback Received :
                                                                                        <?php
                                                                                        $s212 = Database::search("SELECT * FROM `feedback` WHERE `quotation_id`='" . $a["id"] . "' ");
                                                                                        $srow212 = $s212->fetch_assoc();
                                                                                        echo $srow212["description"];
                                                                                        ?>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label class="form-label">Rating :
                                                                                        <?php
                                                                                        echo $srow212["rating"];
                                                                                        ?> / 10
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-12 mt-4">
                                                                                    <label class="form-label">Enter Reply</label>
                                                                                    <input type="text" class="form-control form-control-user" id="comment<?php echo $a['id']; ?>" value="<?php
                                                                                        echo $srow212["reply"];
                                                                                        ?>"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button class="btn btn-primary" onclick="add_reply(<?php echo $a['id']; ?>);">Submit Reply</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>

    </html>
<?php
} else {
    header("Location: ../login.php");
}
?>
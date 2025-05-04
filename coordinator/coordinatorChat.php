<?php
session_start();
require "../connection.php";
if (isset($_SESSION["coordinator"])) {
    if (isset($_GET["id"])) {

        $q = $_GET["id"];
        $cus = $_SESSION["coordinator"]["id"];

        $product = Database::search("SELECT * FROM `quotation` WHERE `id` = '" . $q . "'");
        $product_rows = $product->num_rows;
        $result = $product->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Event Managment System - Chat</title>

        <!-- Custom fonts for this template -->
        <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            #chat2 .form-control {
                    border-color: transparent;
                }

                #chat2 .form-control:focus {
                    border-color: transparent;
                    box-shadow: inset 0px 0px 0px 1px transparent;
                }

                .divider:after,
                .divider:before {
                    content: "";
                    flex: 1;
                    height: 1px;
                    background: #eee;
                }
        </style>
    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php require "../includes/coordinator_sidebar.php"; ?>
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
                        <h1 class="h3 mb-2 text-gray-800">Chat About Quotation #<?php echo $q; ?></h1>

                        <div class="card shadow mb-4">

                            <div class="card-body">

                        
                                            <div class="card-body">

                                                <?php

                                                $rs = Database::search("SELECT * FROM `chat` WHERE `quotation_id` = '" . $q . "'");
                                                $n = $rs->num_rows;

                                                for ($x = 0; $x < $n; $x++) {
                                                    $data = $rs->fetch_assoc();

                                                    if ($data["status"] == 1) {
                                                ?>
                                                        <div class="d-flex flex-row justify-content-start">
                                                            <img src="../assets/img/images.png" alt="avatar 1" style="width: 45px; height: 100%;">
                                                            <div>
                                                                <p class="small me-3 rounded-3 text-muted d-flex mb-0"><?php 
                                                                $s = Database::search("SELECT * FROM `customer` WHERE `id`='" . $data["customer_id"] . "' ");
                                                                $srow = $s->fetch_assoc();
                                                                echo $srow["email"];
                                                                ?></p>
                                                                <p class="small p-2 ms-3 mb-1 rounded-3 bg-success text-white"><?php echo $data["description"]; ?></p>
                                                                <p class="small ms-3 mb-3 rounded-3 text-muted"><?php echo $data["date_time"]; ?></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                                            <div>
                                                                <p class="small me-3 rounded-3 text-muted d-flex mb-0"><?php 
                                                                $s21 = Database::search("SELECT * FROM `staff` WHERE `id`='" . $data["staff_id"] . "' ");
                                                                $srow21 = $s21->fetch_assoc();
                                                                echo $srow21["email"];
                                                                ?></p>
                                                                <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary"><?php echo $data["description"]; ?></p>
                                                                <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end"><?php echo $data["date_time"]; ?></p>
                                                            </div>
                                                            <img src="../assets/img/admin.png" alt="avatar 1" style="width: 45px; height: 100%;">
                                                        </div>
                                                        

                                                <?php
                                                    }
                                                }
                                                ?>

                                            </div>
                                            <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                                                <img src="../assets/img/admin.png" alt="avatar 3" style="width: 40px; height: 100%;">
                                                <input type="text" class="form-control form-control-lg" id="msg" placeholder="Type message here....">
                                                <button onclick="send_msg2(<?php echo $q; ?>);" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                                    </svg></button>
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
    header("Location : index.php");
}
} else {
    header("Location: ../login.php");
}
?>
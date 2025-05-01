<?php
require "connection.php";
session_start();
if (isset($_SESSION["customer"])) {

    if (isset($_GET["id"])) {

        $q = $_GET["id"];
        $cus = $_SESSION["customer"]["id"];

        $product = Database::search("SELECT * FROM `quotation` WHERE `id` = '" . $q . "'");
        $product_rows = $product->num_rows;
        $result = $product->fetch_assoc();
?>
        <!DOCTYPE html>
        <html class="no-js" lang="zxx">

        <head>
            <meta charset="utf-8" />
            <meta http-equiv="x-ua-compatible" content="ie=edge" />
            <title>Event Managment System - Chat</title>
            <meta name="description" content="" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <link rel="stylesheet" href="assets2/css/bootstrap.min.css" />
            <link rel="stylesheet" href="assets2/css/LineIcons.3.0.css" />
            <link rel="stylesheet" href="assets2/css/animate.css" />
            <link rel="stylesheet" href="assets2/css/tiny-slider.css" />
            <link rel="stylesheet" href="assets2/css/glightbox.min.css" />
            <link rel="stylesheet" href="assets2/css/main.css" />
            <style>
                #a1 {
                    display: none;
                }

                #a2 {
                    display: none;
                }

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

        <body>
            <?php

            require "includes/site_header.php";

            ?>
            <!-- Start Breadcrumbs -->
            <div class="breadcrumbs">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                            <div class="breadcrumbs-content">
                                <h1 class="page-title">Chat</h1>
                                <ul class="breadcrumb-nav">
                                    <li><a href="index.php">Home</a></li>
                                    <li>Chat</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5 mb-5">

                <div class="row">
                    <div class="col-12">
                        <section>
                            <div class="container py-5">

                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-10 col-lg-8 col-xl-6">

                                        <div class="card" id="chat2">
                                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                                <h5 class="mb-0">Chat About Quotation #<?php echo $q; ?></h5>
                                            </div>
                                            <div class="card-body">

                                                <?php

                                                $rs = Database::search("SELECT * FROM `chat` WHERE `quotation_id` = '" . $q . "' AND `customer_id` = '" . $cus . "'");
                                                $n = $rs->num_rows;

                                                for ($x = 0; $x < $n; $x++) {
                                                    $data = $rs->fetch_assoc();

                                                    if ($data["status"] == 1) {
                                                ?>
                                                        <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                                            <div>
                                                                <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary"><?php echo $data["description"]; ?></p>
                                                                <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end"><?php echo $data["date_time"]; ?></p>
                                                            </div>
                                                            <img src="assets/img/images.png" alt="avatar 1" style="width: 45px; height: 100%;">
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="d-flex flex-row justify-content-start">
                                                            <img src="assets/img/admin.png" alt="avatar 1" style="width: 45px; height: 100%;">
                                                            <div>
                                                                <p class="small p-2 ms-3 mb-1 rounded-3 bg-success text-white"><?php echo $data["description"]; ?></p>
                                                                <p class="small ms-3 mb-3 rounded-3 text-muted"><?php echo $data["date_time"]; ?></p>
                                                            </div>
                                                        </div>

                                                <?php
                                                    }
                                                }
                                                ?>

                                            </div>
                                            <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                                                <img src="assets/img/images.png" alt="avatar 3" style="width: 40px; height: 100%;">
                                                <input type="text" class="form-control form-control-lg" id="msg" placeholder="Type message here....">
                                                <button onclick="send_msg(<?php echo $q; ?>);" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>

            </div>
            <?php

            require "includes/site_footer.php";

            ?>
            <!--/ End Footer Area -->

            <!-- ========================= scroll-top ========================= -->
            <a href="#" class="scroll-top">
                <i class="lni lni-chevron-up"></i>
            </a>

            <!-- ========================= JS here ========================= -->
            <script src="assets2/js/bootstrap.min.js"></script>
            <script src="script2.js"></script>
            <script src="assets2/js/wow.min.js"></script>
            <script src="assets2/js/tiny-slider.js"></script>
            <script src="assets2/js/glightbox.min.js"></script>
            <script src="assets2/js/count-up.min.js"></script>
            <script src="assets2/js/main.js"></script>
        </body>

        </html>
<?php
    } else {
        header("Location : index.php");
    }
} else {
    header("Location: login.php");
}
?>
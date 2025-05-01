<?php

session_start();

require "../connection.php";

if (isset($_SESSION["customer"])) {

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
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Event Managment System - Invoice</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.svg" />

            <!-- ========================= CSS here ========================= -->
            <link rel="stylesheet" href="../assets2/css/bootstrap.min.css" />
            <link rel="stylesheet" href="../assets2/css/LineIcons.3.0.css" />
            <link rel="stylesheet" href="../assets2/css/animate.css" />
            <link rel="stylesheet" href="../assets2/css/tiny-slider.css" />
            <link rel="stylesheet" href="../assets2/css/glightbox.min.css" />
            <link rel="stylesheet" href="../assets2/css/main.css" />


            <style type="text/css">
                body {
                    background: #f5f5f5;
                }

                .ui-w-80 {
                    width: 80px !important;
                    height: auto;
                }

                .btn-default {
                    border-color: rgba(24, 28, 33, 0.1);
                    background: rgba(0, 0, 0, 0);
                    color: #4E5155;
                }

                label.btn {
                    margin-bottom: 0;
                }

                .btn-outline-primary {
                    border-color: #26B4FF;
                    background: transparent;
                    color: #26B4FF;
                }

                .btn {
                    cursor: pointer;
                }

                .text-light {
                    color: #babbbc !important;
                }

                .btn-facebook {
                    border-color: rgba(0, 0, 0, 0);
                    background: #3B5998;
                    color: #fff;
                }

                .btn-instagram {
                    border-color: rgba(0, 0, 0, 0);
                    background: #000;
                    color: #fff;
                }

                .card {
                    background-clip: padding-box;
                    box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
                }

                .row-bordered {
                    overflow: hidden;
                }

                .account-settings-fileinput {
                    position: absolute;
                    visibility: hidden;
                    width: 1px;
                    height: 1px;
                    opacity: 0;
                }

                .account-settings-links .list-group-item.active {
                    font-weight: bold !important;
                }

                html:not(.dark-style) .account-settings-links .list-group-item.active {
                    background: transparent !important;
                }

                .account-settings-multiselect~.select2-container {
                    width: 100% !important;
                }

                .light-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(24, 28, 33, 0.03) !important;
                }

                .light-style .account-settings-links .list-group-item.active {
                    color: #4e5155 !important;
                }

                .material-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(24, 28, 33, 0.03) !important;
                }

                .material-style .account-settings-links .list-group-item.active {
                    color: #4e5155 !important;
                }

                .dark-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(255, 255, 255, 0.03) !important;
                }

                .dark-style .account-settings-links .list-group-item.active {
                    color: #fff !important;
                }

                .light-style .account-settings-links .list-group-item.active {
                    color: #4E5155 !important;
                }

                .light-style .account-settings-links .list-group-item {
                    padding: 0.85rem 1.5rem;
                    border-color: rgba(24, 28, 33, 0.03) !important;
                }
            </style>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </head>

        <body>
            <?php
            require "../includes/site_header2.php";
            ?>

            <!-- Start Breadcrumbs -->
            <div class="breadcrumbs">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                            <div class="breadcrumbs-content">
                                <h1 class="page-title">Invoice</h1>
                                <ul class="breadcrumb-nav">
                                    <li><a href="../index.php">Home</a></li>
                                    <li>Invoice</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumbs -->

            <div class="container light-style flex-grow-1 container-p-y" style="margin-bottom: 50px;">
                <div class="card overflow-hidden mt-5">
                    <div class="row no-gutters row-bordered row-border-light pt-5 pb-5">
                        <div class="col-md-3 pt-0">
                            <?php
                            require "../includes/myAccountSidebar.php";
                            ?>
                        </div>
                        <div class="col-md-9 ">
                            <div class="tab-content">
                                <div class="tab-pane fade active show">
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
                                                            <th class="text-center bg-info text-white">Quote</th>
                                                            <th class="text-center bg-info text-white">Package</th>
                                                            <th class="text-center bg-info text-white">Info</th>
                                                            <th class="text-center bg-info text-white">Paid Amount</th>
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
                                                            <th colspan="3" class="text-center bg-primary text-white">Total Amount for the Event</th>
                                                            <th class="text-center bg-primary text-white">Rs.<?php echo $srow22["quote_total"]; ?>.00</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="3" class="text-center bg-success text-white">Remaining Balance to be Paid</th>
                                                            <th class="text-center bg-success text-white">Rs.<?php echo $srow22["balance"]; ?>.00</th>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- footer  -->

            <?php
            require "../includes/site_footer.php";
            ?>
            <script src="../script2.js"></script>
            <script>
                function printDiv() {
                    var restorepage = document.body.innerHTML;
                    var page = document.getElementById("report").innerHTML;
                    document.body.innerHTML = page;
                    window.print();
                    document.body.innerHTML = restorepage;
                }
            </script>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
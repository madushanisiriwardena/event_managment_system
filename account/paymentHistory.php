<?php

session_start();

require "../connection.php";

if (isset($_SESSION["customer"])) {

    if (isset($_GET["id"])) {

        $qid = $_GET["id"];

        $customer = $_SESSION["customer"]["id"];

        $rs2 = Database::search("SELECT * FROM `customer` WHERE `id` = '" . $customer . "'");
        $n2 = $rs2->num_rows;
        if ($n2 == 1) {
            $value = $rs2->fetch_assoc();
        }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Event Managment System - My Payment History</title>
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
                                <h1 class="page-title">Payment History of Quotation #<?php echo $qid; ?></h1>
                                <ul class="breadcrumb-nav">
                                    <li><a href="../index.php">Home</a></li>
                                    <li>My Payment History</li>
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
                                    <div class="table-responsive p-5">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Payment Info</th>
                                                    <th>Package</th>
                                                    <th>Quotation</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">View</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col">Invoice</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultset = Database::search("SELECT * FROM `slip_upload` WHERE `customer_id`='" . $customer . "' AND `status`='1' AND `quotation_id`='" . $qid . "' ORDER BY `id` DESC");
                                                $n = $resultset->num_rows;
                                                if($n==0){
                                                    ?>
                                                    <td colspan="9" class="text-center"><h5>No data Found Here..</h5></td>
                                                    <?php
                                                }else{
                                                for ($x = 0; $x < $n; $x++) {
                                                    $a = $resultset->fetch_assoc();
                                                ?>
                                                    <tr>
                                                        <td><?php echo $x + 1; ?></td>
                                                        <td><?php echo $a["slip_txt"]; ?></td>
                                                        <td>
                                                            <?php
                                                            $s22 = Database::search("SELECT * FROM `quotation` WHERE `id`='" . $a["quotation_id"] . "' ");
                                                            $srow22 = $s22->fetch_assoc();
                                                            $s23 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $srow22["packages_id"] . "' ");
                                                            $srow23 = $s23->fetch_assoc();
                                                            $s24 = Database::search("SELECT * FROM `categories` WHERE `id`='" . $srow23["categories_id"] . "' ");
                                                            $srow24 = $s24->fetch_assoc();
                                                            echo $srow24["name"];
                                                            echo " ";
                                                            echo $srow23["name"];
                                                            ?>
                                                        </td>
                                                        <td>Quotation #<?php echo $srow22["id"]; ?></td>
                                                        <td>Rs.<?php echo $a["price"]; ?>.00</td>
                                                        <td><?php echo $a["date"]; ?></td>
                                                        <td>
                                                            <?php
                                                            $s21 = Database::search("SELECT * FROM `slip_status` WHERE `id`='" . $a["slip_status_id"] . "' ");
                                                            $srow21 = $s21->fetch_assoc();
                                                            echo $srow21["name"];
                                                            ?>
                                                        </td>
                                                        <td><a href="../uploads/payslips/<?php echo $a["slip_url"]; ?>" class="btn btn-secondary">View</a></td>
                                                        <?php
                                                        if ($a["slip_status_id"] == 3) {
                                                        ?>
                                                            <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $a["id"]; ?>">Pay Again</button></td>
                                                            <div class="modal fade" id="exampleModal<?php echo $a['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">View Comment on your Previous Payment Slip and Proceed to Payment Again</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <h6>Comment from Event Manager</h6><br>
                                                                                    <span>
                                                                                        <?php
                                                                                        echo $a["comment"];
                                                                                        ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <a href="pay.php?id=<?php echo $a['quotation_id']; ?>&status=<?php echo $a['id']; ?>" class="btn btn-primary">Pay Now</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else if ($a["slip_status_id"] == 1) {
                                                        ?>
                                                            <td><button class="btn btn-warning" disabled>Pending</button></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td><button class="btn btn-success" disabled>Success</button></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if($a["slip_status_id"] == 2){
                                                            ?>
                                                            <td><a href="invoice.php?id=<?php echo $a['id'];?>" class="btn btn-primary">Print</a></td>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <td><button class="btn btn-primary" disabled>N/A</button></td>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </tbody>
                                        </table>
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
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>

        </html>

<?php
    } else {
        header("Location : ../index.php");
    }
} else {
    header("Location: ../login.php");
}


?>
<?php

session_start();

require "../connection.php";

if (isset($_SESSION["customer"])) {

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
        <title>Event Managment System - My Approved Events</title>
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
                            <h1 class="page-title">My Approved Events</h1>
                            <ul class="breadcrumb-nav">
                                <li><a href="../index.php">Home</a></li>
                                <li>My Approved Events</li>
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
                                <?php
                                $rs2 = Database::search("SELECT * FROM `quotation` WHERE `customer_id` = '" . $customer . "' AND `quotation_status_id`='2' ORDER BY `id` DESC");
                                $n2 = $rs2->num_rows;
                                if($n2>0){
                                for ($x = 0; $x < $n2; $x++) {
                                    $category = $rs2->fetch_assoc();
                                ?>
                                    <div class="card-body pb-2">
                                        <div class="card">
                                            <div class="card-header">
                                                Quotation #<?php echo $category["id"]; ?>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php
                                                    $s2 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $category["packages_id"] . "' ");
                                                    $srow2 = $s2->fetch_assoc();
                                                    $s3 = Database::search("SELECT * FROM `categories` WHERE `id`='" . $srow2["categories_id"] . "' ");
                                                    $srow3 = $s3->fetch_assoc();
                                                    echo $srow3["name"];
                                                    echo " ";
                                                    echo $srow2["name"];
                                                    ?>
                                                </h5>
                                                <p class="card-text">
                                                    Event Date & Time : <?php echo $category["date_time"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    Participants : <?php echo $category["participants"] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    Quotation Total : Rs.<?php echo $category["quote_total"] ?>.00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <b>Status :
                                                        <?php
                                                        $s24 = Database::search("SELECT * FROM `quotation_status` WHERE `id`='" . $category["quotation_status_id"] . "' ");
                                                        $srow24 = $s24->fetch_assoc();
                                                        echo $srow24["name"];
                                                        ?>
                                                    </b><br><span class="text-danger">Remaining Payment Balance : Rs.<?php echo $category["balance"] ?>.00</span>
                                                </p>
                                                <br>

                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $category["id"]; ?>">Pay Now</button>
                                                <a href="../chat.php?id=<?php echo $category["id"]; ?>" class="btn btn-info">Chat</a>
                                                <a href="paymentHistory.php?id=<?php echo $category["id"]; ?>" class="btn btn-warning">Payment History</a>
                                                <?php
                                                $s21 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $category["packages_id"] . "' ");
                                                $srow21 = $s21->fetch_assoc();
                                                if ($srow21["categories_id"] == 5) {
                                                ?>
                                                    <a href="winfo.php?id=<?php echo $category["id"]; ?>" class="btn btn-secondary">View More</a>
                                                <?php
                                                } else if ($srow21["categories_id"] == 6) {
                                                ?>
                                                    <a href="binfo.php?id=<?php echo $category["id"]; ?>" class="btn btn-secondary">View More</a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal<?php echo $category['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Comment on Quotation and Proceed to Payment</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h6>Comment from Event Manager</h6><br>
                                                            <span>
                                                                <?php
                                                                $s25 = Database::search("SELECT * FROM `comment` WHERE `quotation_id`='" . $category["id"] . "' ");
                                                                $srow25 = $s25->fetch_assoc();
                                                                echo $srow25["description"];
                                                                ?>
                                                            </span>
                                                            <?php
                                                            if($srow25["additionl_price"] == 0){

                                                            }else{
                                                                ?>
                                                                <h6 class="mt-3">Additional Prices Added </h6><br>
                                                            <span>Rs.<?php echo $srow25["additionl_price"]; ?>.00</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="pay.php?id=<?php echo $category['id']; ?>&status=1" class="btn btn-primary">Pay Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="feedback<?php echo $category['id']; ?>" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="feedbackLabel">Provide Feedback</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="form-label">Enter your Feedback about our Service</label>
                                                            <input type="text" class="form-control form-control-user" id="des<?php echo $category['id']; ?>" />
                                                        </div>
                                                        <div class="col-12 mt-4">
                                                            <label class="form-label">How much would you rate us</label>
                                                            <select class="form-select" id="rate<?php echo $category['id']; ?>">
                                                                <option value="0">Select</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                                <option>7</option>
                                                                <option>8</option>
                                                                <option>9</option>
                                                                <option>10</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" onclick="add_feedback(<?php echo $category['id']; ?>);">Submit Feedback</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="reply<?php echo $category['id']; ?>" tabindex="-1" aria-labelledby="replyLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="replyLabel">Feedback History</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="form-label">My Feedback :
                                                                <?php
                                                                $s212 = Database::search("SELECT * FROM `feedback` WHERE `quotation_id`='" . $category["id"] . "' ");
                                                                $srow212 = $s212->fetch_assoc();
                                                                echo $srow212["description"];
                                                                ?>
                                                            </label>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">My Rating :
                                                                <?php
                                                                echo $srow212["rating"];
                                                                ?> / 10
                                                            </label>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Reply :
                                                                <?php
                                                                echo $srow212["reply"];
                                                                ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                            }else{
                                ?>
                                <h5 class="text-center">No data Found !</h5>
                                <?php
                            }
                                ?>
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
    header("Location: ../login.php");
}


?>
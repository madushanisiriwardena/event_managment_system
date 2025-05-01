<?php
require "../connection.php";
session_start();

if (isset($_GET["id"]) and isset($_GET["status"])) {

    $q = $_GET["id"];
    $s = $_GET["status"];

    $product = Database::search("SELECT * FROM `quotation` WHERE `id` = '" . $q . "'");
    $product_rows = $product->num_rows;
    $result = $product->fetch_assoc();
?>
    <!DOCTYPE html>
    <html class="no-js" lang="zxx">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Event Managment System - Pay</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../assets2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets2/css/LineIcons.3.0.css" />
        <link rel="stylesheet" href="../assets2/css/animate.css" />
        <link rel="stylesheet" href="../assets2/css/tiny-slider.css" />
        <link rel="stylesheet" href="../assets2/css/glightbox.min.css" />
        <link rel="stylesheet" href="../assets2/css/main.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            #a1 {
                display: none;
            }

            #a2 {
                display: none;
            }

            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
    </head>

    <body>
        <?php

        require "../includes/site_header.php";

        ?>
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Complete Payment</h1>
                            <ul class="breadcrumb-nav">
                                <li><a href="index.php">Home</a></li>
                                <li>Complete Payment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5 mb-5">

            <div class="row">
                <div class="col-12">
                    <h5 class="text-center">Make your Payment to the Following Bank Account and Upload the Bank Slip and Submit</h5>
                </div>
            </div>

            <div class="row mt-5">

                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <h6>Order Confirmation Details</h6><br>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Package</label>
                                    <?php
                                    $s24 = Database::search("SELECT * FROM `packages` WHERE `id`='" . $result["packages_id"] . "' ");
                                    $srow24 = $s24->fetch_assoc();
                                    $s25 = Database::search("SELECT * FROM `categories` WHERE `id`='" . $srow24["categories_id"] . "' ");
                                    $srow25 = $s25->fetch_assoc();
                                    ?>
                                    <input type="text" class="form-control" value="<?php echo $srow25["name"]; ?> <?php echo $srow24["name"]; ?>" disabled>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Quotation No.</label>
                                    <input type="text" class="form-control" value="Quotation #<?php echo $q ?>" disabled>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Billed To</label>
                                    <?php
                                    $s1 = Database::search("SELECT * FROM `customer` WHERE `id`='" . $result["customer_id"] . "' ");
                                    $srow1 = $s1->fetch_assoc();
                                    ?>
                                    <input type="text" class="form-control" value="<?php echo $srow1["fname"]; ?> <?php echo $srow1["lname"]; ?>" disabled>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Billing Email</label>
                                    <input type="text" class="form-control" value="<?php echo $srow1["email"]; ?>" disabled>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Order Total</label>
                                    <input type="text" class="form-control" value="Rs.<?php echo $result["quote_total"]; ?>.00" disabled>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Remaining Balance</label>
                                    <input type="text" class="form-control" value="Rs.<?php echo $result["balance"]; ?>.00" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body p-5">
                            <h6>Bank Details</h6><br>
                            Bank Name: Peoples Bank<br>
                            Account Name: Event Managment System (Pvt) Ltd<br>
                            Account Number: 000104567654338<br>
                            Branch: First City Branch
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Enter Payment Info</label>
                                    <input type="text" class="form-control" id="info">
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label">Enter Payment Amount in Rs.</label>
                                    <input type="number" class="form-control" id="price" oninput="validity.valid||(value='');">
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

                                <div class="col-8 offset-2 d-grid p-3">
                                    <button class="btn btn-primary btn-user btn-block" onclick="pay_slip_up(<?php echo $result['id']; ?>,<?php echo $s; ?>);">
                                        Submit Payment Slip
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row mt-4 text-center">
                <div class="col-12">
                    <h4>Payment Conditions</h4><br>
                    <h6>Deposit and Final Payment</h6><br>
                    <p>
                        1. Deposit: <br>
                        A non-refundable deposit of [X]% of the total event cost is required to secure the booking.<br>
                        The deposit must be paid within [X] days of booking confirmation.<br>
                        <br>2. Final Payment:<br>
                        The remaining balance must be paid no later than [X] days before the event date.<br>
                        For bookings made within [X] days of the event, full payment is required at the time of booking.<br>
                    </p><br>
                    <h6>
                        Cancellation and Refund Policy</h6></br>
                    <p>
                        1. Cancellation by Client:<br>
                        Cancellations made [X] days before the event will receive a [X]% refund of the final payment, excluding the non-refundable deposit.<br>
                        Cancellations made within [X] days of the event will not be eligible for a refund.<br><br>
                        2. Cancellation by Company:<br>
                        In the unlikely event that we need to cancel your event, a full refund, including the deposit, will be provided.<br>
                    </p><br>
                    <h6>Late Payments and Penalties</h6><br>
                    <p>
                        1. Late Payments:<br>
                        Payments not received by the due date will incur a late fee of [X]% per [time period] until the balance is paid in full.<br>
                        Continued non-payment may result in the cancellation of the booking.<br><br>
                    </p>
                    <h6>Additional Charges</h6><br>
                    <p>
                        1. Changes to Event Scope:<br>
                        Any changes to the event scope or additional services requested after the initial booking may incur additional charges. These charges will be communicated and agreed upon before proceeding.<br>
                        <br>2. Incidental Expenses:<br>
                        Any incidental expenses incurred during the event (e.g., additional equipment, overtime charges) will be billed after the event and must be paid within [X] days of receipt of the invoice.
                    </p><br>
                    <h6>Dispute Resolution</h6><br>
                    <p>
                        1. Disputes:<br>
                        Any payment disputes must be raised in writing within [X] days of receipt of the invoice.<br>
                        We aim to resolve disputes promptly and amicably. If a resolution cannot be reached, the matter will be referred to [Arbitration/Mediation/Legal Process].<br>
                    </p>
                    <br>
                    <h6>Contact Information</h6>
                    <br>
                    <p>
                        For any questions or concerns regarding payments, please contact our billing department at:<br>
                        • Email: [billing@company.com]<br>
                        • Phone: 071 xxx xxxx

                    </p>
                </div>
            </div>
        </div>
        <?php

        require "../includes/site_footer.php";

        ?>
        <!--/ End Footer Area -->

        <!-- ========================= scroll-top ========================= -->
        <a href="#" class="scroll-top">
            <i class="lni lni-chevron-up"></i>
        </a>

        <!-- ========================= JS here ========================= -->
        <script src="../assets2/js/bootstrap.min.js"></script>
        <script src="../script2.js"></script>
        <script src="../assets2/js/wow.min.js"></script>
        <script src="../assets2/js/tiny-slider.js"></script>
        <script src="../assets2/js/glightbox.min.js"></script>
        <script src="../assets2/js/count-up.min.js"></script>
        <script src="../assets2/js/main.js"></script>
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
    </body>

    </html>
<?php
} else {
    header("Location : ../index.php");
}
?>
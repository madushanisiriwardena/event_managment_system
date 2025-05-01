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
        <title>Event Managment System - My Account</title>
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
                            <h1 class="page-title">My Account</h1>
                            <ul class="breadcrumb-nav">
                                <li><a href="../index.php">Home</a></li>
                                <li>My Account</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->

        <div class="container light-style flex-grow-1 container-p-y" style="margin-bottom: 50px;">
            <div class="row">
                <div class="col-md-11 col-9">
                    <h4 class="font-weight-bold py-3 mb-4">
                        Account settings
                    </h4>
                </div>
                <div class="col-md-1 col-3 mt-3">
                    <button type="button" class="btn btn-danger" style="width: 100px" onclick="logout();">Log out</button>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light pt-5 pb-5">
                    <div class="col-md-3 pt-0">
                        <?php
                            require "../includes/myAccountSidebar.php";
                        ?>
                    </div>
                    <div class="col-md-9 ">
                        <div class="tab-content">
                            <div class="tab-pane fade active show">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo $value["fname"] ?>" id="fname">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo $value["lname"] ?>" id="lname">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo $value["email"] ?>" disabled>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" value="<?php echo $value["contact"] ?>" id="mobile">
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-primary" onclick="account_data_save();">Save changes</button>
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
<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {

    $package = $_GET["id"];

    $product = Database::search("SELECT * FROM `packages` WHERE `id` = '" . $package . "' AND `status` = '1'");
    $product_rows = $product->num_rows;
    $result = $product->fetch_assoc();
?>
    <!DOCTYPE html>
    <html class="no-js" lang="zxx">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Event Managment System - Plan your Birthday</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets2/css/LineIcons.3.0.css" />
        <link rel="stylesheet" href="assets2/css/animate.css" />
        <link rel="stylesheet" href="assets2/css/tiny-slider.css" />
        <link rel="stylesheet" href="assets2/css/glightbox.min.css" />
        <link rel="stylesheet" href="assets2/css/main.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            #a1 {
                display: none;
            }

            #a2 {
                display: none;
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
                            <h1 class="page-title">Plan your Birthday</h1>
                            <ul class="breadcrumb-nav">
                                <li><a href="index.php">Home</a></li>
                                <li>Plan your Birthday</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-12 col-md-6 p-3">
                    <label class="form-label">Enter Name of the Birthday Boy / Girl</label>
                    <input type="text" class="form-control " id="name" placeholder="Enter Full Name">
                </div>
                <div class="col-12 col-md-6 p-3">
                    <label class="form-label">Birthday Date & Time</label>
                    <input type="datetime-local" class="form-control" id="dt">
                </div>
                <div class="col-12 col-md-2 p-3">
                    <label class="form-label">No. of Participants</label>
                    <input type="number" class="form-control " id="p" onkeyup="quote_tot();" oninput="validity.valid||(value='');">
                </div>
                <div class="col-12 col-md-3 p-3">
                    <label class="form-label">Do you have a Preffered Location</label>
                    <select class="form-select" id="type" onchange="loc();">
                        <option selected value="0">Select</option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </div>
                <div id="a1" class="col-12 col-md-7 p-3">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label class="form-label">Select Location Type</label>
                            <select class="form-select" id="lpp">
                                <option selected value="0">Select</option>
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-9">
                            <label class="form-label">Enter Location</label>
                            <input type="text" class="form-control " id="loc">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 p-3" id="a2">
                    <label class="form-label">Select Location</label>
                    <select class="form-select" id="location" onchange="venue_add();">
                        <option selected value="0">Select</option>
                        <?php

                        $rs3 = Database::search("SELECT * FROM `venues` WHERE `categories_id` = '6'");
                        $n3 = $rs3->num_rows;

                        for ($i = 1; $i <= $n3; $i++) {
                            $mod = $rs3->fetch_assoc();
                        ?>
                            <option value="<?php echo $mod["id"] ?>"><?php echo $mod["name"] ?> in <?php echo $mod["address"] ?> : Max <?php echo $mod["participants"] ?> participants | Rs.<?php echo $mod["pp_sale"] ?>.00 per person</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 p-3">
                    <label class="form-label">Any Additional Details that we should know?</label>
                    <textarea class="form-control " id="ad" rows="4" cols="50"></textarea>
                </div>
                <div class="col-md-6 col-12 p-3">
                    <label class="form-label">Additional Services you would prefer</label><br>
                    <?php

                    $rs4 = Database::search("SELECT `services`.`id`, `services`.`name`, `services`.`pp_ad`
FROM `services`
LEFT JOIN `assigned_services` ON `services`.`id` = `assigned_services`.`services_id`
    AND `assigned_services`.`packages_id` = '".$result['id']."'
WHERE `assigned_services`.`services_id` IS NULL
    AND `services`.`categories_id` = '6';
");
                    $n4 = $rs4->num_rows;

                    for ($i = 1; $i <= $n4; $i++) {
                        $mod4 = $rs4->fetch_assoc();
                    ?>
                        <input onclick="add_services(<?php echo $mod4['id'] ?>);" type="checkbox" value="<?php echo $mod4["id"] ?>" id="check<?php echo $mod4["id"] ?>">&nbsp;&nbsp;<?php echo $mod4["name"] ?> is Rs.<span id="ad<?php echo $mod4["id"] ?>"><?php echo $mod4["pp_ad"] ?></span> per person.<br>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-6 col-12 p-3">
                    <label class="form-label">Services Available in this Current Package</label><br>
                    <?php
                    $rs6 = Database::search("SELECT * FROM `assigned_services` WHERE `packages_id` = '" . $package . "'");
                    $n6 = $rs6->num_rows;
                    for ($x6 = 0; $x6 < $n6; $x6++) {
                        $pp6 = $rs6->fetch_assoc();
                    ?>
                        <label><?php 
                        $s26 = Database::search("SELECT * FROM `services` WHERE `id`='" . $pp6["services_id"] . "' ");
                        $srow26 = $s26->fetch_assoc();
                        echo $srow26["name"]; 
                        ?></label>
                        <br>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-6 col-12 p-3">
                    <h5>Selected Package : &nbsp;<?php echo $result["name"]; ?></h5>
                </div>
                <div class="col-md-6 col-12 p-3">
                    <span class="d-none" id="price"><?php echo $result["price"]; ?></span>
                    <h5>Quote Total : Rs.<span id="tot"></span></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-4 p-3 d-grid">
                    <button class="btn btn-primary btn-user btn-block" onclick="submit_birth_quote(<?php echo $result['id']; ?>);">
                        Submit Quote
                    </button>
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
        <script>
            function loc() {
                var type = document.getElementById("type").value;
                if (type == "1") {
                    document.getElementById("a1").style.display = "block";
                    document.getElementById("a2").style.display = "none";
                } else if (type == "2") {
                    document.getElementById("a2").style.display = "block";
                    document.getElementById("a1").style.display = "none";
                } else {
                    document.getElementById("a1").style.display = "none";
                    document.getElementById("a2").style.display = "none";
                }
            }

            function quote_tot() {
                var participants = document.getElementById("p").value;
                var price = document.getElementById("price").innerHTML;
                var tot = document.getElementById("tot");

                tot.innerHTML = participants * price;
                document.getElementById("location").value = 0;
            }

            function venue_add() {
                var participants = document.getElementById("p").value;
                if (participants == 0) {
                    alert("Please add number of participants");
                    document.getElementById("location").value = 0;
                } else {
                    var loc = document.getElementById("location").value;
                    var tot = document.getElementById("tot");

                    if (loc == 0) {
                        alert("Please select a Location");
                    } else {
                        var r = new XMLHttpRequest();

                        var f = new FormData();
                        f.append("loc", loc);

                        r.onreadystatechange = function() {
                            if (r.readyState == 4) {
                                var t = r.responseText;
                                var n = Number(tot.innerHTML);
                                var b = Number(t); 
                                var final = n + b*participants;
                                tot.innerHTML = final;
                            }
                        };

                        r.open("POST", "findVenue.php", true);
                        r.send(f);
                    }
                }
            }

            function add_services(id) {

                var participants = document.getElementById("p").value;
                if (participants == 0) {
                    alert("Please add number of participants");
                    document.getElementById("check" + id).checked = false;
                } else {
                    var price = document.getElementById("ad" + id).innerHTML;
                    var tot2 = document.getElementById("tot");
                    var m = price * participants
                    if (document.getElementById("check" + id).checked) {
                        var a = Number(tot2.innerHTML);
                        var final = a + m;
                        tot2.innerHTML = final;
                    } else {
                        var a = Number(tot2.innerHTML);
                        var final = a - m;
                        tot2.innerHTML = final;
                    }
                }
            }
        </script>
        <script src="script2.js"></script>
        <script src="assets2/js/bootstrap.min.js"></script>
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

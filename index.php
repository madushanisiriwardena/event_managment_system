<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Event Managment System - Home</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets2/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="assets2/css/animate.css" />
    <link rel="stylesheet" href="assets2/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets2/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets2/css/main.css" />
    <style>
        .img-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .category-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php

    require "includes/site_header.php";

    ?>

    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="main__circle"></div>
        <div class="main__circle2"></div>
        <div class="main__circle3"></div>
        <div class="main__circle4"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <div class="hero-content">
                        <h5 class="wow zoomIn" data-wow-delay=".2s"><i class="lni lni-map-marker"></i> Minushi Event,
                            Colombo</h5>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">"From Concept to Celebration: Your Event, Perfected."</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">From the initial concept to the final celebration, trust
                            us to perfect every aspect of your event, making it a truly memorable occasion.</p>
                        <div class="button wow fadeInUp" data-wow-delay=".8s">
                            <a href="#category" class="btn ">Let's Plan Your Day</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Count Down Area -->
    <div class="count-down">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="box-head">
                        <div class="box-content">
                            <div class="box">
                                <h1 id="days">20+</h1>
                                <h2 id="daystxt">Total Events</h2>
                            </div>
                            <div class="box">
                                <h1 id="hours">20+</h1>
                                <h2 id="hourstxt">Registered Customers</h2>
                            </div>
                            <div class="box">
                                <h1 id="minutes">10+</h1>
                                <h2 id="minutestxt">Our Partners</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Count Down Area -->

    <!-- Start Features Area -->
    <section class="features section" id="category">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Why join us?</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">A Variety of Categories to Choose</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">"Choose Us for seamless
                            event planning and unforgettable experiences. With our expertise and attention to
                            detail, we turn your vision into reality, ensuring every moment is perfect.
                            Trust us to deliver excellence, from start to finish."</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $rs2 = Database::search("SELECT * FROM `categories` WHERE `status` = '1'");
                $n2 = $rs2->num_rows;

                for ($x = 0; $x < $n2; $x++) {
                    $category = $rs2->fetch_assoc();
                ?>

                    <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-featuer">
                            <div class="col-12">
                                <div class="img-container">
                                    <img src="uploads/categories/<?php echo $category['img']; ?>" class="category-img" />
                                </div>
                            </div>
                            <h3><?php echo $category['name']; ?></h3>
                            <p><?php echo $category['description']; ?></p>
                            <div class="col-12 text-center">
                                <div class="button mt-3">
                                    <a href="packages.php?id=<?php echo $category['id']; ?>" class="btn">View Our Available Packages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- /End Features Area -->

    <!-- Start Amazing Work Area -->
    <section class="features section" id="amazing_work">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Get a Brief Idea by Looking at our Gallery</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Amazing Work</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Some Images of Our Events</p>
                    </div>
                </div>
            </div>
            <div class="row">
<!--                --><?php
//                $rs2 = Database::search("SELECT * FROM `feedback` LIMIT 9");
//                $n2 = $rs2->num_rows;
//
//                for ($x = 0; $x < $n2; $x++) {
//                    $category = $rs2->fetch_assoc();
//                    ?>
                    <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                        <!-- Start Single Feature -->
                        <div class="single-featuer">
                            <img src="assets2/images/amazing_work/deco%201.jpg" alt="">
                        </div>
                        <!-- End Single Feature -->
                    </div>

                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                    <!-- Start Single Feature -->
                    <div class="single-featuer">
                        <img src="assets2/images/amazing_work/Hotel1.png" alt="">
                    </div>
                    <!-- End Single Feature -->
                </div>
<!--                    --><?php
//                }
//                ?>
            </div>
        </div>
    </section>
    <!-- /End Amazing Work Area -->

    <!-- Start Features Area -->
    <section class="features section"id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">What Clients Say About Us?</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Testimonials</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Feedbacks from our Valuable Clients</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $rs2 = Database::search("SELECT * FROM `feedback` LIMIT 9");
                $n2 = $rs2->num_rows;

                for ($x = 0; $x < $n2; $x++) {
                    $category = $rs2->fetch_assoc();
                ?>
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                    <!-- Start Single Feature -->
                    <div class="single-featuer">
                        <span class="serial"><?php echo $category["rating"]; ?>+</span>
                        <div class="service-icon">
                            <i class="lni lni-happy"></i>
                        </div>
                        <h3><?php echo $category["description"]; ?></h3>
                        <p><?php
                        $s2 = Database::search("SELECT * FROM `customer` WHERE `id`='" . $category["customer_id"] . "' ");
                        $srow2 = $s2->fetch_assoc();
                        echo $srow2["fname"];
                        echo " ";
                        echo $srow2["lname"];
                        ?></p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- /End Features Area -->

    <!-- Start About Us Area -->
    <section class="features section" id="about_us">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Who are We?</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">About Us</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Brief Introduction about Our Company</p>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col"><img src="assets2\images\about_us\MinushiLogo.jpg" alt=""></div>
                <div class="col"><p>A business conference organize by EventGrids In. World’s most influential media,
                        entertainment & technology.</p></div>
            </div>

    </section>
    <!-- /End About Us Area -->

    <!-- Start Footer Area -->
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
    <script src="assets2/js/wow.min.js"></script>
    <script src="assets2/js/tiny-slider.js"></script>
    <script src="assets2/js/glightbox.min.js"></script>
    <script src="assets2/js/count-up.min.js"></script>
    <script src="assets2/js/main.js"></script>
    <script>
        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=Gxw45q3Ga3k',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });

        //========= testimonial 
        tns({
            container: '.testimonial-slider',
            items: 3,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 0,
            nav: true,
            controls: false,
            controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 2,
                },
                1170: {
                    items: 3,
                }
            }
        });
    </script>
    <script>
        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

        const timer = () => {
            const now = new Date().getTime();
            let diff = finaleDate - now;
            if (diff < 0) {
                document.querySelector('.alert').style.display = 'block';
                document.querySelector('.container').style.display = 'none';
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
            let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
            let seconds = Math.floor(diff % (1000 * 60) / 1000);

            days <= 99 ? days = `0${days}` : days;
            days <= 9 ? days = `00${days}` : days;
            hours <= 9 ? hours = `0${hours}` : hours;
            minutes <= 9 ? minutes = `0${minutes}` : minutes;
            seconds <= 9 ? seconds = `0${seconds}` : seconds;

            document.querySelector('#days').textContent = days;
            document.querySelector('#hours').textContent = hours;
            document.querySelector('#minutes').textContent = minutes;
            document.querySelector('#seconds').textContent = seconds;

        }
        timer();
        setInterval(timer, 1000);
    </script>
</body>

</html>
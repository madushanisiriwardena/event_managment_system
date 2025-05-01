<?php

session_start();
require "connection.php";

if (isset($_GET["id"])) {

  $category = $_GET["id"];

  $product = Database::search("SELECT * FROM `categories` WHERE `id` = '" . $category . "' AND `status` = '1'");
  $product_rows = $product->num_rows;
  $result = $product->fetch_assoc();
?>

  <!DOCTYPE html>
  <html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Event Managment System - Packages</title>
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
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
            <div class="breadcrumbs-content">
              <h1 class="page-title"><?php echo $result['name'] ?> Packages</h1>
              <ul class="breadcrumb-nav">
                <li><a href="index.php">Home</a></li>
                <li><?php echo $result['name'] ?> Packages</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Breadcrumbs -->
    <section id="pricing" class="pricing-table section extra-page bg-white">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-title">
              <h3 class="wow zoomIn" data-wow-delay=".2s">packages</h3>
              <h2 class="wow fadeInUp" data-wow-delay=".4s">A Variety of Packages to choose for your <?php echo $result['name']; ?></h2>
              <p class="wow fadeInUp" data-wow-delay=".6s">We offer flexible pricing plans tailored to meet your specific
                needs and budget. Choose the plan that best suits your requirements</p>
            </div>
          </div>
        </div>
        <div class="row">

          <?php
          $rs2 = Database::search("SELECT * FROM `packages` WHERE `status` = '1' AND `categories_id` = '" . $result['id'] . "'");
          $n2 = $rs2->num_rows;
          for ($x = 0; $x < $n2; $x++) {
            $p = $rs2->fetch_assoc();

          ?>

            <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
              <!-- Single Table -->
              <div class="single-table">
                <!-- Table Head -->
                <div class="table-head">
                  <h4 class="title"><?php echo $result['name']; ?></h4>
                  <!-- <p>Available tickets for this price</p> -->
                  <div class="price">
                    <h2 class="amount"><?php echo $p['name']; ?></h2>
                  </div>
                </div>
                <!-- End Table Head -->
                <!-- Start Table Content -->
                <div class="table-content">
                  <h6>Included Services in this Package</h6>
                  <!-- Table List -->
                  <ul class="table-list mt-4">
                    <?php
                    $rs1 = Database::search("SELECT * FROM `assigned_services` WHERE `packages_id` = '" . $p['id'] . "'");
                    $n1 = $rs1->num_rows;
                    for ($x1 = 0; $x1 < $n1; $x1++) {
                      $pp = $rs1->fetch_assoc();
                    ?>
                      <li><?php
                          $s2 = Database::search("SELECT * FROM `services` WHERE `id`='" . $pp["services_id"] . "' ");
                          $srow2 = $s2->fetch_assoc();
                          echo $srow2["name"];
                          ?>
                      </li>
                    <?php
                    }
                    ?>
                  </ul>
                  <!-- End Table List -->
                </div>
                <div class="button">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#p<?php echo $p['id']; ?>">
                    View More
                  </button>
                </div>
                <!-- End Table Content -->
              </div>
              <!-- End Single Table-->
            </div>

            <div class="modal fade" id="p<?php echo $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">More Details about <?php echo $result['name']; ?> <?php echo $p['name']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                      <div class="col-md-10">

                        <div class="row mb-4">
                          <div class="col-md-6">
                            <div class="images p-3">
                              <div class="text-center">
                                <div class="col-12">
                                  <div class="img-container">
                                    <img src="uploads/categories/<?php echo $result['img']; ?>" />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="product">
                              <div class="mt-4 mb-3">
                                <h3 class="text-uppercase"><?php echo $result['name']; ?> <?php echo $p['name']; ?></h3>
                                <!-- <div class="price d-flex flex-row align-items-center"> <span class="act-price">$20</span>
                                    <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span> </div>
                                  </div> -->
                              </div>
                              <div class="table-content">
                                <h5>Included Services in this Package</h5>
                                <!-- Table List -->
                                <ul class="table-list mt-4">
                                  <?php
                                  $rs6 = Database::search("SELECT * FROM `assigned_services` WHERE `packages_id` = '" . $p['id'] . "'");
                                  $n6 = $rs6->num_rows;
                                  for ($x6 = 0; $x6 < $n6; $x6++) {
                                    $pp6 = $rs6->fetch_assoc();
                                  ?>
                                    <li><?php
                                        $s26 = Database::search("SELECT * FROM `services` WHERE `id`='" . $pp6["services_id"] . "' ");
                                        $srow26 = $s26->fetch_assoc();
                                        ?>
                                      <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="<?php
                                        echo $srow26["description"]; ?>">
                                        <?php
                                        echo $srow26["name"]; ?>
                                      </button>
                                    </li>
                                  <?php
                                  }
                                  ?>
                                </ul>
                                <!-- End Table List -->
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" onclick="goToQuote(<?php echo $p['id']; ?>,<?php echo $result['id']; ?>);">Next</button>
                    </div>
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
    <!--/ End Pricing Table Area -->

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
    <script src="script2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
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
      const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
      const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

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

<?php
} else {
  header("Location : index.php");
}
?>
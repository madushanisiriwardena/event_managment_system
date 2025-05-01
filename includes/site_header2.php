<!-- Start Header Area -->
<header class="header navbar-area">
    <div class="container" style="padding-left: 0;padding-right: 0">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="../index.php">
                            <!-- <img src="assets/images/logo/logo.svg" alt="Logo"> -->
                            <h2 class="text-light">Minushi Events</h2>
                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="../index.php" class="active" aria-label="Toggle navigation">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../index.php#category" aria-label="Toggle navigation">Get a Quote</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../index.php#amazing_work" aria-label="Toggle navigation">Amazing Work</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../index.php#testimonials" aria-label="Toggle navigation">Testimonials</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../index.php#about_us"="Toggle navigation">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../index.php#contact_us" aria-label="Toggle navigation">Contact Us</a>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->
                        <?php
                        if (isset($_SESSION["customer"])) {
                        ?>
                            <div class="button">
                                <a href="myAccount.php" class="btn">My Account<i class="lni lni-user"></i></a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="button">
                                <a href="myAccount.php" class="btn">Login / Register<i class="lni lni-user"></i></a>
                            </div>
                        <?php
                        }

                        ?>

                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>
<!-- End Header Area -->
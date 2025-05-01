
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Event Management | Register</title>

        <!-- Custom fonts for this template-->
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body class="bg-gradient-success">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9 ">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block" style="background: url('assets2/images/img1.jpeg');
  background-position: center;
  background-size: cover;"></div>
                                <div class="col-lg-6">
                                    <div class="px-5 pt-4 pb-4">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-3 mt-2">Create An Account!</h1>
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <select class=" text-center form-control " id="category" placeholder="Select User Type">
                                                    <option value="0">Select user type</option>
                                                    <option value="1">Customer</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control " id="fname" placeholder="Enter Your First Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control " id="lname" placeholder="Enter Your Last Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control " id="mobile" placeholder="Enter Your Mobile Number">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control " id="password" placeholder="Enter Your Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control " id="password2" placeholder="Re-Enter Your Password">
                                            </div>
                                            <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                            <a href="#" class="btn btn-success btn-user btn-block mt-2 mb-2" onclick="register();">
                                                Create Account
                                            </a>
                                            <p >Already have an account?</p>
                                            <a href="login.php" class="btn btn-dark btn-user btn-block mb-2">
                                                Login
                                            </a>
                                        </form>
                                        <!-- <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <script src="script2.js"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>

    </body>

    </html>

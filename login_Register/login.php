<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="EstateConnect" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../fonts/icomoon/style.css" />
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="../css/tiny-slider.css" />
    <link rel="stylesheet" href="../css/aos.css" />
    <link rel="stylesheet" href="../css/style.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <title>Login &mdash; EstateConnect</title>

        <style>
            /* small page overrides to keep green accents coherent */
            .btn-custom{background:#198754;border-color:#198754;color:#fff}
            .btn-custom:hover{background:#146c43;border-color:#146c43}
            .highlight{color:#198754}
            .card{border-radius:12px;border:0}
            .card-header{background:#198754;color:#fff}
            .site-section .container{padding-top:30px;padding-bottom:48px}
        </style>
</head>

<body>
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close">
                    <span class="icofont-close js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <nav class="site-nav">
            <div class="container">
                <div class="menu-bg-wrap">
                    <div class="site-navigation">
                        <a href="../index.php" class="logo m-0 float-start">EstateConnect</a>

                        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../properties.php">Properties</a></li>
                            <li><a href="../services.php">Services</a></li>
                            <li><a href="../about.php">About</a></li>
                            <li><a href="../contact.php">Contact Us</a></li>
                        </ul>

                        <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"><span></span></a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="site-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card" data-aos="fade-up" data-aos-delay="100">
                            <div class="card-header text-center">
                                <h4 class="mb-0">Login</h4>
                            </div>
                            <div class="card-body">
                        <!-- Alert Messages (To be handled by backend) -->
                        <!-- Example:
                        <div class="alert alert-info text-center">Login successful!</div>
                        -->

                                                <form method="POST" action="" class="mt-4" id="login-form">
                                                        <div class="mb-3">
                                                                <label for="customer_email" class="form-label">Email <i class="fa fa-envelope"></i></label>
                                                                <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Enter your email address" required>
                                                        </div>
                                                        <div class="mb-4">
                                                                <label for="customer_pass" class="form-label">Password <i class="fa fa-lock"></i></label>
                                                                <input type="password" class="form-control" id="customer_pass" name="customer_pass" placeholder="Enter your password" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-custom w-100" id="login-submit-btn">
                                                                <i class="fas fa-sign-in-alt me-2"></i>Login
                                                        </button>
                                                </form>
                    </div>
                                        <div class="card-footer text-center">
                                            Don't have an account? <a href="register.php" class="highlight">Register here</a>.
                                        </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget">
                            <h3>Contact</h3>
                            <address>21 Osu Oxford St., Accra</address>
                            <ul class="list-unstyled links">
                                <li><a href="tel:+233201234567">+233 (20) 123-4567</a></li>
                                <li><a href="tel:+233505123456">+233 (50) 512-3456</a></li>
                                <li><a href="mailto:info@mydomain.com">info@mydomain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget">
                            <h3>Sources</h3>
                            <ul class="list-unstyled float-start links">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Vision</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget">
                            <h3>Links</h3>
                            <ul class="list-unstyled links">
                                <li><a href="#">Our Vision</a></li>
                                <li><a href="#">About us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preloader -->
        <div id="overlayer"></div>
        <div class="loader">
            <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>

        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/tiny-slider.js"></script>
        <script src="../js/aos.js"></script>
        <script src="../js/navbar.js"></script>
        <script src="../js/counter.js"></script>
        <script src="../js/custom.js"></script>
        <script src="../js/localize.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../js/login.js"></script>

        <script>
            AOS.init();
        </script>
    </body>
</html>
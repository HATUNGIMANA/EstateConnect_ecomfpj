<?php
session_start();
if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }
$cart_count = 0;
foreach ($_SESSION['cart'] as $it) { $cart_count += isset($it['qty']) ? (int)$it['qty'] : 0; }
?>
<!-- /*
* Template Name: EstateConnect
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>
      EstateConnect &mdash; Services
    </title>
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
            <a href="index.php" class="logo m-0 float-start">EstateConnect</a>

            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
              <li><a href="index.php">Home</a></li>
              <li class="has-children">
                <a href="properties.php">Properties</a>
                <ul class="dropdown">
                  <li><a href="http://localhost/Ecommerce/Final_Project/EstateConnect/properties.php">Buy</a></li>
                  <li><a href="actions/add_property.php">Sell</a></li>
                </ul>
              </li>
              <li class="active"><a href="services.php">Services</a></li>
              <!-- About and Contact removed from navbar -->
              <li>
                <a href="cart.php"><span class="icon-shopping_cart"></span> Cart<?php if($cart_count>0) echo ' (' . $cart_count . ')'; ?></a>
              </li>
              <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                <li class="cta-button"><a href="login_Register/logout.php" class="btn btn-outline-danger" onclick="return confirm('Do you really want to log out?');">Logout</a></li>
                <li class="cta-button"><a href="login_Register/profile_edit.php" class="btn btn-success">Edit Profile</a></li>
              <?php else: ?>
                <li class="cta-button"><a href="login_Register/login.php" class="btn btn-success">Login</a></li>
                <li class="cta-button"><a href="login_Register/register.php" class="btn btn-outline-success">Register</a></li>
              <?php endif; ?>
            </ul>

            <a
              href="#"
              class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
              data-toggle="collapse"
              data-target="#main-navbar"
            >
              <span></span>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Mission</h1>
            <p class="text-white-50" data-aos="fade-up" data-aos-delay="100">To become Ghana’s most reliable, affordable, and accessible e-commerce platform for real estate transactions.</p>

            <h1 class="heading mt-3" data-aos="fade-up">Vision</h1>
            <p class="text-white-50" data-aos="fade-up" data-aos-delay="150">To connect property owners, real estate agents, and customers through a secure, verified, and user-friendly e-commerce platform.</p>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                  Mission &amp; Vision
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="box-feature mb-4">
              <span class="flaticon-house mb-4 d-block"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                Quality Properties
              </h3>
              <p class="text-black-50">
                Listings on EstateConnect are rigorously verified to ensure credible ownership and accurate documentation. Our streamlined processes remove uncertainty so buyers and sellers transact with confidence.
              </p>
              <p><a href="services.php" class="learn-more">Learn More</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="box-feature mb-4">
              <span class="flaticon-house-2 mb-4 d-block-3"></span>
              <h3 class="text-black mb-3 font-weight-bold">Top Rated Agent</h3>
              <p class="text-black-50">
                Our partner agents are vetted and supported by EstateConnect tools to deliver smooth communications and secure transaction handling from listing to closing.
              </p>
              <p><a href="services.php" class="learn-more">Learn More</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="box-feature mb-4">
              <span class="flaticon-building mb-4 d-block"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                Property for Sale
              </h3>
              <p class="text-black-50">
                Every property for sale includes clear title references and transaction support so buyers can progress from offer to completion with minimal friction.
              </p>
              <p><a href="services.php" class="learn-more">Learn More</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box-feature mb-4">
              <span class="flaticon-house-3 mb-4 d-block-1"></span>
              <h3 class="text-black mb-3 font-weight-bold">House for Sale</h3>
              <p class="text-black-50">
                Residential listings provide inspection summaries and verified ownership details—helping you find a home backed by clear documentation and trusted support.
              </p>
              <p><a href="services.php" class="learn-more">Learn More</a></p>
            </div>
          </div>

          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="box-feature mb-4">
              <span class="flaticon-house-4 mb-4 d-block"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                Quality Properties
              </h3>
              <p class="text-black-50">
                Far far away, behind the word mountains, far from the countries
                Vokalia and Consonantia, there live the blind texts.
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="box-feature mb-4">
              <span class="flaticon-building mb-4 d-block-3"></span>
              <h3 class="text-black mb-3 font-weight-bold">Top Rated Agent</h3>
              <p class="text-black-50">
                Far far away, behind the word mountains, far from the countries
                Vokalia and Consonantia, there live the blind texts.
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="box-feature mb-4">
              <span class="flaticon-house mb-4 d-block"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                Property for Sale
              </h3>
              <p class="text-black-50">
                Far far away, behind the word mountains, far from the countries
                Vokalia and Consonantia, there live the blind texts.
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box-feature mb-4">
              <span class="flaticon-house-1 mb-4 d-block-1"></span>
              <h3 class="text-black mb-3 font-weight-bold">House for Sale</h3>
              <p class="text-black-50">
                Far far away, behind the word mountains, far from the countries
                Vokalia and Consonantia, there live the blind texts.
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section sec-testimonials">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-6">
            <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
              What Our Satisfied Customers Say:
            </h2>
          </div>
          <div class="col-md-6 text-md-end">
            <div id="testimonial-nav">
              <span class="prev" data-controls="prev">Prev</span>

              <span class="next" data-controls="next">Next</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4"></div>
        </div>
        <div class="testimonial-slider-wrap">
          <div class="testimonial-slider">
            <div class="item">
              <div class="testimonial">
                <img src="images/agent1.jpg" alt="James Smith" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">James Smith</h3>
                <blockquote>
                  <p>
                    "EstateConnect's agents were knowledgeable and clear. The verification reports helped me make an informed decision. Closing was smooth and stress-free."
                  </p>
                </blockquote>
                
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img src="images/agent2.jpeg" alt="Mike Houston" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">Mike Houston</h3>
                <blockquote>
                  <p>
                    "Transparent pricing and reliable documentation made all the difference. I felt supported through the negotiation. Excellent service from start to finish."
                  </p>
                </blockquote>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img src="images/agent3.jpg" alt="Cameron Webster" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">Cameron Webster</h3>
                <blockquote>
                  <p>
                    "The platform reduced uncertainty around ownership. Inspections and title summaries were thorough. A trustworthy marketplace I can rely on."
                  </p>
                </blockquote>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img src="images/male_silhouette.png" alt="Customer - Dave Smith" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">Dave Smith</h3>
                <blockquote>
                  <p>
                    "Professional agents and clear processes made my purchase painless. I closed without surprises. I would use EstateConnect again."
                  </p>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-footer">
      <div class="container">
        <div class="row mt-5">
          <div class="col-12 text-center">
            <p>Copyright &copy; 2025. All Rights Reserved.</p>
          </div>
        </div>
      </div>
      <!-- /.site-footer -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/localize.js"></script>
  </body>
</html>

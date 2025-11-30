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
      EstateConnect &mdash; About Us
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

            <ul
              class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end"
            >
              <li><a href="index.php">Home</a></li>
              <li class="has-children">
                <a href="properties.php">Properties</a>
                <ul class="dropdown">
                  <li><a href="#">Buy</a></li>
                  <li><a href="#">Sell</a></li>
                  <li class="has-children">
                    <a href="#">Dropdown</a>
                    <ul class="dropdown">
                      <li><a href="#">Sub Menu One</a></li>
                      <li><a href="#">Sub Menu Two</a></li>
                      <li><a href="#">Sub Menu Three</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="services.php">Services</a></li>
              <li class="active"><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact Us</a></li>
              <li>
                <a href="cart.php"><span class="icon-shopping_cart"></span> Cart<?php if($cart_count>0) echo ' (' . $cart_count . ')'; ?></a>
              </li>
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
      style="background-image: url('images/hero_bg_3.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">About</h1>

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
                  About
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row text-left mb-5">
          <div class="col-12">
            <h2 class="font-weight-bold heading text-primary mb-4">About EstateConnect</h2>
          </div>
          <div class="col-lg-6">
            <h3 class="heading">Mission</h3>
            <p class="text-black-50">To become Ghana’s most reliable, affordable, and accessible e-commerce platform for real estate transactions.</p>

            <h3 class="heading mt-4">Vision</h3>
            <p class="text-black-50">To connect property owners, real estate agents, and customers through a secure, verified, and user-friendly e-commerce platform.</p>

            <h3 class="heading mt-4">Core Value Proposition</h3>
            <p class="text-black-50">EstateConnect bridges customers and property owners (and property owners among themselves) by providing rich, interactive property listings (images, text, audio, and video), enhanced security to reduce fraud, and an inclusive freemium plan for small and low-income users.</p>
          </div>
          <div class="col-lg-6">
            <h3 class="heading">Goals & Objectives</h3>
            <ul class="text-black-50">
              <li>Centralize property information for easier access.</li>
              <li>Support both established and small real estate businesses in reaching customers efficiently.</li>
              <li>Reduce fraud in the real estate market through verification and security features.</li>
              <li>Expand services to multiple cities in Ghana and build strong partnerships.</li>
              <li>Become a regional leader in real estate e-commerce services.</li>
            </ul>
            <p class="text-black-50 mt-3">EstateConnect will initially focus on Ghanaian cities and expand regionally as trusted partnerships and verification systems mature. Our freemium model ensures broad participation while premium tiers unlock advanced tools for businesses.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="section pt-0">
      <div class="container">
        <div class="row justify-content-between mb-5">
          <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
            <div class="img-about dots">
              <img src="images/hero_bg_3.jpg" alt="Image" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-4">
            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-home2"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Quality properties</h3>
                <p class="text-black-50">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Nostrum iste.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-person"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Top rated agents</h3>
                <p class="text-black-50">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Nostrum iste.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-security"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Easy and safe</h3>
                <p class="text-black-50">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Nostrum iste.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section pt-0">
      <div class="container">
        <div class="row justify-content-between mb-5">
          <div class="col-lg-7 mb-5 mb-lg-0">
            <div class="img-about dots">
              <img src="images/hero_bg_2.jpg" alt="Image" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-4">
            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-home2"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Quality properties</h3>
                <p class="text-black-50">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Nostrum iste.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-person"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Top rated agents</h3>
                <p class="text-black-50">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Nostrum iste.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-security"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Easy and safe</h3>
                <p class="text-black-50">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Nostrum iste.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
            <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
          </div>
          <div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
            <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
          </div>
        </div>
        <div class="row section-counter mt-5">
          <div
            class="col-6 col-sm-6 col-md-6 col-lg-3"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <div class="counter-wrap mb-5 mb-lg-0">
              <span class="number"
                ><span class="countup text-primary">2917</span></span
              >
              <span class="caption text-black-50"># of Buy Properties</span>
            </div>
          </div>
          <div
            class="col-6 col-sm-6 col-md-6 col-lg-3"
            data-aos="fade-up"
            data-aos-delay="400"
          >
            <div class="counter-wrap mb-5 mb-lg-0">
              <span class="number"
                ><span class="countup text-primary">3918</span></span
              >
              <span class="caption text-black-50"># of Sell Properties</span>
            </div>
          </div>
          <div
            class="col-6 col-sm-6 col-md-6 col-lg-3"
            data-aos="fade-up"
            data-aos-delay="500"
          >
            <div class="counter-wrap mb-5 mb-lg-0">
              <span class="number"
                ><span class="countup text-primary">38928</span></span
              >
              <span class="caption text-black-50"># of All Properties</span>
            </div>
          </div>
          <div
            class="col-6 col-sm-6 col-md-6 col-lg-3"
            data-aos="fade-up"
            data-aos-delay="600"
          >
            <div class="counter-wrap mb-5 mb-lg-0">
              <span class="number"
                ><span class="countup text-primary">1291</span></span
              >
              <span class="caption text-black-50"># of Agents</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section sec-testimonials bg-light">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-6">
            <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
              The Team
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
                <img
                  src="images/person_1-min.jpg"
                  alt="Image"
                  class="img-fluid rounded-circle w-25 mb-4"
                />
                <h3 class="h5 text-primary">James Smith</h3>
                <p class="text-black-50">Designer, Co-founder</p>

                <p>
                  Far far away, behind the word mountains, far from the
                  countries Vokalia and Consonantia, there live the blind texts.
                  Separated they live in Bookmarksgrove right at the coast of
                  the Semantics, a large language ocean.
                </p>

                <ul class="social list-unstyled list-inline dark-hover">
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img
                  src="images/person_2-min.jpg"
                  alt="Image"
                  class="img-fluid rounded-circle w-25 mb-4"
                />
                <h3 class="h5 text-primary">Carol Houston</h3>
                <p class="text-black-50">Designer, Co-founder</p>

                <p>
                  Far far away, behind the word mountains, far from the
                  countries Vokalia and Consonantia, there live the blind texts.
                  Separated they live in Bookmarksgrove right at the coast of
                  the Semantics, a large language ocean.
                </p>

                <ul class="social list-unstyled list-inline dark-hover">
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img
                  src="images/person_3-min.jpg"
                  alt="Image"
                  class="img-fluid rounded-circle w-25 mb-4"
                />
                <h3 class="h5 text-primary">Synthia Cameron</h3>
                <p class="text-black-50">Designer, Co-founder</p>

                <p>
                  Far far away, behind the word mountains, far from the
                  countries Vokalia and Consonantia, there live the blind texts.
                  Separated they live in Bookmarksgrove right at the coast of
                  the Semantics, a large language ocean.
                </p>

                <ul class="social list-unstyled list-inline dark-hover">
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img
                  src="images/person_4.jpg"
                  alt="Image"
                  class="img-fluid rounded-circle w-25 mb-4"
                />
                <h3 class="h5 text-primary">Davin Smith</h3>
                <p class="text-black-50">Designer, Co-founder</p>

                <p>
                  Far far away, behind the word mountains, far from the
                  countries Vokalia and Consonantia, there live the blind texts.
                  Separated they live in Bookmarksgrove right at the coast of
                  the Semantics, a large language ocean.
                </p>

                <ul class="social list-unstyled list-inline dark-hover">
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
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
              <address>43 Raymouth Rd. Baltemoer, London 3910</address>
              <ul class="list-unstyled links">
                <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                <li>
                  <a href="mailto:info@mydomain.com">info@mydomain.com</a>
                </li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="widget">
              <h3>Sources</h3>
              <ul class="list-unstyled float-start links">
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Vision</a></li>
                <li><a href="#">Mission</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy</a></li>
              </ul>
              <ul class="list-unstyled float-start links">
                <li><a href="#">Partners</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Creative</a></li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="widget">
              <h3>Links</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Our Vision</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
              </ul>

              <ul class="list-unstyled social">
                <li>
                  <a href="#"><span class="icon-instagram"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-twitter"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-facebook"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-linkedin"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-pinterest"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-dribbble"></span></a>
                </li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

        <div class="row mt-5">
          <div class="col-12 text-center">
            <!-- 
              **==========
              NOTE: 
              Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
              **==========
            -->

            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.</p>
          </div>
        </div>
      </div>
      <!-- /.container -->
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

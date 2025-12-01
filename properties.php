<?php
session_start();
if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }
$cart_count = 0;
foreach ($_SESSION['cart'] as $it) { $cart_count += isset($it['qty']) ? (int)$it['qty'] : 0; }
// Helper to render a random price between GHS 10,000 and GHS 50,000
function random_price_display() {
  return 'GHS ' . number_format(rand(10000, 50000));
}
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
      EstateConnect &mdash; Properties
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
              <li class="has-children active">
                <a href="properties.php">Properties</a>
                <ul class="dropdown">
                  <li><a href="#">Buy</a></li>
                  <li><a href="actions/add_property.php">Sell</a></li>
                  <!-- Removed extra 'Dropdown' submenu -->
                </ul>
              </li>
              <li><a href="services.php">Services</a></li>
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
            <h1 class="heading" data-aos="fade-up">Properties</h1>

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
                  Properties
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <?php if (!empty($_SESSION['property_success'])): ?>
          <div class="alert alert-success text-center"><?php echo htmlspecialchars($_SESSION['property_success']); unset($_SESSION['property_success']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['property_error'])): ?>
          <div class="alert alert-danger text-center"><?php echo htmlspecialchars($_SESSION['property_error']); unset($_SESSION['property_error']); ?></div>
        <?php endif; ?>
      </div>
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-6 text-center mx-auto">
            <h2 class="font-weight-bold text-primary heading">
              Featured Properties
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="property-slider-wrap">
              <div class="property-slider">
                <div class="property-item">
                  <a href="property-single.php" class="img">
                    <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        >21 Osu Oxford St.</span
                      >
                      <span class="city d-block mb-3">Accra, Ghana</span>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption">2 beds</span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption">2 baths</span>
                        </span>
                      </div>

                      <a
                        href="property-single.php?id=10"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
                <!-- .item -->

                <div class="property-item">
                  <a href="property-single.php" class="img">
                    <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        >14 Kejetia Rd.</span
                      >
                      <span class="city d-block mb-3">Kumasi, Ghana</span>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption">2 beds</span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption">2 baths</span>
                        </span>
                      </div>

                      <a
                        href="property-single.php?id=11"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
                <!-- .item -->

                <div class="property-item">
                  <a href="property-single.php" class="img">
                    <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        >7 Tamale Rd., Sakasaka</span
                      >
                      <span class="city d-block mb-3">Tamale, Ghana</span>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption">2 beds</span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption">2 baths</span>
                        </span>
                      </div>

                      <a
                        href="property-single.php?id=12"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
                <!-- .item -->

                <div class="property-item">
                  <a href="property-single.php" class="img">
                    <img src="images/img_4.jpg" alt="Image" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        >44 Beach Rd., Dixcove</span
                      >
                      <span class="city d-block mb-3">Takoradi, Ghana</span>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption">2 beds</span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption">2 baths</span>
                        </span>
                      </div>

                      <a
                        href="property-single.php?id=13"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
                <!-- .item -->

                <div class="property-item">
                  <a href="property-single.php" class="img">
                    <img src="images/img_5.jpg" alt="Image" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        >10 Cape Coast St.</span
                      >
                      <span class="city d-block mb-3">Cape Coast, Ghana</span>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption">2 beds</span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption">2 baths</span>
                        </span>
                      </div>

                      <a
                        href="property-single.php?id=14"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
                <!-- .item -->
              </div>

              <div
                id="property-nav"
                class="controls"
                tabindex="0"
                aria-label="Carousel Navigation"
              >
                <span
                  class="prev"
                  data-controls="prev"
                  aria-controls="property"
                  tabindex="-1"
                  >Prev</span
                >
                <span
                  class="next"
                  data-controls="next"
                  aria-controls="property"
                  tabindex="-1"
                  >Next</span
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-properties">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
                    <a href="property-single.php?id=15" class="img">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                        href="property-single.php?id=16"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php?id=17" class="img">
                <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php?id=18"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php?id=19" class="img">
                <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php?id=20"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>

          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php?id=21" class="img">
                <img src="images/img_4.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php?id=22"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php" class="img">
                <img src="images/img_5.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php" class="img">
                <img src="images/img_6.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>

          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php" class="img">
                <img src="images/img_7.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php" class="img">
                <img src="images/img_8.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <a href="property-single.php" class="img">
                <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
              </a>

                <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"
                    >21 Osu Oxford St.</span
                  >
                  <span class="city d-block mb-3">Accra, Ghana</span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption">2 beds</span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption">2 baths</span>
                    </span>
                  </div>

                  <a
                    href="property-single.php"
                    class="btn btn-primary py-2 px-3"
                    >See details</a
                  >
                </div>
              </div>
            </div>
            <!-- .item -->
          </div>
        </div>
        <div class="row align-items-center py-5">
          <div class="col-lg-3">Pagination (1 of 10)</div>
          <div class="col-lg-6 text-center">
            <div class="custom-pagination">
              <a href="#">1</a>
              <a href="#" class="active">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              <a href="#">5</a>
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

    <!-- Preloader disabled to avoid blocking when JS errors occur -->
    <div id="overlayer" style="display:none"></div>
    <div class="loader" style="display:none">
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

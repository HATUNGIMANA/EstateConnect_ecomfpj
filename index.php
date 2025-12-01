<?php
session_start();
if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }
$cart_count = 0;
foreach ($_SESSION['cart'] as $it) { $cart_count += isset($it['qty']) ? (int)$it['qty'] : 0; }
// Helper to produce a random price between 10,000 and 50,000 GHS
function random_price_display() {
  return 'GHS ' . number_format(rand(10000, 50000));
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="EstateConnect" />
    <meta name="description" content="EstateConnect - Secure Real Estate Marketplace" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>EstateConnect &mdash; Secure Real Estate E-commerce Platform</title>
    <style>
      /* Homepage typography scale-down overrides */
      body { font-size: 14px; }
      .hero .heading { font-size: 28px !important; line-height: 1.2 !important; }
      .narrow-w.form-search .form-control { font-size: 14px; }
      .section .heading { font-size: 20px !important; }
      .property-content .price span { font-size: 16px !important; }
      .property-content .caption, .property-content .city, .property-content .text-black-50 { font-size: 13px !important; }
      .box-feature h3 { font-size: 16px !important; }
      .testimonial .h5 { font-size: 14px !important; }
      .site-footer p { font-size: 13px; }
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
            <a href="index.php" class="logo m-0 float-start">EstateConnect</a>

            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
              <li class="active"><a href="index.php">Home</a></li>
              <li class="has-children">
                <a href="properties.php">Properties</a>
                <ul class="dropdown">
                  <li><a href="http://localhost/Ecommerce/Final_Project/EstateConnect/properties.php">Buy</a></li>
                  <li><a href="actions/add_property.php">Sell</a></li>
                </ul>
              </li>
              <li><a href="services.php">Services</a></li>
              <li>
                <a href="cart.php"><span class="icon-shopping_cart"></span> Cart<?php if($cart_count>0) echo ' (' . $cart_count . ')'; ?></a>
              </li>
              <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                <li class="nav-item"><span class="nav-hello"><?php echo htmlspecialchars($_SESSION['user']['name'] ?? ($_SESSION['user']['full_name'] ?? 'User')); ?></span></li>
                <li class="cta-button"><a href="login_Register/logout.php" class="btn btn-outline-danger" onclick="return confirm('Do you really want to log out?');">Logout</a></li>
                <li class="cta-button"><a href="login_Register/profile_edit.php" class="btn btn-success">Edit Profile</a></li>
              <?php else: ?>
                <li class="cta-button"><a href="login_Register/login.php" class="btn btn-success">Login</a></li>
                <li class="cta-button"><a href="login_Register/register.php" class="btn btn-outline-success">Register</a></li>
              <?php endif; ?>
            </ul>

            <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar"><span></span></a>
          </div>
        </div>
      </div>
    </nav>

    <div class="hero">
      <div class="hero-slide">
        <div class="img overlay" style="background-image: url('images/hero_bg_3.jpg')"></div>
        <div class="img overlay" style="background-image: url('images/hero_bg_2.jpg')"></div>
        <div class="img overlay" style="background-image: url('images/hero_bg_1.jpg')"></div>
      </div>

      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center">
            <h1 class="heading" data-aos="fade-up">Welcome to EstateConnect, where seamless transactions meet trust verified by the Ghana Lands Commission. We eliminate fraud by ensuring credible ownership for every listing on our platform. Find your dream home safely and effortlessly.</h1>

            <form action="#" class="narrow-w form-search mb-3" data-aos="fade-up" data-aos-delay="200">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Your city or area. e.g. Accra" />
                <button class="btn btn-primary" type="submit"><span class="icon-search me-2"></span>Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-6">
            <h2 class="font-weight-bold text-primary heading">Popular Properties</h2>
          </div>
          <div class="col-lg-6 text-lg-end">
            <p><a href="http://localhost/Ecommerce/Final_Project/EstateConnect/properties.php" class="btn btn-primary text-white py-3 px-4">View all properties</a></p>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">
            <div class="property-item">
              <a href="property-single.php?id=1" class="img"><img src="images/img_1.jpg" alt="Image" class="img-fluid" /></a>
              <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">21 Osu Oxford St.</span>
                  <span class="city d-block mb-3">Accra, Ghana</span>
                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3"><span class="icon-bed me-2"></span><span class="caption">2 beds</span></span>
                    <span class="d-block d-flex align-items-center"><span class="icon-bath me-2"></span><span class="caption">2 baths</span></span>
                  </div>
                  <a href="property-single.php?id=1" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">
            <div class="property-item">
              <a href="property-single.php?id=2" class="img"><img src="images/img_2.jpg" alt="Image" class="img-fluid" /></a>
              <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">14 Kejetia Rd.</span>
                  <span class="city d-block mb-3">Kumasi, Ghana</span>
                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3"><span class="icon-bed me-2"></span><span class="caption">2 beds</span></span>
                    <span class="d-block d-flex align-items-center"><span class="icon-bath me-2"></span><span class="caption">2 baths</span></span>
                  </div>
                  <a href="property-single.php?id=2" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">
            <div class="property-item">
              <a href="property-single.php?id=3" class="img"><img src="images/img_3.jpg" alt="Image" class="img-fluid" /></a>
              <div class="property-content">
                <div class="price mb-2"><span><?php echo random_price_display(); ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50">7 Tamale Rd., Sakasaka</span>
                  <span class="city d-block mb-3">Tamale, Ghana</span>
                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3"><span class="icon-bed me-2"></span><span class="caption">2 beds</span></span>
                    <span class="d-block d-flex align-items-center"><span class="icon-bath me-2"></span><span class="caption">2 baths</span></span>
                  </div>
                  <a href="property-single.php?id=3" class="btn btn-primary py-2 px-3">See details</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row g-4">
          <div class="col-12 col-lg-3" data-aos="fade-up">
            <div class="box-feature">
              <span class="flaticon-house"></span>
              <h3 class="mb-3">Our Properties</h3>
              <p>
                EstateConnect curates listings that are verified against Ghana Lands Commission records and other trusted sources. Each property is screened for ownership credibility and clear documentation so buyers can trust what they see.
              </p>
              <p><a href="services.php" class="learn-more">Learn More</a></p>
            </div>
          </div>

          <div class="col-12 col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="box-feature">
              <span class="flaticon-building"></span>
              <h3 class="mb-3">Property for Sale</h3>
              <p>
                Discover vetted properties across Ghana with transparent pricing and clear title information. Our process simplifies buying by surfacing reliable documentation and step-by-step guidance.
              </p>
              <p><a href="services.php" class="learn-more">Learn More</a></p>
            </div>
          </div>

          <div class="col-12 col-lg-3" data-aos="fade-up" data-aos-delay="200">
            <div class="box-feature">
              <span class="flaticon-house-3"></span>
              <h3 class="mb-3">Real Estate Agent</h3>
              <p>
                Our agents are background-checked and verified partners who facilitate smooth, transparent transactions. They help coordinate inspections, documentation, and secure payment flows for a frictionless experience.
              </p>
              <p><a href="services.php" class="learn-more">Learn More</a></p>
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
              Hear from Our Satisfied Customers:
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
                <img src="images/male_silhouette.png" alt="Kofi Mensah" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">Kofi Mensah</h3>
                <blockquote>
                  <p>
                    "EstateConnect made buying my home straightforward. The ownership verification gave me confidence to proceed. The agent support was responsive and professional."
                  </p>
                </blockquote>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img src="images/female_silhouette.png" alt="Nana Ama" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">Nana Ama</h3>
                <blockquote>
                  <p>
                    "I completed my purchase faster than expected thanks to clear documentation. Their verification process eliminated fraud concerns. Highly recommended for anyone buying property in Ghana."
                  </p>
                </blockquote>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img src="images/male_silhouette.png" alt="Kojo Asante" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">Kojo Asante</h3>
                <blockquote>
                  <p>
                    "Listing my property was easy and secure. The platform's verification increased buyer trust. The payment process felt safe and reliable."
                  </p>
                </blockquote>
              </div>
            </div>

            <div class="item">
              <div class="testimonial">
                <img src="images/female_silhouette.png" alt="Customer - Maame Yaa Abena" class="img-fluid rounded-circle w-25 mb-4" />
                <div class="rate">
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                  <span class="icon-star text-warning"></span>
                </div>
                <h3 class="h5 text-primary mb-4">Maame Yaa Abena</h3>
                <blockquote>
                  <p>
                    "Great experience from viewing to closing. The team walked me through title checks and next steps. I felt protected every step of the way."
                  </p>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-4 bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-5">
            <h2 class="font-weight-bold heading text-primary mb-4">
              Let's find home that's perfect for you
            </h2>
            <p class="text-black-50">
              EstateConnect connects verified listings with trusted agents to make finding and purchasing a home straightforward. Our verification-first approach and local partnerships ensure a secure, transparent experience for buyers across Ghana.
            </p>
          </div>
        </div>
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
                <h3 class="heading"> 550K+ Properties</h3>
                <p class="text-black-50">
                  A growing nationwide inventory of vetted listings—curated to surface quality homes with clear documentation and verified ownership records.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-person"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Top Rated Agents</h3>
                <p class="text-black-50">
                  Our agent network is selected for professionalism and proven track records; they use EstateConnect tools to guide buyers through inspections, documentation, and closing.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-security"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Legit Properties</h3>
                <p class="text-black-50">
                  We partner directly with the Ghana Lands Commission to verify ownership and reduce fraud—so every listing marked as verified has credible title information and supporting documentation.
                </p>
              </div>
            </div>
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
                ><span class="countup text-primary">3298</span></span
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
                ><span class="countup text-primary">2181</span></span
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
                ><span class="countup text-primary">9316</span></span
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
                ><span class="countup text-primary">7191</span></span
              >
              <span class="caption text-black-50"># of Agents</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="row justify-content-center footer-cta" data-aos="fade-up">
        <div class="col-lg-7 mx-auto text-center">
          <h2 class="mb-4">Be a part of our growing real state agents</h2>
            <p>
            <a
              href="agent_register.php"
              class="btn btn-primary text-white py-3 px-4"
              >Apply for Real Estate agent</a>
            <a href="#" id="upgradePremiumBtn" class="btn btn-warning text-dark py-3 px-4 ms-2">Upgrade To Premium (if you haven't)</a>
          </p>
        </div>
        <!-- /.col-lg-7 -->
      </div>
      <!-- /.row -->
    </div>

    <div class="section section-5 bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-6 mb-5">
            <h2 class="font-weight-bold heading text-primary mb-4">
              Our Agents
            </h2>
            <p class="text-black-50">
              EstateConnect partners with verified local agents to deliver secure, transparent property transactions across Ghana. Our platform integrates title verification and clear documentation so agents can confidently support buyers and sellers through every step.
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
            <div class="h-100 person">
              <img src="images/agent1.jpg" alt="James Doe" class="img-fluid" />

              <div class="person-contents">
                <h2 class="mb-0"><a href="#">Kojo Asante</a></h2>
                <span class="meta d-block mb-3">Real Estate Agent</span>
                <p>
                  EstateConnect's verification tools and clear title reports make it easy to advise clients with confidence. The streamlined process reduces delays and helps me close deals faster.
                </p>

                <ul class="social list-unstyled list-inline dark-hover">
                  <li class="list-inline-item">
                    <a href="https://x.com/_hatung_Imana" target="_blank" rel="noopener noreferrer"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.facebook.com/hatungimana.ericson/" target="_blank" rel="noopener noreferrer"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.linkedin.com/in/eric-hatungimana/" target="_blank" rel="noopener noreferrer"><span class="icon-linkedin"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.instagram.com/hatung.imana/" target="_blank" rel="noopener noreferrer"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
            <div class="h-100 person">
              <img src="images/agent2.jpeg" alt="Akua Boateng" class="img-fluid" />

              <div class="person-contents">
                <h2 class="mb-0"><a href="#">Akua Boateng</a></h2>
                <span class="meta d-block mb-3">Real Estate Agent</span>
                <p>
                  Working with EstateConnect has increased client trust—ownership checks and transparent listings remove uncertainty. Their agent tools and responsive support simplify coordination and closings.
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
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
            <div class="h-100 person">
              <img src="images/agent3.jpg" alt="Afua Ofori" class="img-fluid" />

              <div class="person-contents">
                <h2 class="mb-0"><a href="#">Afua Ofori</a></h2>
                <span class="meta d-block mb-3">Real Estate Agent</span>
                <p>
                  EstateConnect provides reliable documentation and responsive support, which simplifies negotiations and makes closings more predictable. I recommend it to agents who want secure, efficient transactions.
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
        <div class="row mt-5">
          <div class="col-12 text-center">
            <p>Copyright &copy; 2025. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- /.site-footer -->

    <!-- Duplicate preloader removed; preloader is disabled earlier in the file -->

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/localize.js"></script>
    <script>
      // Premium upgrade button handler
      (function(){
        const btn = document.getElementById('upgradePremiumBtn');
        if (!btn) return;
        btn.addEventListener('click', function(e){
          e.preventDefault();
          const msg = 'Please note that you will receive a Premium Seller ID that you will use for certain functions and you will have to pay a fee of GHS 500.\n\nProceed -- cancel';
          if (confirm(msg)) {
            // Redirect to the Paystack payment link
            window.location.href = 'https://paystack.shop/pay/ii0nysn-0k';
          }
        });
      })();
    </script>
  </body>
</html>


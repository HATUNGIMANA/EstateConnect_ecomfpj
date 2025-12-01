<?php
session_start();
// initialize cart if not present
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
$cart_count = 0;
foreach ($_SESSION['cart'] as $it) {
  $cart_count += isset($it['qty']) ? (int)$it['qty'] : 0;
}

// Try to load a property by id from the DB using the controller, fall back to sample data.
require_once __DIR__ . '/controllers/property_controller.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$property = null;
if ($id) {
  $property = @get_property_by_id($id);
}

// sample fallback data mapped by id — used when DB has no matching property
$samples = [
  1 => [
    'property_id' => 1,
    'title' => '21 Osu Oxford St.',
    'location' => 'Osu, Accra, Ghana',
    'price' => 1291000,
    'description' => "A secure, centrally located family home with verified title and clear ownership records. EstateConnect verifies ownership with the Lands Commission to reduce fraud and give buyers confidence.",
    'long_description' => "This property features practical living spaces, modern finishes, and verified title documentation. EstateConnect supports buyers through ownership checks and transaction guidance.",
    'seller_name' => 'Kwame Mensah',
    'images' => ['images/img_1.jpg','images/img_2.jpg','images/img_3.jpg']
  ],
  2 => [
    'property_id' => 2,
    'title' => '14 Kejetia Rd.',
    'location' => 'Kumasi, Ghana',
    'price' => 850000,
    'description' => "Well-maintained residence located close to markets and transport. Verified documentation helps buyers proceed quickly.",
    'long_description' => "The property is part of our quality portfolio — listings include ownership references and transaction support to help close deals faster.",
    'seller_name' => 'Akosua Adjei',
    'images' => ['images/img_2.jpg','images/img_5.jpg']
  ],
  3 => [
    'property_id' => 3,
    'title' => '7 Tamale Rd., Sakasaka',
    'location' => 'Tamale, Ghana',
    'price' => 420000,
    'description' => "Comfortable family home in a growing community. EstateConnect provides title checks and negotiation support.",
    'long_description' => "Great value property with clear records and support services for buyers and sellers — inspections and document verification included.",
    'seller_name' => 'Abena Owusu',
    'images' => ['images/img_3.jpg']
  ],
  4 => [
    'property_id' => 4,
    'title' => '44 Beach Rd., Dixcove',
    'location' => 'Takoradi, Ghana',
    'price' => 990000,
    'description' => "Seaside home with verified ownership and supportive transaction services.",
    'long_description' => "Perfect for buyers seeking coastal living backed by documentation and trusted agents on our platform.",
    'seller_name' => 'Kojo Asante',
    'images' => ['images/img_4.jpg']
  ],
  5 => [
    'property_id' => 5,
    'title' => '10 Cape Coast St.',
    'location' => 'Cape Coast, Ghana',
    'price' => 610000,
    'description' => "Charming residence near schools and amenities. Ownership verified by EstateConnect procedures.",
    'long_description' => "An excellent starter home backed by clear title references and a straightforward purchase process.",
    'seller_name' => 'Esi Boateng',
    'images' => ['images/img_5.jpg']
  ],
  6 => [
    'property_id' => 6,
    'title' => '8 Tema Comm. Rd.',
    'location' => 'Tema, Ghana',
    'price' => 720000,
    'description' => "Conveniently located property with strong transport links.",
    'long_description' => "EstateConnect ensures that critical ownership checks are performed before listings go live.",
    'seller_name' => 'Nana Kofi',
    'images' => ['images/img_6.jpg']
  ],
  7 => [
    'property_id' => 7,
    'title' => '12 Sunyani Rd.',
    'location' => 'Sunyani, Ghana',
    'price' => 330000,
    'description' => "Practical 2-bedroom property in a friendly neighborhood.",
    'long_description' => "Affordable listing with verification workflows to keep buyers safe.",
    'seller_name' => 'Yaw Mensah',
    'images' => ['images/img_7.jpg']
  ],
  8 => [
    'property_id' => 8,
    'title' => '6 Ho Rd.',
    'location' => 'Ho, Ghana',
    'price' => 455000,
    'description' => "Well situated family home with clear title references.",
    'long_description' => "EstateConnect verifies title and provides inspection listings to improve buyer confidence.",
    'seller_name' => 'Ama Serwaa',
    'images' => ['images/img_8.jpg']
  ],
  // Additional sample ids for properties.php entries (10..22)
  10 => [
    'property_id' => 10,
    'title' => '3 Labone Ave.',
    'location' => 'Labone, Accra, Ghana',
    'price' => 1500000,
    'description' => 'Premium townhouse with verified documents and premium support.',
    'long_description' => 'Suitable for buyers seeking premium listings backed by our verification services.',
    'seller_name' => 'EstateConnect Agent',
    'images' => ['images/img_9.jpg','images/img_1.jpg']
  ],
  11 => [
    'property_id' => 11,
    'title' => '5 Airport Rd.',
    'location' => 'Accra, Ghana',
    'price' => 980000,
    'description' => 'Urban apartment close to transport and services.',
    'long_description' => 'Verified listing with transaction support and agent assistance.',
    'seller_name' => 'Sally Agent',
    'images' => ['images/img_2.jpg']
  ],
  12 => [
    'property_id' => 12,
    'title' => '8 Cantonments Rd.',
    'location' => 'Cantonments, Accra, Ghana',
    'price' => 2000000,
    'description' => 'High-end property with full documentation.',
    'long_description' => 'Ideal for buyers looking for a secure investment with verified title.',
    'seller_name' => 'Premium Seller',
    'images' => ['images/img_3.jpg']
  ],
];

if (!$property && $id && isset($samples[$id])) {
  $property = $samples[$id];
}

// If still no property, show a simple not-found placeholder
if (!$property) {
  $property = [
    'property_id' => 0,
    'title' => 'Property Not Found',
    'location' => 'Unknown',
    'price' => 0,
    'description' => 'No details are available for this listing.',
    'long_description' => '',
    'seller_name' => 'EstateConnect',
    'images' => ['images/hero_bg_1.jpg']
  ];
}
// Determine a random display price for this render (10k..50k)
$display_price_value = rand(10000, 50000);
$display_price = 'GHS ' . number_format($display_price_value);
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
      EstateConnect &mdash; Property Details
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
              <li><a href="services.php">Services</a></li>
              <!-- About and Contact removed from navbar -->
              <li>
                <a href="cart.php">Cart<?php if($cart_count>0) echo ' (' . $cart_count . ')'; ?></a>
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
      style="background-image: url('images/hero_bg_3.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">
              <?php echo htmlspecialchars($property['title']); ?>
            </h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">
                  <a href="properties.php">Properties</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">
                  <?php echo htmlspecialchars($property['title']); ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-7">
            <div class="img-property-slide-wrap">
            <div class="img-property-slide">
              <?php foreach (($property['images'] ?? []) as $img): ?>
                <img src="<?php echo htmlspecialchars($img); ?>" alt="Image" class="img-fluid" />
              <?php endforeach; ?>
            </div>
            </div>
          </div>
          <div class="col-lg-4">
            <h2 class="heading text-primary"><?php echo htmlspecialchars($property['title']); ?></h2>
            <p class="meta"><?php echo htmlspecialchars($property['location']); ?></p>
            <p class="text-black-50"><?php echo htmlspecialchars($property['description']); ?></p>
            <?php if (!empty($property['long_description'])): ?>
              <p class="text-black-50"><?php echo htmlspecialchars($property['long_description']); ?></p>
            <?php endif; ?>

            <!-- Simple product area with Add to Cart -->
            <div class="mb-4">
              <form method="post" action="actions/add_to_cart.php">
                <input type="hidden" name="id" value="<?php echo (int)$property['property_id']; ?>" />
                <input type="hidden" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" />
                <input type="hidden" name="price" value="<?php echo (int)($display_price_value); ?>" />
                <div class="d-flex align-items-center">
                  <button type="submit" class="btn btn-primary me-2">Add to Cart</button>
                  <a href="cart.php" class="btn btn-outline-secondary">View Cart</a>
                </div>
              </form>
            </div>

            <div class="d-block agent-box p-5">
              <div class="img mb-4">
                <img src="images/agent2.jpeg" alt="<?php echo htmlspecialchars($property['seller_name']); ?>" class="img-fluid" />
              </div>
              <div class="text">
                <h3 class="mb-0"><?php echo htmlspecialchars($property['seller_name']); ?></h3>
                <div class="meta mb-3">Real Estate Agent</div>
                <p>
                  <?php echo htmlspecialchars($property['seller_name']); ?> is a trusted partner on EstateConnect. Our platform verifies ownership documents and provides transaction support to help sellers close reliably and buyers purchase with confidence.
                </p>
                <ul class="list-unstyled social dark-hover d-flex">
                  <li class="me-1">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-linkedin"></span></a>
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

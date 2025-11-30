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

    <link rel="stylesheet" href="../fonts/icomoon/style.css" />
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="../css/tiny-slider.css" />
    <link rel="stylesheet" href="../css/aos.css" />
    <link rel="stylesheet" href="../css/style.css" />

    <title>Add Property &mdash; EstateConnect</title>
    <style>
      /* Page-specific spacing so fixed/absolute navbar doesn't overlap page content
         Keeps global stylesheet unchanged; small padding to push content below nav */
      .site-section { padding-top: 110px; }
      @media (max-width: 991px) {
        .site-section { padding-top: 90px; }
      }
      @media (max-width: 575px) {
        .site-section { padding-top: 70px; }
      }
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

            <ul
              class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end"
            >
              <li><a href="../index.php">Home</a></li>
              <li class="has-children">
                <a href="../properties.php">Properties</a>
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
              <li><a href="../services.php">Services</a></li>
              <li><a href="../about.php">About</a></li>
              <li><a href="../contact.php">Contact Us</a></li>
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

    <div class="site-section">
      <div class="container">
        <div class="row mb-4">
          <div class="col-12">
            <!-- heading removed per request; description paragraph removed to match request -->
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 mx-auto">
            <form id="addPropertyForm" class="bg-light p-4 shadow-sm" novalidate>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="title">Property Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Modern 3BR apartment" required>
                </div>
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="type">Property Type</label>
                  <select id="type" name="type" class="form-control" required>
                    <option value="">Choose...</option>
                    <option>Apartment</option>
                    <option>House</option>
                    <option>Studio</option>
                    <option>Commercial</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="price">Price (GHS)</label>
                  <input type="number" class="form-control" id="price" name="price" min="0" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="location">Location</label>
                  <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group col-md-2">
                  <label for="beds">Beds</label>
                  <input type="number" class="form-control" id="beds" name="beds" min="0">
                </div>
                <div class="form-group col-md-2">
                  <label for="baths">Baths</label>
                  <input type="number" class="form-control" id="baths" name="baths" min="0">
                </div>
                <div class="form-group col-md-2">
                  <label for="area">Area (sq ft)</label>
                  <input type="number" class="form-control" id="area" name="area" min="0">
                </div>
              </div>

              <div class="form-group">
                <label for="amenities">Amenities (comma separated)</label>
                <input type="text" class="form-control" id="amenities" name="amenities" placeholder="Pool, Parking, Wifi">
              </div>

              <div class="form-group">
                <label for="availability">Availability</label>
                <select id="availability" name="availability" class="form-control">
                  <option>Available</option>
                  <option>Unavailable</option>
                </select>
              </div>

              <div class="form-group">
                <label for="images">Upload Images</label>
                <input type="file" class="form-control-file" id="images" name="images" accept="image/*" multiple>
                <small class="form-text text-muted">You can upload multiple images. Previews appear below.</small>
                <div id="imagePreview" class="mt-3 d-flex flex-wrap"></div>
              </div>

              <div class="form-group text-end">
                <button type="submit" class="btn btn-primary">Add Property</button>
                <a href="../properties.php" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
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

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/tiny-slider.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/navbar.js"></script>
    <script src="../js/counter.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/localize.js"></script>

    <script>
      // Basic client-side validation and image preview
      (function(){
        const form = document.getElementById('addPropertyForm');
        const imagesInput = document.getElementById('images');
        const preview = document.getElementById('imagePreview');

        imagesInput.addEventListener('change', function(){
          preview.innerHTML = '';
          Array.from(this.files).forEach(file => {
            if(!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = function(e){
              const img = document.createElement('img');
              img.src = e.target.result;
              img.className = 'me-2 mb-2';
              img.style.width = '120px';
              img.style.height = '80px';
              img.style.objectFit = 'cover';
              preview.appendChild(img);
            };
            reader.readAsDataURL(file);
          });
        });

        form.addEventListener('submit', function(e){
          if(!form.checkValidity()){
            e.preventDefault();
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
          }
          e.preventDefault();
          // Demo behaviour: show toast or alert; in production replace with real POST
          alert('Property submitted (demo). In production this would be sent to the server.');
          form.reset();
          preview.innerHTML = '';
          form.classList.remove('was-validated');
        }, false);
      })();
    </script>
  </body>
</html>

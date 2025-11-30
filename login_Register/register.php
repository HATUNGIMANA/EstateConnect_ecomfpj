<?php
// login/register.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
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

        <title>Register &mdash; EstateConnect</title>

        <style>
            .btn-custom{background:#198754;border-color:#198754;color:#fff}
            .btn-custom:hover{background:#146c43;border-color:#146c43}
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
                            <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                                <li class="nav-item"><a href="login_Register/profile.php">Hello, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?></a></li>
                                <li class="cta-button"><a href="login_Register/logout.php" class="btn btn-outline-danger">Logout</a></li>
                                <li class="cta-button"><a href="login_Register/profile_edit.php" class="btn btn-success">Edit Profile</a></li>
                            <?php else: ?>
                                <li class="cta-button"><a href="login.php" class="btn btn-success">Login</a></li>
                                <li class="cta-button"><a href="register.php" class="btn btn-outline-success">Register</a></li>
                            <?php endif; ?>
                        </ul>

                        <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"><span></span></a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="site-section">
            <div class="container">
                <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6">
                                <div class="card" data-aos="fade-up" data-aos-delay="100">
                                        <div class="card-header text-center">
                                                <h4><i class="fas fa-user-plus me-2"></i>Customer Registration</h4>
                                        </div>
                                        <div class="card-body">
                        <!-- Note: form has not any action; submission handled by JS -->
                        <form id="register-form" class="mt-4" novalidate>
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Full Name <i class="fa fa-user"></i></label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter your full name" required maxlength="100">
                            </div>

                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Email <i class="fa fa-envelope"></i></label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Enter your email address" required maxlength="100">
                                <div id="email-help" class="form-text"></div>
                            </div>

                            <div class="mb-3">
                                <label for="customer_pass" class="form-label">Password <i class="fa fa-lock"></i></label>
                                <input type="password" class="form-control" id="customer_pass" name="customer_pass" placeholder="Enter your password" required minlength="8">
                            </div>

                            <div class="mb-3">
                                <label for="customer_pass_confirm" class="form-label">Confirm Password <i class="fa fa-lock"></i></label>
                                <input type="password" class="form-control" id="customer_pass_confirm" name="customer_pass_confirm" placeholder="Confirm your password" required>
                            </div>

                            <div class="mb-3">
                                <label for="customer_country" class="form-label">Country <i class="fa fa-globe"></i></label>
                                <select class="form-control form-select" id="customer_country" name="customer_country" required>
                                    <option value="">Select your country</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Eswatini">Eswatini</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Kosovo">Kosovo</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia">Micronesia</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="North Korea">North Korea</option>
                                    <option value="North Macedonia">North Macedonia</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestine">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="South Sudan">South Sudan</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syria">Syria</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican City">Vatican City</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="customer_city" class="form-label">City <i class="fa fa-map-marker-alt"></i></label>
                                <input type="text" class="form-control" id="customer_city" name="customer_city" placeholder="Enter your city" required maxlength="50">
                            </div>

                            <div class="mb-3">
                                <label for="customer_contact" class="form-label">Phone Number <i class="fa fa-phone"></i></label>
                                <input type="tel" class="form-control" id="customer_contact" name="customer_contact" placeholder="Enter your phone number" required maxlength="15" pattern="[0-9]{7,15}">
                            </div>

                            <!-- Removed 'Register As' radio group per request -->

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-custom btn-lg" id="register-submit-btn">
                                    <i class="fas fa-user-plus me-2"></i>Register
                                </button>
                                <div id="register-loading" class="text-center mt-2" style="display:none;">
                                    <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div> Registering...
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-center">
                        Already have an account? <a href="login.php" class="highlight">Login here</a>.
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

    <!-- Inline JS to handle registration -->
    <script>
    (function(){
        const form = document.getElementById('register-form');
        const submitBtn = document.getElementById('register-submit-btn');
        const loading = document.getElementById('register-loading');
        const emailHelp = document.getElementById('email-help');

        // Helper validators
        const validators = {
            name: v => v && v.trim().length >= 2 && v.trim().length <= 100,
            email: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) && v.length <= 100,
            password: v => v && v.length >= 8,
            country: v => v && v.trim().length > 0 && v.length <= 50,
            city: v => v && v.trim().length > 0 && v.length <= 50,
            contact: v => /^\+?\d{7,15}$/.test(v)

        };

        // Optional: live email availability check
        const emailInput = document.getElementById('customer_email');
        let emailTimer = null;
        emailInput && emailInput.addEventListener('input', function(){
            clearTimeout(emailTimer);
            const val = this.value.trim();
            emailHelp.textContent = '';
            if (!validators.email(val)) return;
            emailHelp.textContent = 'Checking...';
            emailTimer = setTimeout(()=> {
                // POST to check endpoint (ensure this file exists)
                fetch('../actions/check_email_action.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'email=' + encodeURIComponent(val)
                }).then(r => r.json())
                  .then(j => {
                      emailHelp.textContent = j.available ? 'Email available' : 'Email already taken';
                  }).catch(()=> { emailHelp.textContent = ''; });
            }, 500);
        });

        form.addEventListener('submit', async function(e){
            e.preventDefault();

            // collect fields
            const fd = new FormData(form);
            const data = Object.fromEntries(fd.entries());

            // client-side validations
            if (!validators.name(data.customer_name)) return Swal.fire('Invalid name','Full name must be between 2 and 100 characters','warning');
            if (!validators.email(data.customer_email)) return Swal.fire('Invalid email','Please enter a valid email','warning');
            if (!validators.password(data.customer_pass)) return Swal.fire('Weak password','Password must be at least 8 characters','warning');
            if (data.customer_pass !== data.customer_pass_confirm) return Swal.fire('Password mismatch','Passwords do not match','warning');
            if (!validators.country(data.customer_country)) return Swal.fire('Invalid country','Please select a country','warning');
            if (!validators.city(data.customer_city)) return Swal.fire('Invalid city','Please enter a city (max 50 chars)','warning');
            if (!validators.contact(data.customer_contact)) return Swal.fire('Invalid contact','Contact number must be 7-10 digits only','warning');

            // prepare for submit
            submitBtn.disabled = true;
            loading.style.display = 'block';

            try {
                // Post to action. Ensure this path is correct in your project.
                const res = await fetch('../actions/register_action.php', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: fd
                });

                if (!res.ok) {
                    throw new Error('Server returned ' + res.status);
                }

                const json = await res.json();

                if (json.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registered',
                        text: json.message || 'Registration successful. Redirecting to login...',
                        timer: 1800,
                        showConfirmButton: false
                    });
                    setTimeout(()=> {
                        window.location.href = 'login.php';
                    }, 1600);
                } else {
                    // show message from server
                    Swal.fire('Registration failed', json.message || 'Please try again', 'error');
                }
            } catch (err) {
                console.error(err);
                Swal.fire('Error', 'Network or server error. Check console for details.', 'error');
            } finally {
                submitBtn.disabled = false;
                loading.style.display = 'none';
            }
        });
    })();
    </script>
</body>
</html>

<?php
session_start();
// Show a simple agent registration form. Submits to actions/submit_agent_request.php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agent Registration - EstateConnect</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="site-nav">
    <div class="container">
      <div class="menu-bg-wrap">
        <div class="site-navigation">
          <a href="index.php" class="logo m-0 float-start">EstateConnect</a>
          <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
            <li><a href="index.php">Home</a></li>
            <li><a href="properties.php">Properties</a></li>
            <li><a href="services.php">Services</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2>Apply to be an Agent</h2>
    <p>Please complete the form. Our team will verify your documents and reach out.</p>

    <?php if (!empty($_SESSION['agent_request_errors'])): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($_SESSION['agent_request_errors'] as $err): ?>
            <li><?php echo htmlspecialchars($err); ?></li>
          <?php endforeach; unset($_SESSION['agent_request_errors']); ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['agent_request_success'])): ?>
      <div class="alert alert-success">
        <?php echo htmlspecialchars($_SESSION['agent_request_success']); unset($_SESSION['agent_request_success']); ?>
      </div>
    <?php endif; ?>

    <form action="actions/submit_agent_request.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email">Email (optional)</label>
        <input type="email" id="email" name="email" class="form-control">
      </div>
      <div class="mb-3">
        <label for="phone">Phone (optional)</label>
        <input type="text" id="phone" name="phone" class="form-control">
      </div>

      <div class="mb-3">
        <label for="id_upload">Upload ID (photo/scan)</label>
        <input type="file" id="id_upload" name="id_upload" accept="image/*,.pdf" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="licence_upload">Upload Ghana Lands Commission ID / Licence</label>
        <input type="file" id="licence_upload" name="licence_upload" accept="image/*,.pdf" class="form-control" required>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit Application</button>
      </div>
    </form>
  </div>

</body>
</html>
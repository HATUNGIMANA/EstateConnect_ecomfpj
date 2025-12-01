<?php
// admin/admin_dashboard.php
// Minimal admin dashboard listing pending verifications and basic stats.
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: ../login_Register/login.php');
    exit;
}

require_once __DIR__ . '/../settings/connection.php';

// Count stats (wrap in try/catch so missing DB/tables produce a helpful message)
try {
  $totUsers = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
  $totListings = $pdo->query('SELECT COUNT(*) FROM properties')->fetchColumn();
  $pending = $pdo->query('SELECT * FROM users WHERE role_id = 3 AND is_verified = 0')->fetchAll();
} catch (PDOException $e) {
  // Show friendly error with next steps
  http_response_code(500);
  echo '<!doctype html><html><head><meta charset="utf-8"><title>Admin Dashboard - Error</title></head><body style="font-family:Arial,Helvetica,sans-serif;padding:24px;">';
  echo '<h1>Database Error</h1>';
  echo '<p>The admin dashboard cannot load because the expected database or tables are missing.</p>';
  echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
  echo '<p>Please import the SQL schema: <code>db/db_fin_project.sql</code> into your MySQL server, or ensure `settings/db_cred.php` points to the correct database.</p>';
  echo '<p><a href="../index.php">Back to site</a></p>';
  echo '</body></html>';
  exit;
}
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - EstateConnect</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../fonts/icomoon/style.css">
  <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="../css/tiny-slider.css">
  <link rel="stylesheet" href="../css/aos.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    .admin-stats { margin-bottom: 20px; }
    .admin-panel { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .table-responsive { margin-top: 12px; }
  </style>
</head>
<body>

  <nav class="site-nav">
    <div class="container">
      <div class="menu-bg-wrap">
        <div class="site-navigation">
          <a href="../index.php" class="logo m-0 float-start">EstateConnect</a>
          <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../properties.php">Properties</a></li>
            <li><a href="../services.php">Services</a></li>
            <li><a href="../index.php">Back to site</a></li>
          </ul>
          <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"><span></span></a>
        </div>
      </div>
    </div>
  </nav>

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-12 mb-4">
          <div class="admin-stats admin-panel d-flex justify-content-between align-items-center">
            <div>
              <h2 class="mb-0">Admin Dashboard</h2>
              <p class="mb-0 text-muted">Manage users, verifications and listings</p>
            </div>
            <div class="text-end">
              <div><strong>Users:</strong> <?php echo intval($totUsers); ?></div>
              <div><strong>Listings:</strong> <?php echo intval($totListings); ?></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="admin-panel">
            <h4>Pending Seller Verifications</h4>
            <?php if (empty($pending)): ?>
              <p>No pending verifications.</p>
            <?php else: ?>
              <div class="table-responsive">
              <table class="table table-striped">
                <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr></thead>
                <tbody>
                <?php foreach ($pending as $u): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($u['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($u['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['phone_number']); ?></td>
                    <td>
                      <form method="post" action="../actions/verify_seller.php" onsubmit="return confirm('Approve seller?');">
                        <input type="hidden" name="seller_id" value="<?php echo intval($u['user_id']); ?>">
                        <button class="btn btn-sm btn-success" type="submit">Approve</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="admin-panel">
            <h4>All Users</h4>
            <?php
              // Fetch all users for display
              $allUsers = [];
              try {
                $stmt = $pdo->query('SELECT user_id, full_name, email, phone_number, role_id, is_verified, created_at FROM users ORDER BY created_at DESC');
                $allUsers = $stmt->fetchAll();
              } catch (PDOException $e) {
                echo '<div class="alert alert-warning">Could not load all users: ' . htmlspecialchars($e->getMessage()) . '</div>';
              }
            ?>
            <div class="table-responsive">
            <table class="table table-sm table-hover">
              <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Verified</th><th>Joined</th></tr></thead>
              <tbody>
              <?php if (empty($allUsers)): ?>
                <tr><td colspan="6">No users found.</td></tr>
              <?php else: ?>
                <?php foreach ($allUsers as $u): ?>
                  <tr>
                    <td><?php echo intval($u['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($u['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo ($u['role_id']==1)?'Admin':(($u['role_id']==3)?'Seller':'Buyer'); ?></td>
                    <td><?php echo $u['is_verified'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo htmlspecialchars($u['created_at']); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <footer class="site-footer mt-5">
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center">
          <p>Copyright &copy; 2025 EstateConnect. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/tiny-slider.js"></script>
  <script src="../js/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>

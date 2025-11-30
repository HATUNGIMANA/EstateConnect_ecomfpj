<?php
// admin/index.php
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
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container py-5">
    <h1>Admin Dashboard</h1>
    <p>Users: <?php echo intval($totUsers); ?> | Listings: <?php echo intval($totListings); ?></p>

    <h2>Pending Seller Verifications</h2>
    <?php if (empty($pending)): ?>
      <p>No pending verifications.</p>
    <?php else: ?>
      <table class="table">
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
    <?php endif; ?>

    <p><a href="../index.php">Back to site</a></p>
  </div>
</body>
</html>

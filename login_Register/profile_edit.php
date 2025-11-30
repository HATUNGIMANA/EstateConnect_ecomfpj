<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$user = $_SESSION['user'] ?? null;
if (!$user) {
    header('Location: login.php');
    exit;
}

// Basic profile edit form (server-side update not implemented here).
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Profile - EstateConnect</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h2>Edit Profile</h2>
    <form method="post" action="../actions/update_profile_action.php">
      <div class="mb-3"><label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>">
      </div>
      <div class="mb-3"><label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
      </div>
      <div class="mb-3">
        <button class="btn btn-success" type="submit">Save Changes</button>
        <a href="profile.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>

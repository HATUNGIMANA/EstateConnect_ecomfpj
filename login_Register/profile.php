<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// Simple profile viewer. Allows user to see name/email and a link to edit or logout.
$user = $_SESSION['user'] ?? null;
if (!$user) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>My Profile - EstateConnect</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
    <p><strong>Verified:</strong> <?php echo $user['is_verified'] ? 'Yes' : 'No'; ?></p>
    <p>
      <a href="profile_edit.php" class="btn btn-primary">Edit Profile</a>
      <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </p>
  </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

$data_file = __DIR__ . '/../data/admin.json';
$creds     = json_decode(file_get_contents($data_file), true);
$success   = '';
$error     = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['current_password'] !== $creds['password']) {
    $error = 'Current password is incorrect.';
  } elseif ($_POST['new_password'] !== $_POST['confirm_password']) {
    $error = 'New passwords do not match.';
  } elseif (strlen($_POST['new_password']) < 6) {
    $error = 'New password must be at least 6 characters.';
  } else {
    $creds['username'] = trim($_POST['username']);
    $creds['password'] = $_POST['new_password'];
    file_put_contents($data_file, json_encode($creds, JSON_PRETTY_PRINT));
    $success = 'Credentials updated successfully.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Settings — Tradiant Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="sidebar-logo">TRADIANT<span>.</span></div>
    <nav class="sidebar-nav">
      <a href="dashboard.php">📊 Dashboard</a>
      <a href="messages.php">✉️ Messages</a>
      <a href="services.php">🔧 Services</a>
      <a href="clients.php">👥 Clients</a>
      <a href="settings.php" class="active">⚙️ Settings</a>
      <a href="logout.php">🚪 Logout</a>
    </nav>
  </aside>
  <main class="admin-main">
    <div class="admin-header">
      <h1>Settings</h1>
    </div>

    <div style="max-width:500px;">
      <?php if ($success): ?>
      <div style="background:rgba(74,222,128,0.1);border:1px solid rgba(74,222,128,0.3);border-radius:8px;padding:12px 16px;font-size:13px;color:#4ade80;margin-bottom:24px;">
        ✅ <?= htmlspecialchars($success) ?>
      </div>
      <?php endif; ?>
      <?php if ($error): ?>
      <div style="background:rgba(248,113,113,0.1);border:1px solid rgba(248,113,113,0.3);border-radius:8px;padding:12px 16px;font-size:13px;color:#f87171;margin-bottom:24px;">
        ⚠️ <?= htmlspecialchars($error) ?>
      </div>
      <?php endif; ?>

      <div class="card" style="padding:32px;">
        <h3 style="font-family:var(--font-display);font-size:20px;letter-spacing:2px;margin-bottom:24px;">CHANGE CREDENTIALS</h3>
        <form method="POST">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($creds['username']) ?>" required>
          </div>
          <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="current_password" placeholder="Enter current password" required>
          </div>
          <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_password" placeholder="Min. 6 characters" required>
          </div>
          <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="confirm_password" placeholder="Repeat new password" required>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:8px;">
            Update Credentials
          </button>
        </form>
      </div>

      <div class="card" style="padding:28px;margin-top:20px;">
        <h3 style="font-family:var(--font-display);font-size:18px;letter-spacing:2px;margin-bottom:16px;">QUICK LINKS</h3>
        <div style="display:flex;flex-direction:column;gap:10px;">
          <a href="../index.php" target="_blank" class="btn btn-outline" style="justify-content:space-between;">Home Page <span>↗</span></a>
          <a href="../pages/services.php" target="_blank" class="btn btn-outline" style="justify-content:space-between;">Services Page <span>↗</span></a>
          <a href="../pages/contact.php" target="_blank" class="btn btn-outline" style="justify-content:space-between;">Contact Page <span>↗</span></a>
        </div>
      </div>
    </div>
  </main>
</div>
</body>
</html>

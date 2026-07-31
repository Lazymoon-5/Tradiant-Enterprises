<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}

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
    $success = 'Admin credentials updated successfully.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Settings — Tradiant Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-layout">
  <!-- SIDEBAR -->
  <aside class="admin-sidebar">
    <div class="sidebar-logo">
      <img src="../assets/images/logo.png" alt="Tradiant" onerror="this.style.display='none'">
      <div>TRADIANT<span>.</span></div>
    </div>
    <nav class="sidebar-nav">
      <a href="dashboard.php">📊 Dashboard</a>
      <a href="messages.php">✉️ Messages</a>
      <a href="services.php">🔧 Services</a>
      <a href="clients.php">👥 Clients</a>
      <a href="settings.php" class="active">⚙️ Settings</a>
      <a href="logout.php" style="margin-top:auto; color: #f87171;">🚪 Logout</a>
    </nav>
    <div class="sidebar-user">
      <div class="user-avatar">A</div>
      <div class="user-info">
        <span class="user-name">Administrator</span>
        <span class="user-role">Super Admin</span>
      </div>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="admin-main">
    <div class="admin-header">
      <div>
        <h1>⚙️ Account Settings</h1>
        <p style="font-size: 13px; color: var(--admin-text-muted); margin-top: 4px;">Update administrator credentials and access configuration.</p>
      </div>
    </div>

    <div style="max-width: 580px;">
      <?php if ($success): ?>
        <div style="background: rgba(34, 197, 94, 0.12); border: 1px solid rgba(34, 197, 94, 0.35); border-radius: 12px; padding: 14px 16px; font-size: 13px; color: #4ade80; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
          ✅ <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <?php if ($error): ?>
        <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.35); border-radius: 12px; padding: 14px 16px; font-size: 13px; color: #f87171; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
          ⚠️ <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <div class="admin-card">
        <div class="admin-card-header">
          <div class="admin-card-title">UPDATE CREDENTIALS</div>
        </div>
        <form method="POST">
          <div class="admin-form-group">
            <label>Username</label>
            <input type="text" name="username" class="admin-input" value="<?= htmlspecialchars($creds['username']) ?>" required>
          </div>
          <div class="admin-form-group">
            <label>Current Password</label>
            <input type="password" name="current_password" class="admin-input" placeholder="Enter current password" required>
          </div>
          <div class="admin-form-group">
            <label>New Password</label>
            <input type="password" name="new_password" class="admin-input" placeholder="Min 6 characters" required>
          </div>
          <div class="admin-form-group">
            <label>Confirm New Password</label>
            <input type="password" name="confirm_password" class="admin-input" placeholder="Confirm new password" required>
          </div>
          <button type="submit" class="btn-admin-submit" style="margin-top: 16px;">
            Save Credentials →
          </button>
        </form>
      </div>

      <div class="admin-card">
        <div class="admin-card-header">
          <div class="admin-card-title">WEBSITE QUICK LINKS</div>
        </div>
        <div style="display: flex; flex-direction: column; gap: 10px;">
          <a href="../index.php" target="_blank" class="act-btn act-btn-edit" style="justify-content: space-between; padding: 12px 16px; font-size: 13px; text-decoration: none;">
            <span>🏠 Home Landing Page</span> <span>↗</span>
          </a>
          <a href="../pages/services.php" target="_blank" class="act-btn act-btn-edit" style="justify-content: space-between; padding: 12px 16px; font-size: 13px; text-decoration: none;">
            <span>🔧 Public Services Page</span> <span>↗</span>
          </a>
          <a href="../pages/contact.php" target="_blank" class="act-btn act-btn-edit" style="justify-content: space-between; padding: 12px 16px; font-size: 13px; text-decoration: none;">
            <span>✉️ Public Contact Page</span> <span>↗</span>
          </a>
        </div>
      </div>
    </div>
  </main>
</div>
</body>
</html>

<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
  header('Location: dashboard.php');
  exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $creds = json_decode(file_get_contents(__DIR__ . '/../data/admin.json'), true);
  if ($_POST['username'] === $creds['username'] && $_POST['password'] === $creds['password']) {
    $_SESSION['admin_logged_in'] = true;
    header('Location: dashboard.php');
    exit;
  } else {
    $error = 'Invalid username or password.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Login — Tradiant Enterprises</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-login">
  <div class="login-box">
    <div style="display:flex; justify-content:center; margin-bottom:12px;">
      <img src="../assets/images/logo.png" alt="Tradiant Enterprises" style="height:54px; width:auto;">
    </div>
    <div class="login-logo">Tradiant Enterprises</div>
    <p class="login-sub">Master Admin Panel</p>
    <?php if ($error): ?>
    <div style="background:rgba(248,113,113,0.1);border:1px solid rgba(248,113,113,0.3);border-radius:7px;padding:10px 14px;font-size:13px;color:#f87171;margin-bottom:20px;">
      <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="admin" required autofocus>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:8px;">
        Login →
      </button>
    </form>
    <p style="text-align:center;margin-top:20px;font-size:12px;color:var(--gray-dim);">
      <a href="../index.php" style="color:var(--orange);">← Back to Website</a>
    </p>
  </div>
</div>
</body>
</html>

<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
  header('Location: dashboard.php');
  exit;
}

$lock_file = __DIR__ . '/../data/login_locks.json';
$lock_data = file_exists($lock_file) ? (json_decode(file_get_contents($lock_file), true) ?? []) : [];

$attempts      = $lock_data['attempts'] ?? 0;
$lockout_until = $lock_data['lockout_until'] ?? 0;
$now           = time();

// Check if lockout has expired
if ($lockout_until > 0 && $now >= $lockout_until) {
  $attempts = 0;
  $lockout_until = 0;
  $lock_data = ['attempts' => 0, 'last_attempt_time' => $now, 'lockout_until' => 0];
  file_put_contents($lock_file, json_encode($lock_data, JSON_PRETTY_PRINT));
}

$is_locked = ($lockout_until > 0 && $now < $lockout_until);
$time_remaining_str = '';
if ($is_locked) {
  $diff = $lockout_until - $now;
  $hours = floor($diff / 3600);
  $mins  = ceil(($diff % 3600) / 60);
  if ($hours > 0) {
    $time_remaining_str = "{$hours}h {$mins}m";
  } else {
    $time_remaining_str = "{$mins} minute(s)";
  }
}

$error = '';
$warning = '';

if ($is_locked) {
  $error = "🔒 Login locked due to 5 failed attempts. Please try again in <strong>{$time_remaining_str}</strong>.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($is_locked) {
    $error = "🔒 Login locked due to 5 failed attempts. Please try again in <strong>{$time_remaining_str}</strong>.";
  } else {
    $creds = json_decode(file_get_contents(__DIR__ . '/../data/admin.json'), true);
    $input_user = trim($_POST['username'] ?? '');
    $input_pass = $_POST['password'] ?? '';

    if ($input_user === $creds['username'] && $input_pass === $creds['password']) {
      // Reset lock data on success
      $lock_data = ['attempts' => 0, 'last_attempt_time' => $now, 'lockout_until' => 0];
      file_put_contents($lock_file, json_encode($lock_data, JSON_PRETTY_PRINT));
      
      $_SESSION['admin_logged_in'] = true;
      header('Location: dashboard.php');
      exit;
    } else {
      $attempts++;
      if ($attempts >= 5) {
        $lockout_until = $now + (2 * 3600); // 2 hours lock
        $is_locked = true;
        $lock_data = [
          'attempts' => $attempts,
          'last_attempt_time' => $now,
          'lockout_until' => $lockout_until
        ];
        file_put_contents($lock_file, json_encode($lock_data, JSON_PRETTY_PRINT));
        $error = "🔒 Account locked due to 5 failed attempts. Please try again in <strong>2 hours</strong>.";
      } else {
        $lock_data = [
          'attempts' => $attempts,
          'last_attempt_time' => $now,
          'lockout_until' => 0
        ];
        file_put_contents($lock_file, json_encode($lock_data, JSON_PRETTY_PRINT));
        $remaining = 5 - $attempts;
        $warning = "Invalid username or password. <strong>{$remaining} attempt(s) remaining</strong> before 2-hour lock.";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login — Tradiant Enterprises</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="admin-login-body">

<div class="login-card">
  <div class="login-header">
    <img src="../assets/images/logo.png" alt="Tradiant Enterprises" class="login-logo-img" onerror="this.style.display='none'">
    <div class="login-title">Tradiant Enterprises</div>
    <div class="login-subtitle">Master Administration Control Panel</div>
    <div class="security-badge">
      <span>🛡️</span> 5 Attempts Max • 2h Auto-Lock
    </div>
  </div>

  <?php if ($error): ?>
    <div class="lockout-alert">
      <span>⚠️</span>
      <div><?= $error ?></div>
    </div>
  <?php endif; ?>

  <?php if ($warning && !$error): ?>
    <div class="warning-alert">
      <span>🚨</span>
      <div><?= $warning ?></div>
    </div>
  <?php endif; ?>

  <form method="POST" autocomplete="off">
    <div class="admin-form-group">
      <label for="username">Username</label>
      <div class="admin-input-wrapper">
        <input type="text" id="username" name="username" class="admin-input" placeholder="Enter admin username" required autofocus <?= $is_locked ? 'disabled' : '' ?>>
      </div>
    </div>

    <div class="admin-form-group">
      <label for="password">Password</label>
      <div class="admin-input-wrapper">
        <input type="password" id="password" name="password" class="admin-input" placeholder="••••••••••••" required <?= $is_locked ? 'disabled' : '' ?>>
        <button type="button" class="pwd-toggle" id="togglePwd" title="Show/Hide Password">👁️</button>
      </div>
    </div>

    <button type="submit" class="btn-admin-submit" <?= $is_locked ? 'disabled' : '' ?>>
      <?= $is_locked ? 'Account Locked' : 'Authenticate & Login →' ?>
    </button>
  </form>

  <div style="text-align: center; margin-top: 24px;">
    <a href="../index.php" style="font-size: 13px; color: var(--admin-rose); text-decoration: none; font-weight: 600; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
      ← Back to Public Website
    </a>
  </div>
</div>

<script>
  const toggleBtn = document.getElementById('togglePwd');
  const pwdInput  = document.getElementById('password');
  if (toggleBtn && pwdInput) {
    toggleBtn.addEventListener('click', function() {
      const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
      pwdInput.setAttribute('type', type);
      this.textContent = type === 'password' ? '👁️' : '🙈';
    });
  }
</script>

</body>
</html>

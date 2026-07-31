<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}

function get_json($f) {
  $p = __DIR__ . '/../data/' . $f;
  return file_exists($p) ? (json_decode(file_get_contents($p), true) ?? []) : [];
}

$messages = get_json('messages.json');
$services = get_json('services.json');
$clients  = get_json('clients.json');
$unread   = count(array_filter($messages, fn($m) => !($m['read'] ?? false)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard — Tradiant Admin</title>
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
      <a href="dashboard.php" class="active">📊 Dashboard</a>
      <a href="messages.php">✉️ Messages <?= $unread > 0 ? "<span class='badge badge-red' style='margin-left:auto;'>$unread</span>" : '' ?></a>
      <a href="services.php">🔧 Services</a>
      <a href="clients.php">👥 Clients</a>
      <a href="settings.php">⚙️ Settings</a>
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
        <h1>📊 Dashboard</h1>
        <p style="font-size: 13px; color: var(--admin-text-muted); margin-top: 4px;">Welcome back! Here is your business overview.</p>
      </div>
      <div class="admin-header-actions">
        <a href="../index.php" target="_blank" class="act-btn act-btn-edit" style="padding: 10px 18px; font-size: 13px; text-decoration: none;">
          🌐 View Website ↗
        </a>
      </div>
    </div>

    <!-- STATS GRID -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-card-head">
          <div class="stat-icon">📩</div>
          <span class="badge badge-blue">Messages</span>
        </div>
        <div class="stat-value"><?= count($messages) ?></div>
        <div class="stat-label">Total Submissions</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-head">
          <div class="stat-icon" style="color: #f87171; background: rgba(239,68,68,0.12); border-color: rgba(239,68,68,0.3);">🔔</div>
          <span class="badge badge-red">Unread</span>
        </div>
        <div class="stat-value" style="color: #f87171;"><?= $unread ?></div>
        <div class="stat-label">Action Required</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-head">
          <div class="stat-icon" style="color: #4ade80; background: rgba(34,197,94,0.12); border-color: rgba(34,197,94,0.3);">🔧</div>
          <span class="badge badge-green">Services</span>
        </div>
        <div class="stat-value" style="color: #4ade80;"><?= count($services) ?></div>
        <div class="stat-label">Active Offerings</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-head">
          <div class="stat-icon" style="color: #fb923c; background: rgba(249,115,22,0.12); border-color: rgba(249,115,22,0.3);">👥</div>
          <span class="badge badge-orange">Clients</span>
        </div>
        <div class="stat-value" style="color: #fb923c;"><?= count($clients) ?></div>
        <div class="stat-label">Testimonials</div>
      </div>
    </div>

    <!-- RECENT MESSAGES CARD -->
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="admin-card-title">Recent Client Messages</div>
        <a href="messages.php" class="act-btn act-btn-edit" style="text-decoration:none;">View All Messages →</a>
      </div>

      <?php if (empty($messages)): ?>
        <div style="text-align:center; color: var(--admin-text-muted); padding: 40px;">
          No messages received yet.
        </div>
      <?php else: ?>
        <div class="admin-table-wrap">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Client Name</th>
                <th>Phone</th>
                <th>Service Requested</th>
                <th>Submission Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (array_reverse(array_slice($messages, -5)) as $m): ?>
              <tr>
                <td style="font-weight:700; color:#fff;"><?= htmlspecialchars($m['name']) ?></td>
                <td><?= htmlspecialchars($m['phone']) ?></td>
                <td><?= htmlspecialchars($m['service'] ?: 'General Inquiry') ?></td>
                <td style="font-size:12px; color: var(--admin-text-muted);"><?= htmlspecialchars($m['date'] ?? 'N/A') ?></td>
                <td>
                  <span class="badge <?= ($m['read'] ?? false) ? 'badge-green' : 'badge-red' ?>">
                    <?= ($m['read'] ?? false) ? 'Read' : 'New' ?>
                  </span>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

  </main>
</div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

function get_json($f) {
  $p = __DIR__ . '/../data/' . $f;
  return file_exists($p) ? (json_decode(file_get_contents($p), true) ?? []) : [];
}

$messages = get_json('messages.json');
$services = get_json('services.json');
$clients  = get_json('clients.json');
$unread   = count(array_filter($messages, fn($m) => !$m['read']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard — Tradiant Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-layout">
  <!-- SIDEBAR -->
  <aside class="admin-sidebar">
    <div class="sidebar-logo">TRADIANT<span>.</span></div>
    <nav class="sidebar-nav">
      <a href="dashboard.php" class="active">📊 Dashboard</a>
      <a href="messages.php">✉️ Messages <?= $unread > 0 ? "<span class='badge badge-orange'>$unread</span>" : '' ?></a>
      <a href="services.php">🔧 Services</a>
      <a href="clients.php">👥 Clients</a>
      <a href="settings.php">⚙️ Settings</a>
      <a href="logout.php" style="margin-top:auto;color:var(--gray-dim)">🚪 Logout</a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="admin-main">
    <div class="admin-header">
      <h1>Dashboard</h1>
      <a href="../index.php" target="_blank" class="btn btn-outline" style="font-size:12px;padding:9px 18px;">View Website ↗</a>
    </div>

    <!-- STATS -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:36px;">
      <div class="card" style="text-align:center;">
        <div style="font-size:36px;font-family:var(--font-display);color:var(--orange);letter-spacing:2px;"><?= count($messages) ?></div>
        <div style="font-size:11px;text-transform:uppercase;letter-spacing:1px;color:var(--gray-dim);margin-top:4px;">Total Messages</div>
      </div>
      <div class="card" style="text-align:center;">
        <div style="font-size:36px;font-family:var(--font-display);color:#f87171;letter-spacing:2px;"><?= $unread ?></div>
        <div style="font-size:11px;text-transform:uppercase;letter-spacing:1px;color:var(--gray-dim);margin-top:4px;">Unread</div>
      </div>
      <div class="card" style="text-align:center;">
        <div style="font-size:36px;font-family:var(--font-display);color:var(--orange);letter-spacing:2px;"><?= count($services) ?></div>
        <div style="font-size:11px;text-transform:uppercase;letter-spacing:1px;color:var(--gray-dim);margin-top:4px;">Services</div>
      </div>
      <div class="card" style="text-align:center;">
        <div style="font-size:36px;font-family:var(--font-display);color:var(--orange);letter-spacing:2px;"><?= count($clients) ?></div>
        <div style="font-size:11px;text-transform:uppercase;letter-spacing:1px;color:var(--gray-dim);margin-top:4px;">Clients</div>
      </div>
    </div>

    <!-- RECENT MESSAGES -->
    <h2 style="font-family:var(--font-display);font-size:22px;letter-spacing:2px;margin-bottom:16px;">Recent Messages</h2>
    <?php if (empty($messages)): ?>
    <div class="card" style="text-align:center;color:var(--gray-dim);padding:40px;">No messages yet.</div>
    <?php else: ?>
    <table class="admin-table">
      <thead>
        <tr><th>Name</th><th>Phone</th><th>Service</th><th>Date</th><th>Status</th></tr>
      </thead>
      <tbody>
        <?php foreach (array_reverse(array_slice($messages, -5)) as $m): ?>
        <tr>
          <td style="color:var(--white);font-weight:600;"><?= htmlspecialchars($m['name']) ?></td>
          <td><?= htmlspecialchars($m['phone']) ?></td>
          <td><?= htmlspecialchars($m['service'] ?: '—') ?></td>
          <td><?= $m['date'] ?></td>
          <td><span class="badge <?= $m['read'] ? 'badge-green' : 'badge-red' ?>"><?= $m['read'] ? 'Read' : 'New' ?></span></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div style="margin-top:14px;"><a href="messages.php" class="btn btn-outline" style="font-size:12px;padding:9px 18px;">View All Messages</a></div>
    <?php endif; ?>
  </main>
</div>
</body>
</html>

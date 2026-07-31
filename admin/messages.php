<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

$data_file = __DIR__ . '/../data/messages.json';
$messages  = json_decode(file_get_contents($data_file), true) ?? [];

// Mark all as read on page visit
$messages = array_map(fn($m) => array_merge($m, ['read' => true]), $messages);
file_put_contents($data_file, json_encode($messages, JSON_PRETTY_PRINT));

// Delete
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $messages = array_values(array_filter($messages, fn($m) => $m['id'] !== $id));
  file_put_contents($data_file, json_encode($messages, JSON_PRETTY_PRINT));
  header('Location: messages.php'); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Messages — Tradiant Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="admin-body">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="sidebar-logo">TRADIANT<span>.</span></div>
    <nav class="sidebar-nav">
      <a href="dashboard.php">📊 Dashboard</a>
      <a href="messages.php" class="active">✉️ Messages</a>
      <a href="services.php">🔧 Services</a>
      <a href="clients.php">👥 Clients</a>
      <a href="settings.php">⚙️ Settings</a>
      <a href="logout.php">🚪 Logout</a>
    </nav>
  </aside>
  <main class="admin-main">
    <div class="admin-header">
      <h1>Messages</h1>
      <span style="font-size:13px;color:var(--gray-dim);"><?= count($messages) ?> total</span>
    </div>

    <?php if (empty($messages)): ?>
    <div class="card" style="text-align:center;color:var(--gray-dim);padding:60px;">No messages yet. They'll appear here when clients submit the contact form.</div>
    <?php else: ?>
    <table class="admin-table">
      <thead>
        <tr><th>Name</th><th>Phone</th><th>Email</th><th>Service</th><th>Message</th><th>Date</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach (array_reverse($messages) as $m): ?>
        <tr>
          <td style="color:var(--white);font-weight:600;white-space:nowrap;"><?= htmlspecialchars($m['name']) ?></td>
          <td style="white-space:nowrap;"><?= htmlspecialchars($m['phone']) ?></td>
          <td><?= htmlspecialchars($m['email'] ?: '—') ?></td>
          <td><?= htmlspecialchars($m['service'] ?: '—') ?></td>
          <td style="max-width:200px;font-size:12px;"><?= htmlspecialchars(mb_substr($m['message'], 0, 80)) ?><?= strlen($m['message']) > 80 ? '...' : '' ?></td>
          <td style="white-space:nowrap;font-size:12px;"><?= $m['date'] ?></td>
          <td>
            <a href="messages.php?delete=<?= $m['id'] ?>"
               onclick="return confirm('Delete this message?')"
               class="act-btn act-btn-del" style="text-decoration:none;">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </main>
</div>
</body>
</html>

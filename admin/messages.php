<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}

$data_file = __DIR__ . '/../data/messages.json';
$messages  = json_decode(file_get_contents($data_file), true) ?? [];

// Mark all as read on page visit
$messages = array_map(fn($m) => array_merge($m, ['read' => true]), $messages);
file_put_contents($data_file, json_encode($messages, JSON_PRETTY_PRINT));

// Delete message
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $messages = array_values(array_filter($messages, fn($m) => $m['id'] !== $id));
  file_put_contents($data_file, json_encode($messages, JSON_PRETTY_PRINT));
  header('Location: messages.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Messages — Tradiant Admin</title>
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
      <a href="messages.php" class="active">✉️ Messages</a>
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
        <h1>✉️ Contact Form Messages</h1>
        <p style="font-size: 13px; color: var(--admin-text-muted); margin-top: 4px;">Inquiries received from the public website contact form.</p>
      </div>
      <div class="admin-header-actions">
        <span class="badge badge-blue" style="padding: 8px 16px; font-size: 12px;"><?= count($messages) ?> Messages Total</span>
      </div>
    </div>

    <div class="admin-card">
      <?php if (empty($messages)): ?>
        <div style="text-align: center; color: var(--admin-text-muted); padding: 50px;">
          <div style="font-size: 36px; margin-bottom: 12px;">📬</div>
          No messages found. Messages submitted via the contact form will appear here.
        </div>
      <?php else: ?>
        <div class="admin-table-wrap">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Service Requested</th>
                <th>Message Content</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (array_reverse($messages) as $m): ?>
              <tr>
                <td style="font-weight: 700; color: #ffffff; white-space: nowrap;"><?= htmlspecialchars($m['name']) ?></td>
                <td style="white-space: nowrap; font-size: 13px; color: #60a5fa;"><?= htmlspecialchars($m['phone']) ?></td>
                <td style="font-size: 13px; color: var(--admin-text-muted);"><?= htmlspecialchars($m['email'] ?: '—') ?></td>
                <td><span class="badge badge-orange"><?= htmlspecialchars($m['service'] ?: 'General') ?></span></td>
                <td style="max-width: 280px; font-size: 12.5px; color: #cbd5e1; line-height: 1.4;"><?= htmlspecialchars($m['message']) ?></td>
                <td style="white-space: nowrap; font-size: 12px; color: var(--admin-text-muted);"><?= htmlspecialchars($m['date'] ?? 'N/A') ?></td>
                <td>
                  <a href="messages.php?delete=<?= $m['id'] ?>" onclick="return confirm('Delete this message?')" class="act-btn act-btn-del" style="text-decoration:none;">🗑️ Delete</a>
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

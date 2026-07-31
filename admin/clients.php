<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  header('Location: login.php');
  exit;
}

$data_file = __DIR__ . '/../data/clients.json';
$clients   = json_decode(file_get_contents($data_file), true) ?? [];

if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $clients = array_values(array_filter($clients, fn($c) => $c['id'] !== $id));
  file_put_contents($data_file, json_encode($clients, JSON_PRETTY_PRINT));
  header('Location: clients.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_POST['id'] ?? 0);
  $entry = [
    'id'          => $id ?: (max(array_column($clients, 'id') ?: [0]) + 1),
    'name'        => trim($_POST['name']),
    'project'     => trim($_POST['project']),
    'testimonial' => trim($_POST['testimonial']),
    'rating'      => (int)$_POST['rating'],
    'year'        => (int)$_POST['year'],
  ];
  if ($id) {
    foreach ($clients as &$c) { if ($c['id'] === $id) { $c = $entry; break; } }
  } else {
    $clients[] = $entry;
  }
  file_put_contents($data_file, json_encode($clients, JSON_PRETTY_PRINT));
  header('Location: clients.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clients — Tradiant Admin</title>
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
      <a href="clients.php" class="active">👥 Clients</a>
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
        <h1>👥 Clients & Testimonials</h1>
        <p style="font-size: 13px; color: var(--admin-text-muted); margin-top: 4px;">Manage client feedback and portfolio testimonials.</p>
      </div>
      <div class="admin-header-actions">
        <button class="btn-admin-submit" style="width:auto; padding: 10px 20px; font-size: 13px;" onclick="openModal()">
          + Add New Client
        </button>
      </div>
    </div>

    <div class="admin-card">
      <div class="admin-table-wrap">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Client Name</th>
              <th>Project Details</th>
              <th>Testimonial</th>
              <th>Rating</th>
              <th>Year</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($clients as $c): ?>
            <tr>
              <td style="font-weight: 700; color: #ffffff;"><?= htmlspecialchars($c['name']) ?></td>
              <td style="font-size: 13px; color: var(--admin-text-muted);"><?= htmlspecialchars($c['project']) ?></td>
              <td style="font-size: 12.5px; max-width: 260px; color: #cbd5e1;"><?= htmlspecialchars(mb_substr($c['testimonial'], 0, 70)) ?>...</td>
              <td style="color: #fb923c; letter-spacing: 2px; font-size: 15px;"><?= str_repeat('★', $c['rating']) ?></td>
              <td style="font-size: 12px; color: var(--admin-text-muted);"><?= $c['year'] ?></td>
              <td>
                <div style="display: flex; gap: 8px;">
                  <button class="act-btn act-btn-edit" onclick='openModal(<?= json_encode($c) ?>)'>✏️ Edit</button>
                  <a href="clients.php?delete=<?= $c['id'] ?>" onclick="return confirm('Delete this client?')" class="act-btn act-btn-del" style="text-decoration:none;">🗑️ Delete</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this)closeModal()">
  <div class="modal">
    <h3 id="modalTitle">ADD NEW CLIENT</h3>
    <form method="POST">
      <input type="hidden" name="id" id="f_id">
      <div class="admin-form-group">
        <label>Client Name</label>
        <input type="text" name="name" id="f_name" class="admin-input" placeholder="e.g. Rahul Sharma" required>
      </div>
      <div class="admin-form-group">
        <label>Project Details</label>
        <input type="text" name="project" id="f_project" class="admin-input" placeholder="e.g. 3BHK Residential Renovation, Pune" required>
      </div>
      <div class="admin-form-group">
        <label>Testimonial</label>
        <textarea name="testimonial" id="f_testimonial" class="admin-input" style="min-height: 90px; resize: vertical;" required></textarea>
      </div>
      <div style="display: flex; gap: 14px;">
        <div class="admin-form-group" style="flex:1;">
          <label>Rating</label>
          <select name="rating" id="f_rating" class="admin-input" style="background: rgba(15, 23, 42, 0.9);">
            <option value="5">★★★★★ (5 Stars)</option>
            <option value="4">★★★★☆ (4 Stars)</option>
            <option value="3">★★★☆☆ (3 Stars)</option>
          </select>
        </div>
        <div class="admin-form-group" style="flex:1;">
          <label>Year</label>
          <input type="number" name="year" id="f_year" class="admin-input" value="<?= date('Y') ?>" required>
        </div>
      </div>
      <div style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="button" class="act-btn" style="flex:1; justify-content:center; padding: 12px; background: rgba(255,255,255,0.08); color:#fff;" onclick="closeModal()">Cancel</button>
        <button type="submit" class="btn-admin-submit" style="flex:1; margin-top:0;">Save Client</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(c = null) {
  document.getElementById('modalTitle').innerText = c ? 'EDIT CLIENT' : 'ADD NEW CLIENT';
  document.getElementById('f_id').value          = c ? c.id : '';
  document.getElementById('f_name').value        = c ? c.name : '';
  document.getElementById('f_project').value     = c ? c.project : '';
  document.getElementById('f_testimonial').value = c ? c.testimonial : '';
  document.getElementById('f_rating').value      = c ? c.rating : '5';
  document.getElementById('f_year').value        = c ? c.year : new Date().getFullYear();
  document.getElementById('modalOverlay').classList.add('active');
}
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('active');
}
</script>
</body>
</html>
